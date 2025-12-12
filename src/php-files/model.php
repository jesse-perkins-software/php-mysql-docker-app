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
                SELECT 1
                FROM transactions
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

    if (transactionExists($date, $description, $amount, $account, $category, $notes)) {
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

function getTransactions($userID) {
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
            ORDER BY transactions.date DESC";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return json_encode($rows);
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
                userID = '$userID'";
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

?>