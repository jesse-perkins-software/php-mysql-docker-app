<?php
//----- Case 1 -----
if (!isset($_POST["page"])) {
    if (isset($_COOKIE["signedin"])) {
        $_POST["page"] = "MainPage";
        $_POST["command"] = "Dashboard";
    } else {
        include(__DIR__ . "/../view/view_signin.php");
        exit();
    }
}

require(__DIR__ . "/../model/model.php");

$page = $_POST["page"];
if ($page == "SignInPage") {
    $command = $_POST["command"];
    switch($command) {
        case "SignIn": {
            if (isLoginValid($_POST["username"], $_POST["password"])) {
                session_start();
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["password"] = $_POST["password"];
                $_SESSION["signedin"] = true;
                $_SESSION["userID"] = getUserID($_SESSION["username"], $_SESSION["password"]);
                setcookie("signedin", true, time() + 86400 * 7);
                include(__DIR__ . "/../view/view_mainpage.php");
            } else {
                include(__DIR__ . "/../view/view_signin.php");
            }
            
            exit();
        }
        case "SignUp": {
            include(__DIR__ . "/../view/view_signup.php");
            exit();
        }
    }
} else if ($page == "SignUpPage") {
    $command = $_POST["command"];
    switch($command) {
        case "SignedUp": {
            if (userExists($_POST["username"])) {
                include(__DIR__ . "/../view/view_signup.php");
            } else {
                session_start();
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["password"] = $_POST["password"];
                $_SESSION["firstname"] = $_POST["firstname"];
                $_SESSION["lastname"] = $_POST["lastname"];
                $_SESSION["signedin"] = true;
                setcookie("signedin", true, time() + 86400 * 7);
                registerNewUser($_POST["firstname"], $_POST["lastname"], $_POST["username"], $_POST["password"], $_POST["email"]);
                include(__DIR__ . "/../view/view_mainpage.php");
            }
            
            exit();
        }
        case "SignIn": {
            include(__DIR__ . "/../view/view_signin.php");
            exit();
        }
    }
} else if ($page == "MainPage") {
    session_start();
    if (!isset($_SESSION["signedin"])) {
        include(__DIR__ . "/../view/view_signin.php");
    } else {
        $command = $_POST["command"];
        switch($command) {
            case "Dashboard": {
                include(__DIR__ . "/../view/view_mainpage.php");
                exit();
            }
            case "Accounts": {
                include(__DIR__ . "/../view/accounts/view_accounts.php");
                exit();
            }
            case "Accounts-Chequing": {
                include(__DIR__ . "/../view/accounts/view_selected_account.php");
                exit();
            }
            case "Accounts-Savings": {
                include(__DIR__ . "/../view/accounts/view_selected_account.php");
                exit();
            }
            case "Accounts-Credit-Card": {
                include(__DIR__ . "/../view/accounts/view_selected_account.php");
                exit();
            }
            case "History": {
                include(__DIR__ . "/../view/view_history.php");
                exit();
            }
            case "Transactions_Income": {
                include(__DIR__ . "/../view/transactions/view_transactions_income.php");
                exit();
            }
            case "Transactions_Expenses": {
                include(__DIR__ . "/../view/transactions/view_transactions_expenses.php");
                exit();
            }
            case "Transactions_Transfers": {
                include(__DIR__ . "/../view/transactions/view_transactions_transfers.php");
                exit();
            }
            case "Budget_Income": {
                include(__DIR__ . "/../view/budget/view_budget_income.php");
                exit();
            }
            case "Budget_Expenses": {
                include(__DIR__ . "/../view/budget/view_budget_expenses.php");
                exit();
            }
            case "Budget_vs_Actual": {
                include(__DIR__ . "/../view/budget/view_budget_vs_actual.php");
                exit();
            }
            case "Profile": {
                include(__DIR__ . "/../view/settings/view_settings_profile.php");
                exit();
            }
            case "Preferences": {
                include(__DIR__ . "/../view/settings/view_settings_preferences.php");
                exit();
            }
            case "CategoriesAndAccounts": {
                include(__DIR__ . "/../view/settings/view_settings_categories_and_accounts.php");
                exit();
            }
            case "AboutAndHelp": {
                include(__DIR__ . "/../view/settings/view_settings_about_and_help.php");
                exit();
            }
            case "LoadCard1": {
                $result = getCurrentBalance($_SESSION["userID"]);
                echo $result;
                exit();
            }
            case "LoadCard2": {
                $result = get7DayBalance($_SESSION["userID"], date("Y-m-d"));
                echo $result;
                exit();
            }
            case "LoadCard3": {
                $result = get30DayBalance($_SESSION["userID"], date("Y-m-d"));
                echo $result;
                exit();
            }
            case "LoadCard4": {
                $result = getMostRecentPurchase($_SESSION["userID"]);
                echo $result;
                exit();
            }
            case "LoadCard7": {
                $result = getLargestPurchase($_SESSION["userID"]);
                echo $result;
                exit();
            }
            case "SignOut": {
                session_unset();
                session_destroy();
                setcookie("signedin", "", time() - 3600);
                include(__DIR__ . "/view_signin.php");
                exit();
            }
        }
    }
} else if ($page == "History") {
    session_start();
    if (!isset($_SESSION["signedin"])) {
        include(__DIR__ . "/../view/view_signin.php");
    } else {
        $command = $_POST["command"];
        switch($command) {
            case "RefreshTable": {
                if (isset($_POST["DeleteId"])) {
                    //deleteTransaction($_SESSION["username"], $_POST["DeleteId"]);
                }
                $transactions = getTopTransactions($_SESSION["username"]);
                echo $transactions;
                exit();
            }
            case "UpdateSearch": {
                $transactions = searchTransactions($_SESSION["username"], $_POST["SearchStr"]);
                echo $transactions;
                
                exit();
            }
            case "EditTransaction": {
                //editTransaction($_SESSION["username"], $_POST["Id"], $_POST["amount"], $_POST["category"], $_POST["account"], $_POST["date"]);
                include(__DIR__ . "/../view/view_history.php");
                exit();
            }
        }
    }
} else if ($page == "Settings") {
    session_start();
    if (!isset($_SESSION["signedin"])) {
        include(__DIR__ . "/view_signin.php");
    } else {
        $command = $_POST["command"];
        switch($command) {
            case "LoadProfileInfo": {
                echo getProfileInfo($_SESSION["userID"]);
                exit();
            }
            case "LoadCategories": {
                echo json_encode(getCategories($_SESSION["userID"]));
                exit();
            }
            case "GetCategoryOptions": {
                echo json_encode(getCategorySelections($_SESSION["userID"]));
                exit();
            }
            case "GetAccountOptions": {
                echo json_encode(getAccountNames($_SESSION["userID"]));
                exit();
            }
            case "LoadAccounts": {
                echo json_encode(getAccounts($_SESSION["userID"]));
                exit();
            }
            case "NewCategory": {
                if (($_SESSION['category'] == $_POST["category"]) && ($_SESSION['name'] == $_POST["name"])) {
                    include(__DIR__ . "/../view/settings/view_settings_categories_and_accounts.php");
                    exit();
                } else {
                    addCategory($_SESSION["userID"], $_POST["category"], $_POST["name"]);
                    $_SESSION['category'] = $_POST["category"];
                    $_SESSION['name'] = $_POST["name"];
                    include('../view/settings/view_settings_categories_and_accounts.php');
                    exit();
                }
            }
            case "NewAccount": {
                if (($_SESSION["account"] == $_POST["account"]) && ($_SESSION['bank_name'] == $_POST["bank_name"]) && $_SESSION['account_type'] == $_POST["account_type"]) {
                    include(__DIR__ . "/../view/settings/view_settings_categories_and_accounts.php");
                    exit();
                } else {
                    if ($_POST["bank_name"] === "") { // Adding a new account to an existing bank
                        addAccount($_SESSION["userID"], $_POST["account"], null, $_POST["account_type"]);
                        $_SESSION['account'] = $_POST["account"];
                        $_SESSION['bank_name'] = $_POST["bank_name"];
                        $_SESSION['account_type'] = $_POST["account_type"];
                    } else { // Adding a new bank with account
                        addAccount($_SESSION["userID"], $_POST["account"], $_POST["bank_name"], $_POST["account_type"]);
                        $_SESSION['account'] = $_POST["account"];
                        $_SESSION['bank_name'] = $_POST["bank_name"];
                        $_SESSION['account_type'] = $_POST["account_type"];
                    }
                    include(__DIR__ . "/../view/settings/view_settings_categories_and_accounts.php");
                    exit();
                }
            }
            case "DeleteAccount": {
                deleteAccount($_SESSION["userID"], $_POST["bank"], $_POST["account-type"]);
                include(__DIR__ . "/../view/settings/view_settings_categories_and_accounts.php");
                exit();
            }
            case "GetSelectedBankAccounts": {
                echo json_encode(existingBankAccounts($_SESSION["userID"], $_POST["selectedBank"]));
                exit();
            }
        }
    }
} else if ($page == "Transactions") {
    session_start();
    if (!isset($_SESSION["signedin"])) {
        include(__DIR__ . "/view_signin.php");
    } else {
        $command = $_POST["command"];
        switch ($command) {
            case "NewTransaction": {
                if (($_SESSION['date'] == $_POST['date']) && ($_SESSION['description'] == $_POST['description']) && ($_SESSION['amount'] == $_POST['amount']) && ($_SESSION['account'] == $_POST['account']) && ($_SESSION['category'] == $_POST['category']) && ($_SESSION['notes'] == $_POST['notes'])) {
                    if ($_POST['subpage-new'] === "Expenses") {
                        include(__DIR__ . "/../view/transactions/view_transactions_expenses.php");
                    } else if ($_POST['subpage-new'] === "Income") {
                        include(__DIR__ . "/../view/transactions/view_transactions_income.php");
                    }
                    exit();
                } else {
                    saveTransaction($_POST['date'], $_POST['description'], $_POST["amount"], $_POST["account"], $_POST["category"], $_POST['notes']);
                    $_SESSION['date'] = $_POST['date'];
                    $_SESSION['description'] = $_POST['description'];
                    $_SESSION['amount'] = $_POST['amount'];
                    $_SESSION['account'] = $_POST['account'];
                    $_SESSION['category'] = $_POST['category'];
                    $_SESSION['notes'] = $_POST['notes'];
                    switch ($_POST['subpage-new']) {
                        case "Expenses": {
                            include(__DIR__ . "/../view/transactions/view_transactions_expenses.php");
                            exit();
                        }
                        case "Income": {
                            include(__DIR__ . "/../view/transactions/view_transactions_income.php");
                            exit();
                        }
                        case "Transfers": {
                            include(__DIR__ . "/../view/transactions/view_transactions_transfers.php");
                            exit();
                        }
                        default: {
                            if (in_array($_POST['subpage-new'], getUserAccounts($_SESSION["userID"]))) {
                                include(__DIR__ . "/../view/accounts/view_selected_account.php");
                                exit();
                            }
                        }
                    }
                    exit();
                }
            }
            case "EditTransaction": {
                if ($_POST['action'] == 'delete') {
                    deleteTransaction($_POST['date'], $_POST['description'], $_POST["amount"], $_POST["account"], $_POST["category"], $_POST['notes']);
                    switch ($_POST['subpage-edit']) {
                        case "Expenses": {
                            include(__DIR__ . "/../view/transactions/view_transactions_expenses.php");
                            exit();
                        }
                        case "Income": {
                            include(__DIR__ . "/../view/transactions/view_transactions_income.php");
                            exit();
                        }
                        case "Transfers": {
                            include(__DIR__ . "/../view/transactions/view_transactions_transfers.php");
                            exit();
                        }
                        default: {
                            if (in_array($_POST['subpage-edit'], getUserAccounts($_SESSION["userID"]))) {
                                include(__DIR__ . "/../view/accounts/view_selected_account.php");
                                exit();
                            }
                        }
                    }
                    exit();
                } else if ($_POST['action'] == 'save') {
                    editTransaction($_POST['transaction-id'], $_POST['date'], $_POST['description'], $_POST['amount'], $_POST['account'], $_POST['category'], $_POST['notes']);
                    switch ($_POST['subpage-edit']) {
                        case "Expenses": {
                            include(__DIR__ . "/../view/transactions/view_transactions_expenses.php");
                            exit();
                        }
                        case "Income": {
                            include(__DIR__ . "/../view/transactions/view_transactions_income.php");
                            exit();
                        }
                        case "Transfers": {
                            include(__DIR__ . "/../view/transactions/view_transactions_transfers.php");
                            exit();
                        }
                        default: {
                            if (in_array($_POST['subpage-edit'], getUserAccounts($_SESSION["userID"]))) {
                                include(__DIR__ . "/../view/accounts/view_selected_account.php");
                                exit();
                            }
                        }
                    }
                    exit();
                }
            }
            case "FetchTransactions": {
                $transactions = getTransactions($_SESSION["userID"], $_POST['subpage']);
                echo $transactions;
                exit();
            }
            case "FetchCategorySelectionOptions": {
                $categories = getCategorySelections($_SESSION["userID"]);
                echo json_encode($categories);
                exit();
            }
            case "FetchDescriptionSelectionOptions": {
                $descriptions = getDescriptionSelections($_SESSION["userID"], $_POST['selectedCategory']);
                echo json_encode($descriptions);
                exit();
            }
            case "FetchAccountOptions": {
                $accounts = getAccountSelections($_SESSION["userID"]);
                echo json_encode($accounts);
            }
        }
    }
} else if ($page == "Accounts") {
    session_start();
    if (!isset($_SESSION["signedin"])) {
        include(__DIR__ . "/view_signin.php");
    } else {
        $command = $_POST["command"];
        $user_accounts = getUserAccounts($_SESSION["userID"]);

        switch ($command) {
            case "FetchAccountDetails": {
                $accountDetails = getAccountDetails($_SESSION["userID"]);
                echo json_encode($accountDetails);
                exit();
            }
            case "FetchAccountTransactions": {
                $accountTransactions = getAccountTransactions($_SESSION["userID"], $_POST["account"]);
                echo $accountTransactions;
                exit();
            }
            default: {
                if (in_array($command, $user_accounts)) {
                    $_SESSION["selectedAccount"] = $command;
                    include(__DIR__ . "/../view/accounts/view_selected_account.php");
                }
                exit();
            }
        }
    }
}

?>