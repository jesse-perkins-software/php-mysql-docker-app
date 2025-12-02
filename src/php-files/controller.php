<?php
//----- Case 1 -----
if (!isset($_POST["page"])) {
    if (isset($_COOKIE["signedin"])) {
        $_POST["page"] = "MainPage";
        $_POST["command"] = "Dashboard";
    } else {
        include("view_signin.php");
        exit();
    }
}

require("model.php");

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
                include("view_mainpage.php");
            } else {
                include("view_signin.php");
            }
            
            exit();
        }
        case "SignUp": {
            include("view_signup.php");
            exit();
        }
    }
} else if ($page == "SignUpPage") {
    $command = $_POST["command"];
    switch($command) {
        case "SignedUp": {
            if (userExists($_POST["username"])) {
                include("view_signup.php");
            } else {
                session_start();
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["password"] = $_POST["password"];
                $_SESSION["firstname"] = $_POST["firstname"];
                $_SESSION["lastname"] = $_POST["lastname"];
                $_SESSION["signedin"] = true;
                setcookie("signedin", true, time() + 86400 * 7);
                registerNewUser($_POST["firstname"], $_POST["lastname"], $_POST["username"], $_POST["password"], $_POST["email"]);
                include("view_mainpage.php");
            }
            
            exit();
        }
        case "SignIn": {
            include("view_signin.php");
            exit();
        }
    }
} else if ($page == "MainPage") {
    session_start();
    if (!isset($_SESSION["signedin"])) {
        include("view_signin.php");
    } else {
        $command = $_POST["command"];
        switch($command) {
            case "Dashboard": {
                include("view_mainpage.php");
                exit();
            }
            case "Accounts": {
                include("accounts/view_accounts.php");
                exit();
            }
            case "Accounts-Chequing": {
                include("accounts/view_accounts_chequing.php");
                exit();
            }
            case "Accounts-Savings": {
                include("accounts/view_accounts_savings.php");
                exit();
            }
            case "Accounts-Credit-Card": {
                include("accounts/view_accounts_credit_card.php");
                exit();
            }
            case "History": {
                include("view_history.php");
                exit();
            }
            case "Transactions_Income": {
                include("transactions/view_transactions_income.php");
                exit();
            }
            case "Transactions_Expenses": {
                include("transactions/view_transactions_expenses.php");
                exit();
            }
            case "Transactions_Transfers": {
                include("transactions/view_transactions_transfers.php");
                exit();
            }
            case "Budget_Income": {
                include("budget/view_budget_income.php");
                exit();
            }
            case "Budget_Expenses": {
                include("budget/view_budget_expenses.php");
                exit();
            }
            case "Budget_vs_Actual": {
                include("budget/view_budget_vs_actual.php");
                exit();
            }
            case "Profile": {
                include("settings/view_settings_profile.php");
                exit();
            }
            case "Preferences": {
                include("settings/view_settings_preferences.php");
                exit();
            }
            case "CategoriesAndAccounts": {
                include("settings/view_settings_categories_and_accounts.php");
                exit();
            }
            case "AboutAndHelp": {
                include("settings/view_settings_about_and_help.php");
                exit();
            }
            case "AddTransaction": {
                addTransaction($_SESSION["username"], $_POST["amount"], $_POST["category"], $_POST["account"], $_POST["date"]);
                include("view_mainpage.php");
                exit();
            }
            case "RefreshTable": {
                if (isset($_POST["DeleteId"])) {
                    deleteTransaction($_SESSION["username"], $_POST["DeleteId"]);
                }
                $transactions = getRecentTransactions($_SESSION["username"]);
                echo $transactions;
                exit();
            }
            case "UpdateTotalBalance": {
                $income = getIncome($_SESSION["username"]);
                $spending = getSpending($_SESSION["username"]);
                $total = $income - $spending;
                echo $total;
                exit();
            }
            case "UpdateTotalIncome": {
                $income = getIncome($_SESSION["username"]);
                if (empty($income)) {
                    $income = 0;
                }
                echo $income;
                exit();
            }
            case "UpdateTotalSpending": {
                $spending = getSpending($_SESSION["username"]);
                if (empty($spending)) {
                    $spending = 0;
                }
                echo $spending;
                exit();
            }
            case "UpdateMonthlyBalance": {
                $income = getMonthIncome($_SESSION["username"]);
                $spending = getMonthSpending($_SESSION["username"]);
                $total = $income - $spending;
                echo $total;
                exit();
            }
            case "UpdateMonthlyIncome": {
                $income = getMonthIncome($_SESSION["username"]);
                if (empty($income)) {
                    $income = 0;
                }
                echo $income;
                exit();
            }
            case "UpdateMonthlySpending": {
                $spending = getMonthSpending($_SESSION["username"]);
                if (empty($spending)) {
                    $spending = 0;
                }
                echo $spending;
                exit();
            }
            case "UpdateAvgSavingsRate": {
                $income = getIncome($_SESSION["username"]);
                if (empty($income)) {
                    $income = 0;
                }
                $needs = getNeeds($_SESSION["username"]);
                if (empty($needs)) {
                    $needs = 0;
                }
                $wants = getWants($_SESSION["username"]);
                if (empty($wants)) {
                    $wants = 0;
                }
                $result = (($income - ($needs + $wants)) / $income) * 100;
                
                echo $result;
                exit();
            }
            case "UpdateNeedsRate": {
                $needs = getNeeds($_SESSION["username"]);
                if (empty($needs)) {
                    $needs = 0;
                }
                $income = getThisMonthIncome($_SESSION["username"]);
                if (empty($income)) {
                    $income = 0;
                }
                $result = ($needs / $income) * 100;

                echo $result;
                exit();
            }
            case "UpdateWantsRate": {
                $wants = getWants($_SESSION["username"]);
                if (empty($wants)) {
                    $wants = 0;
                }
                $income = getThisMonthIncome($_SESSION["username"]);
                if (empty($income)) {
                    $income = 0;
                }
                $result = ($wants / $income) * 100;
                
                echo $result;
                exit();
            }
            case "UpdateSavingsRate": {
                $savings = getSavings($_SESSION["username"]);
                if (empty($savings)) {
                    $savings = 0;
                }
                $income = getThisMonthIncome($_SESSION["username"]);
                if (empty($income)) {
                    $income = 0;
                }
                $result = ($savings / $income) * 100;
                
                echo $result;
                exit();
            }
            case "SignOut": {
                session_unset();
                session_destroy();
                setcookie("signedin", "", time() - 3600);
                include("view_signin.php");
                exit();
            }
        }
    }
} else if ($page == "History") {
    session_start();
    if (!isset($_SESSION["signedin"])) {
        include("view_signin.php");
    } else {
        $command = $_POST["command"];
        switch($command) {
            case "RefreshTable": {
                if (isset($_POST["DeleteId"])) {
                    deleteTransaction($_SESSION["username"], $_POST["DeleteId"]);
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
                editTransaction($_SESSION["username"], $_POST["Id"], $_POST["amount"], $_POST["category"], $_POST["account"], $_POST["date"]);
                include("view_history.php");
                exit();
            }
        }
    }
} else if ($page == "Profile") {
    session_start();
    if (!isset($_SESSION["signedin"])) {
        include("view_signin.php");
    } else {
        $command = $_POST["command"];
        switch($command) {
            case "GeneralInfo": {
                $data = json_decode(getUserDetails($_SESSION["username"]));
                $new_obj = (array) $data[0];
                if (userDetailsExists($_SESSION["username"])) {
                    if ($_POST["profileC"] == "" && $_POST["profileP"] == "") {
                        deleteDetails($_SESSION["username"]);
                        include("settings/view_settings_profile.php");
                        exit();
                    } else if ($_POST["profileP"] != $new_obj["Phone"] || $_POST["profileC"] != $new_obj["Country"]) {
                        changeDetails($_SESSION["username"], $_POST["profileC"], $_POST["profileP"]);
                        include("settings/view_settings_profile.php");
                        exit();
                    }
                } else {
                    addDetails($_SESSION["username"], $_POST["profileC"], $_POST["profileP"]);
                    include("settings/view_settings_profile.php");
                    exit();
                }
            }
            case "UpdateAccounts": {
                if (!userFundsExists($_SESSION["username"])) {
                    addFunds($_SESSION["username"], $_POST["saved"], $_POST["emergency"], $_POST["travel"]);
                    include("settings/view_settings_profile.php");
                    exit();
                } else {
                    updateFunds($_SESSION["username"], $_POST["saved"], $_POST["emergency"], $_POST["travel"]);
                    include("settings/view_settings_profile.php");
                    exit();
                }
            }
            case "ClearAccount": {
                clearUserTransactions($_SESSION["username"]);
                clearUserDetails($_SESSION["username"]);
                clearUserFunds($_SESSION["username"]);
                include("view_mainpage.php");
                exit();
            }
            case "DeleteAccount": {
                clearUserTransactions($_SESSION["username"]);
                clearUserDetails($_SESSION["username"]);
                clearUserFunds($_SESSION["username"]);
                clearUser($_SESSION["username"]);
                
                session_unset();
                session_destroy();
                setcookie("signedin", "", time() - 3600);
                include("view_signin.php");
                exit();
            }
        }
    }
} else if ($page == "Transactions_Income") {
    session_start();
    if (!isset($_SESSION["signedin"])) {
        include("view_signin.php");
    } else {
        $command = $_POST["command"];
        switch ($command) {
            case "NewTransaction": {
                saveTransaction($_POST['date'], $_POST['description'], $_POST["amount"], $_POST["account"], $_POST["category"], $_POST['notes']);

                header('Location: ' . $_SERVER['PHP_SELF']);
                include("transactions/view_transactions_income.php");
                exit();
            }
            case "FetchTransactions": {
                $transactions = getTransactions($_SESSION["userID"]);
                echo $transactions;
                exit();
            }

        }
    }
}

?>