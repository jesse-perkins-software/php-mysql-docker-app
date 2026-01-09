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
                <button class="nav-link text-start ps-3 pe-3 w-100 fw-bold" type="submit" onclick="viewPage('Accounts')">Accounts</button>
            </li>
        </ul>
    </div>

    <div class="nav-section mt-3" id="nav-accounts">
        <p class="text-start ps-3 pe-3 w-100 fw-bold border-bottom mb-0">Transactions</p>

        <ul class="navbar-nav lh-1">
            <li class="nav-item">
                <button class="nav-link text-start ps-4" type="submit" onclick="viewPage('Transactions_Income')">Income</button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-start ps-4" type="submit" onclick="viewPage('Transactions_Expenses')">Expenses</button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-start ps-4" type="submit" onclick="viewPage('Transactions_Savings')">Savings</button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-start ps-4" type="submit" onclick="viewPage('Transactions_Transfers')">Transfers</button>
            </li>
        </ul>
    </div>

    <div class="nav-section mt-3" id="nav-profile">
        <p class="text-start ps-3 pe-3 w-100 fw-bold border-bottom mb-0">Budget</p>

        <ul class="navbar-nav lh-1">
            <li class="nav-item">
                <button class="nav-link text-start ps-4" type="submit" onclick="viewPage('Budget_Income')">Income</button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-start ps-4" type="submit" onclick="viewPage('Budget_Expenses')">Expenses</button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-start ps-4" type="submit" onclick="viewPage('Budget_Savings')">Savings</button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-start ps-4" type="submit" onclick="viewPage('Budget_vs_Actual')">Budgeted vs. Actual</button>
            </li>
        </ul>
    </div>

    <div class="nav-section mt-3" id="nav-profile">
        <p class="text-start ps-3 pe-3 w-100 fw-bold border-bottom mb-0">Settings</p>

        <ul class="navbar-nav lh-1">
            <li class="nav-item">
                <button class="nav-link text-start ps-4" type="submit" onclick="viewPage('Profile')">Profile</button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-start ps-4" type="submit" onclick="viewPage('Preferences')">Preferences</button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-start ps-4" type="submit" onclick="viewPage('CategoriesAndAccounts')">Categories & Accounts</button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-start ps-4" type="submit" onclick="viewPage('AboutAndHelp')">About & Help</button>
            </li>
        </ul>
    </div>

    <div class="nav-section mt-3" id="nav-logout">
        <button class="nav-link fw-bold p-2 bg-secondary-subtle m-auto rounded w-50" type="submit" onclick="viewPage('SignOut')">Sign Out</button>
    </div>
</nav>