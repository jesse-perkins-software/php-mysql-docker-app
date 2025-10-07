<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <title>Finance App</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        #content-container {
            height: 100vh;
            margin-left: 15vw;
        }

        #nav-bar {
            width: 15vw;
            min-width: 162px;
        }

        .nav-link {
            width: 100%;
        }

        .nav-link:hover {
            background-color: #eee;
        }

        #content-container {
            display: flex;
            flex-direction: column;
            height: 50vh;
        }

        #accounts-container {
            display: flex;
            flex-direction: column;
            margin: 4em;
            gap: 1.5em;
        }

        .account {
            background-color: white;
            padding: 2em;
        }

        .account-heading {

        }

        .account-details {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .account-transactions {

        }

    </style>
</head>
<body>
    <!--  Nav Bar  -->
    <nav class="position-absolute h-100 border-end border-3" id="nav-bar">
        <!-- Form that controls what page the user will be directed to when they click a nav button -->
        <form action="controller.php" method="post" id="nav-form">
            <input type="hidden" name="page" value="MainPage">
            <input type="hidden" name="command" value="" id="command-value"> <!-- Value changes depending on the nav button clicked -->
        </form>

        <div class="nav-section mt-2" id="nav-dashboard">
            <ul class="navbar-nav lh-1">
                <li class="nav-item">
                    <button class="nav-link text-start ps-3 pe-3 w-100 fw-bold" type="submit" onclick="viewPage('Dashboard')">Dashboard</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-3 pe-3 w-100 fw-bold" type="submit" onclick="">Accounts</button>
                </li>
            </ul>
        </div>

        <div class="nav-section mt-4" id="nav-accounts">
            <p class="text-start ps-3 pe-3 w-100 fw-bold border-bottom mb-0">Transactions</p>

            <ul class="navbar-nav lh-1">
                <li class="nav-item">
                    <button class="nav-link text-start ps-4" type="submit" onclick="viewPage('Transaction_Income')">Income</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-4" type="submit" onclick="">Expenses</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-4" type="submit" onclick="">Transfers</button>
                </li>
            </ul>
        </div>

        <div class="nav-section mt-4" id="nav-profile">
            <p class="text-start ps-3 pe-3 w-100 fw-bold border-bottom mb-0">Budget</p>

            <ul class="navbar-nav lh-1">
                <li class="nav-item">
                    <button class="nav-link text-start ps-4" type="submit" onclick="">Income</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-4" type="submit" onclick="">Expenses</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-4" type="submit" onclick="">Budgeted vs. Actual</button>
                </li>
            </ul>
        </div>

        <div class="nav-section mt-4" id="nav-profile">
            <p class="text-start ps-3 pe-3 w-100 fw-bold border-bottom mb-0">Settings</p>

            <ul class="navbar-nav lh-1">
                <li class="nav-item">
                    <button class="nav-link text-start ps-4" type="submit" onclick="viewPage('Profile')">Profile</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-4" type="submit" onclick="">Preferences</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-4" type="submit" onclick="">Categories & Accounts</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-4" type="submit" onclick="">About & Help</button>
                </li>
            </ul>
        </div>

        <div class="nav-section mt-4" id="nav-logout">
            <button class="nav-link fw-bold p-2 bg-secondary-subtle m-auto rounded w-50" type="submit" onclick="viewPage('SignOut')">Sign Out</button>
        </div>
    </nav>

    <div id="content-container">
        <section class="" id="accounts-container">
            <div class="account rounded shadow-sm border" id="account-1">
                <div class="account-heading border">
                    <div class="account-details border">
                        <h2 class="account-type">Chequing</h2>
                        <h2 class="account-amount">$14,000</h2>
                    </div>
                    <p class="account-number">1234 5678 9123 4567</p>
                </div>

                <div class="account-transactions border">

                </div>

            </div>

            <div class="account rounded p-2 shadow-sm border" id="account-2">

            </div>
        </section>
    </div>
</body>
<script defer>

    function viewPage(page) {
        document.getElementById("command-value").value = page;
        document.getElementById("nav-form").submit();
    }

</script>
</html>
