<?php
$db_host = $_ENV['DB_HOST'];
$db_user = $_ENV['DB_USER'];
$db_password = $_ENV['DB_PASSWORD'];
$db_name = $_ENV['DB_NAME'];

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

function isLoginValid($u, $p) {
    global $conn;
    $sql = "SELECT * FROM users WHERE (username = '$u') AND (password = '$p')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function transactionExists($date, $description, $amount, $account, $category, $notes) {
    global $conn;
    $userID = $_SESSION["userID"];
    $accountID = getAccountID($userID, $account);
    $groupID = getGroupID($userID, $category);
    $categoryID = getCategoryID($groupID, $description);

    $sql = "SELECT EXISTS(
                SELECT 
                    1
                FROM 
                    transactions
                WHERE
                    transactions.date = '$date'
                    AND transactions.categoryID = '$categoryID'
                    AND transactions.amount = '$amount'
                    AND transactions.accountID = '$accountID'
                    AND transactions.description = '$description'
                    AND transactions.notes = '$notes')
                AS record_exists";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function saveTransaction($date, $description, $amount, $account, $category, $notes) {
    global $conn;
    $userID = $_SESSION["userID"];
    $accountID = getAccountID($userID, $account);
    $groupID = getGroupID($userID, $category);
    $categoryID = getCategoryID($groupID, $description);

    $exists = transactionExists($date, $description, $amount, $account, $category, $notes);

    if (!$exists['record_exists']) {
        $sql = "INSERT INTO transactions (userID, accountID, categoryID, date, description, amount, notes)
            VALUES ('$userID', '$accountID', '$categoryID', '$date', '$description', '$amount', '$notes')";
        return mysqli_query($conn, $sql);
    } else {
        return null;
    }
}

function getUserID($username, $password) {
    global $conn;
    $sql = "SELECT userID FROM users WHERE (username = '$username') AND (password = '$password')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row["userID"] == null) {
        return -1;
    } else {
        return $row["userID"];
    }
}

function getAccountID($userID, $account) {
    global $conn;
    $sql = "SELECT accountID FROM accounts WHERE (userID = '$userID') AND (accountName = '$account')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row["accountID"] == null) {
        return -1;
    } else {
        return $row["accountID"];
    }
}

function getGroupID($userID, $category) {
    global $conn;
    $sql = "SELECT groupID FROM categoryGroups WHERE (userID = '$userID') AND (groupName = '$category')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row["groupID"] == null) {
        return -1;
    } else {
        return $row["groupID"];
    }
}

function getCategoryID($groupID, $description) {
    global $conn;
    $sql = "SELECT categoryID FROM categories WHERE (groupID = '$groupID') AND (categoryName = '$description')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row["categoryID"] == null) {
        return -1;
    } else {
        return $row["categoryID"];
    }
}

function getCategoryIDs($userID, $groupName) {
    global $conn;

    $sql = "SELECT
                MIN(categories.categoryID) AS MIN,
                MAX(categories.categoryID) AS MAX
            FROM
                categories
            INNER JOIN
                categoryGroups ON categories.groupID = categoryGroups.groupID
            WHERE
                categoryGroups.userID = '$userID'
                AND categoryGroups.groupName = '$groupName'
            ";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return json_encode($rows);
}

