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

function saveTransaction($date, $description, $amount, $account, $category, $notes) {
    global $conn;
    $userID = $_SESSION["userID"];
    $accountID = getAccountID($userID, $account);
    $groupID = getGroupID($userID, $category);
    $categoryID = getCategoryID($groupID, $description);
    if ($accountID === -1 || $groupID === -1 || $categoryID === -1) {
        $_SESSION['newTransaction'] = false;
    } else {
        $sql = "INSERT INTO transactions (userID, accountID, categoryID, date, description, amount, notes)
                VALUES ('$userID', '$accountID', '$categoryID', '$date', '$description', '$amount', '$notes')";
        $result = mysqli_query($conn, $sql);
        return $result;
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
    $sql = "SELECT * FROM transactions WHERE (userID = '$userID')";
    $result = mysqli_query($conn, $sql);
    return $result;
}

?>