function getTransactions($userID, $subpage) {
    global $conn;

    if ($subpage === "Income") {
        $sql = "SELECT 
                    transactions.transactionID,
                    transactions.date, 
                    transactions.description, 
                    transactions.amount, 
                    accounts.accountName, 
                    categoryGroups.groupName, 
                    transactions.notes
                FROM 
                    transactions
                INNER JOIN
                    accounts ON transactions.accountID = accounts.accountID
                INNER JOIN
                    categories ON transactions.categoryID = categories.categoryID
                INNER JOIN
                    categoryGroups ON categories.groupID = categoryGroups.groupID
                WHERE
                    transactions.userID = '$userID'
                    AND transactions.categoryID BETWEEN (
                        SELECT
                            MIN(categories.categoryID)
                        FROM
                            categories
                        INNER JOIN
                            categoryGroups ON categories.groupID = categoryGroups.groupID
                        WHERE
                            categoryGroups.userID = '$userID'
                            AND categoryGroups.groupName = '$subpage'
                    ) AND (
                        SELECT
                            MAX(categories.categoryID)
                        FROM
                            categories
                        INNER JOIN
                            categoryGroups ON categories.groupID = categoryGroups.groupID
                        WHERE
                            categoryGroups.userID = '$userID'
                            AND categoryGroups.groupName = '$subpage'
                    )
                ORDER BY transactions.date DESC";
        $result = mysqli_query($conn, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return json_encode($rows);
    } else if ($subpage === "Expenses") {
        $sql = "SELECT 
                    transactions.transactionID,
                    transactions.date, 
                    transactions.description, 
                    transactions.amount, 
                    accounts.accountName, 
                    categoryGroups.groupName, 
                    transactions.notes
                FROM 
                    transactions
                INNER JOIN
                    accounts ON transactions.accountID = accounts.accountID
                INNER JOIN
                    categories ON transactions.categoryID = categories.categoryID
                INNER JOIN
                    categoryGroups ON categories.groupID = categoryGroups.groupID
                WHERE
                    transactions.userID = '$userID'
                    AND transactions.categoryID NOT BETWEEN (
                        SELECT
                            MIN(categories.categoryID)
                        FROM
                            categories
                        INNER JOIN
                            categoryGroups ON categories.groupID = categoryGroups.groupID
                        WHERE
                            categoryGroups.userID = '$userID'
                            AND categoryGroups.groupName = 'Savings'
                    ) AND (
                        SELECT
                            MAX(categories.categoryID)
                        FROM
                            categories
                        INNER JOIN
                            categoryGroups ON categories.groupID = categoryGroups.groupID
                        WHERE
                            categoryGroups.userID = '$userID'
                            AND categoryGroups.groupName = 'Savings'
                    )
                    AND transactions.categoryID NOT BETWEEN (
                        SELECT
                            MIN(categories.categoryID)
                        FROM
                            categories
                        INNER JOIN
                            categoryGroups ON categories.groupID = categoryGroups.groupID
                        WHERE
                            categoryGroups.userID = '$userID'
                            AND categoryGroups.groupName = 'Income'
                    ) AND (
                        SELECT
                            MAX(categories.categoryID)
                        FROM
                            categories
                        INNER JOIN
                            categoryGroups ON categories.groupID = categoryGroups.groupID
                        WHERE
                            categoryGroups.userID = '$userID'
                            AND categoryGroups.groupName = 'Income'
                    )
                ORDER BY transactions.date DESC";
        $result = mysqli_query($conn, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return json_encode($rows);
    } else if ($subpage === "Savings") {
        $sql = "SELECT 
                    transactions.transactionID,
                    transactions.date, 
                    transactions.description, 
                    transactions.amount, 
                    accounts.accountName, 
                    categoryGroups.groupName, 
                    transactions.notes
                FROM 
                    transactions
                INNER JOIN
                    accounts ON transactions.accountID = accounts.accountID
                INNER JOIN
                    categories ON transactions.categoryID = categories.categoryID
                INNER JOIN
                    categoryGroups ON categories.groupID = categoryGroups.groupID
                WHERE
                    transactions.userID = '$userID'
                    AND transactions.categoryID BETWEEN (
                        SELECT
                            MIN(categories.categoryID)
                        FROM
                            categories
                        INNER JOIN
                            categoryGroups ON categories.groupID = categoryGroups.groupID
                        WHERE
                            categoryGroups.userID = '$userID'
                            AND categoryGroups.groupName = '$subpage'
                    ) AND (
                        SELECT
                            MAX(categories.categoryID)
                        FROM
                            categories
                        INNER JOIN
                            categoryGroups ON categories.groupID = categoryGroups.groupID
                        WHERE
                            categoryGroups.userID = '$userID'
                            AND categoryGroups.groupName = '$subpage'
                    )
                ORDER BY transactions.date DESC";
        $result = mysqli_query($conn, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return json_encode($rows);
    } else if ($subpage === "Transfers") {
        $sql = "SELECT 
                transactions.transactionID,
                transactions.date, 
                transactions.description, 
                transactions.amount, 
                accounts.accountName, 
                categoryGroups.groupName, 
                transactions.notes
            FROM 
                transactions
            INNER JOIN
                accounts ON transactions.accountID = accounts.accountID
            INNER JOIN
                categories ON transactions.categoryID = categories.categoryID
            INNER JOIN
                categoryGroups ON categories.groupID = categoryGroups.groupID
            WHERE
                transactions.userID = '$userID'
                AND ((transactions.description LIKE 'Transfer%') OR (transactions.notes LIKE '%transfer%'))
            ORDER BY transactions.date DESC";
        $result = mysqli_query($conn, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return json_encode($rows);
    }
}

function getAccountSelections($userID) {
    global $conn;

    $sql = "SELECT accountName FROM accounts WHERE (userID = '$userID')";
    $result = mysqli_query($conn, $sql);
    $accountNames = [];
    while ($accountName = mysqli_fetch_assoc($result)) {
        $accountNames[] = $accountName['accountName'];
    }
    return $accountNames;
}

function getCategorySelections($userID) {
    global $conn;

    $sql3 = "SELECT
                groupName
            FROM
                categoryGroups
            WHERE
                userID = '$userID'
            ORDER BY 
                groupID
            ";
    $result3 = mysqli_query($conn, $sql3);
    $groupNames = [];
    while ($groupName = mysqli_fetch_assoc($result3)) {
        $groupNames[] = $groupName['groupName'];
    }
    return $groupNames;
}

function getDescriptionSelections($userID, $selectedCategory) {
    global $conn;

    $sql = "SELECT 
                categories.categoryName 
            FROM 
                categories
            INNER JOIN
                categoryGroups ON categories.groupID = categoryGroups.groupID
            WHERE 
                categoryGroups.userID = '$userID'
                AND categoryGroups.groupName = '$selectedCategory'";
    $result = mysqli_query($conn, $sql);
    $categoryNames = [];
    while ($categoryName = mysqli_fetch_assoc($result)) {
        $categoryNames[] = $categoryName['categoryName'];
    }
    return $categoryNames;
}

function deleteTransaction($date, $description, $amount, $account, $category, $notes) {
    global $conn;
    $userID = $_SESSION["userID"];
    $accountID = getAccountID($userID, $account);
    $groupID = getGroupID($userID, $category);
    $categoryID = getCategoryID($groupID, $description);

    if (transactionExists($date, $description, $amount, $account, $category, $notes)) {
        $sql = "DELETE FROM transactions 
                WHERE
                    userID = '$userID'
                    AND accountID = '$accountID'
                    AND categoryID = '$categoryID'
                    AND date = '$date'
                    AND description = '$description'
                    AND amount = '$amount'
                    AND notes = '$notes'";
        return mysqli_query($conn, $sql);
    } else {
        return null;
    }
}

function editTransaction($transactionID, $date, $description, $amount, $account, $category, $notes) {
    global $conn;
    $userID = $_SESSION["userID"];
    $accountID = getAccountID($userID, $account);
    $groupID = getGroupID($userID, $category);
    $categoryID = getCategoryID($groupID, $description);

    $sql = "UPDATE 
                transactions
            SET 
                accountID = '$accountID', 
                categoryID = '$categoryID', 
                date = '$date', 
                description = '$description',
                amount = '$amount',
                notes = '$notes'
            WHERE 
                transactionID = '$transactionID'";
    return mysqli_query($conn, $sql);
}

// ---------- Here is the start of the functions for the Accounts page ----------
function getAccountDetails($userID) {
    global $conn;
    $sql1 = "SELECT
                accountName,
                date,
                description,
                amount
            FROM (
                SELECT
                    accounts.accountName,
                    transactions.date,
                    transactions.description,
                    transactions.amount,
                    ROW_NUMBER() OVER (
                        PARTITION BY accounts.accountName 
                        ORDER BY 
                            transactions.date DESC, 
                            transactions.accountID DESC
                    ) as row_num
                FROM
                    transactions
                INNER JOIN 
                    accounts ON transactions.accountID = accounts.accountID
                WHERE
                    transactions.userID = '$userID'
            ) AS ranked
            WHERE row_num <= 3";
    $result1 = mysqli_query($conn, $sql1);
    $rows1 = [];
    while ($row = mysqli_fetch_assoc($result1)) {
        $rows1[] = $row;
    }

    $sql2 = "SELECT
                accounts.accountName,
                SUM(transactions.amount) AS total
            FROM
                transactions
            INNER JOIN
                accounts ON transactions.accountID = accounts.accountID
            WHERE
                transactions.userID = '$userID'
            GROUP BY
                accounts.accountName";
    $result2 = mysqli_query($conn, $sql2);
    $rows2 = [];
    while ($row = mysqli_fetch_assoc($result2)) {
        $rows2[] = $row;
    }

    return [
        'accountDetails' => $rows1,
        'accountTotals' => $rows2,
    ];
}

function getUserAccounts($userID) {
    global $conn;
    $sql = "SELECT 
                accountName
             FROM 
                accounts
             WHERE
                userID = '$userID'";
    $result1 = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result1)) {
        $rows[] = $row['accountName'];
    }
    return $rows;
}

function getAccountTransactions($userID, $accountName) {
    global $conn;
    $sql = "SELECT 
                transactions.transactionID,
                transactions.date, 
                transactions.description, 
                transactions.amount, 
                accounts.accountName, 
                categoryGroups.groupName, 
                transactions.notes
            FROM 
                transactions
            INNER JOIN
                accounts ON transactions.accountID = accounts.accountID
            INNER JOIN
                categories ON transactions.categoryID = categories.categoryID
            INNER JOIN
                categoryGroups ON categories.groupID = categoryGroups.groupID
            WHERE
                transactions.userID = '$userID'
                AND accounts.accountName = '$accountName'
            ORDER BY transactions.date DESC";
    $result = mysqli_query($conn, $sql);
    $transactions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $transactions[] = $row;
    }
    return json_encode($transactions);
}

function getCurrentBalance($userID) {
    global $conn;
    $sql = "SELECT
                SUM(amount) AS total
            FROM
                transactions
            WHERE
                userID = '$userID'
            ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function get7DayBalance($userID, $date) {
    global $conn;
    $sql = "SELECT
                SUM(amount) AS total
            FROM
                transactions
            WHERE
                userID = '$userID'
                AND (date BETWEEN DATE_SUB('$date', INTERVAL 7 DAY) AND '$date')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function get30DayBalance($userID, $date) {
    global $conn;
    $sql = "SELECT
                SUM(amount) AS total
            FROM
                transactions
            WHERE
                userID = '$userID'
                AND (date BETWEEN DATE_SUB('$date', INTERVAL 30 DAY) AND '$date')
            ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function getMostRecentPurchase($userID) {
    global $conn;
    $sql = "SELECT
                amount, date, description
            FROM
                transactions
            WHERE
                userID = '$userID'
            ORDER BY
                date DESC
            LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $transactions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $transactions[] = $row;
    }
    return json_encode($transactions);
}

function getProfileInfo($userID) {
    global $conn;
    $sql = "SELECT
                firstName,
                lastName,
                email,
                username
            FROM
                users
            WHERE
                userID = '$userID'";
    $result = mysqli_query($conn, $sql);
    $info = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $info[] = $row;
    }
    return json_encode($info);
}

function getLargestPurchase($userID) {
    global $conn;
    $sql = "SELECT
                MAX(amount) AS largest
            FROM
                transactions
            WHERE
                userID = '$userID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['largest'];
}

function getUserCategories($userID) {
    global $conn;
    $sql = "SELECT
                categoryGroups.groupName,
                GROUP_CONCAT(DISTINCT categories.categoryName SEPARATOR ', ') as categories
            FROM
                categoryGroups
            INNER JOIN categories ON categoryGroups.groupID = categories.groupID
            INNER JOIN transactions ON categories.categoryID = transactions.categoryID
            WHERE
                categoryGroups.userID = '$userID'
            GROUP BY
                categoryGroups.groupID
            ";
    $result = mysqli_query($conn, $sql);
    $categories = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    return $categories;
}

function getCategories($userID, $categoryGroup) {
    global $conn;

    if ($categoryGroup == "Income" || $categoryGroup == "Savings") {
        $sql = "SELECT
                categories.categoryName,
                SUM(transactions.amount) AS amount
            FROM
                categories
            INNER JOIN
                categoryGroups ON categories.groupID = categoryGroups.groupID
            LEFT JOIN
                transactions ON categories.categoryID = transactions.categoryID
            WHERE
                categoryGroups.userID = '$userID'
                AND categoryGroups.groupName = '$categoryGroup'
            GROUP BY
                categories.categoryName
            ";
        $result = mysqli_query($conn, $sql);
        $categories = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
        return $categories;
    } else {
        $sql = "SELECT
                categories.categoryName,
                SUM(transactions.amount) AS amount
            FROM
                categories
            INNER JOIN
                categoryGroups ON categories.groupID = categoryGroups.groupID
            LEFT JOIN
                transactions ON categories.categoryID = transactions.categoryID
            WHERE
                categoryGroups.userID = '$userID'
                AND categoryGroups.groupName != 'Income'
                AND categoryGroups.groupName != 'Savings'
            GROUP BY
                categories.categoryName
            ";
        $result = mysqli_query($conn, $sql);
        $categories = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
        return $categories;
    }
}

function getAccounts($userID) {
    global $conn;
    $sql1 = "SELECT
                banks.bankName,
                GROUP_CONCAT(DISTINCT accounts.accountName SEPARATOR ', ') as accounts
            FROM
                banks
            INNER JOIN accounts ON banks.bankID = accounts.bankID
            INNER JOIN transactions ON accounts.accountID = transactions.accountID
            WHERE
                transactions.userID = '$userID'
            GROUP BY
                banks.bankName
            ";
    $result1 = mysqli_query($conn, $sql1);
    $categories = [];
    while ($row = mysqli_fetch_assoc($result1)) {
        $categories[] = $row;
    }
    return $categories;
}

function getAccountNames($userID) {
    global $conn;
    $sql1 = "SELECT DISTINCT
                banks.bankName
            FROM
                banks, accounts
            WHERE
                accounts.userID = '$userID'
                AND accounts.bankID = banks.bankID
            ";
    $result1 = mysqli_query($conn, $sql1);
    $categories = [];
    while ($row = mysqli_fetch_assoc($result1)) {
        $categories[] = $row['bankName'];
    }
    return $categories;
}

function categoryExists($userID, $category) {
    global $conn;
    $sql = "SELECT EXISTS(
                SELECT 
                    1
                FROM
                    categoryGroups
                WHERE
                    userID = '$userID' 
                    AND categoryGroups.groupName = '$category')
                AS categoryExists
                ";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function addCategory($userID, $category, $name) {
    global $conn;

    $exists = categoryExists($userID, $category);

    if ($exists['categoryExists']) {
        $groupID = getGroupID($userID, $category);

        $sql = "INSERT INTO
                    categories (groupID, categoryName)
                VALUES
                    ('$groupID', '$name')
                ";
        return mysqli_query($conn, $sql);
    } else {
        $sql = "INSERT INTO 
                    categoryGroups (userID, groupName)
                VALUES
                    ('$userID', '$name')
                ";
        return mysqli_query($conn, $sql);
    }
}

function addAccount($userID, $account, $bank_name, $account_type) {
    global $conn;

    if (!accountTypeExists($account_type)) {
        addAccountType($account_type);
    }

    if (!is_null($bank_name)) {
        if (!bankExists($bank_name)) {
            addBank($bank_name);
        }
    }

    $bank = $bank_name ?: $account;
    $new_account = $bank . " " . $account_type;
    $bankID = getBankID($bank);
    $accountID = getAccountTypeID($account_type);

    $sql = "INSERT INTO
                accounts (userID, bankID, accountTypeID, accountName)
            VALUES
                ('$userID', '$bankID', '$accountID', '$new_account')
            ";
    return mysqli_query($conn, $sql);
}

function addBank($bank_name) {
    global $conn;

    $sql = "INSERT INTO
                banks (bankName)
            VALUES
                ('$bank_name')
            ";
    return mysqli_query($conn, $sql);
}

function addAccountType($accountType) {
    global $conn;

    $sql = "INSERT INTO
                accountTypes (typeName)
            VALUES
                ('$accountType')
            ";
    return mysqli_query($conn, $sql);
}

function getAccountTypeID($account_type) {
    global $conn;

    $sql = "SELECT
                accountTypeID
            FROM
                accountTypes
            WHERE
                typeName = '$account_type'
            ";
    $result = mysqli_query($conn, $sql);
    $accountTypeID = mysqli_fetch_assoc($result);
    return $accountTypeID['accountTypeID'];
}

function accountTypeExists($accountType) {
    global $conn;

    $sql = "SELECT
                COUNT(*) AS count
            FROM
                accountTypes
            WHERE
                typeName = '$accountType'
            ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
}

function bankExists($bank_name) {
    global $conn;

    $sql = "SELECT
                COUNT(*) AS count
            FROM
                banks
            WHERE
                bankName = '$bank_name'
            ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
}

function getBankID($account) {
    global $conn;

    $sql = "SELECT
                bankID
            FROM
                banks
            WHERE
                bankName = '$account'
            ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['bankID'];
}

function existingBankAccounts($userID, $bankName) {
    global $conn;

    $sql = "SELECT
                accountTypes.typeName
            FROM
                accountTypes
            INNER JOIN
                accounts ON accountTypes.accountTypeID = accounts.accountTypeID
            INNER JOIN
                banks ON accounts.bankID = banks.bankID
            WHERE
                accounts.userID = '$userID'
                AND banks.bankName = '$bankName'
            ";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function userExists($username, $password) {
    global $conn;
    $sql = "SELECT * FROM users WHERE (username = '$username') AND (password = '$password')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function registerNewUser($firstName, $lastName, $email, $username, $password) {
    global $conn;

    $sql = "INSERT INTO users 
                (firstName, lastName, email, username, password)
            VALUES
                ('$firstName', '$lastName', '$email', '$username', '$password')
            ";
    return mysqli_query($conn, $sql);
}

?>