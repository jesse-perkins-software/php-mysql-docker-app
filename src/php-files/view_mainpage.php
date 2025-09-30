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
        #nav-bar {
            width: 15vw;
            min-width: 162px;
        }

        #content-container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            height: 100vh;
        }

        #graphs-charts-content {
            flex: 1;
        }

        #top-half, #bottom-half {
            height: 50%;
            padding: 1.5em;
        }

        #card-small-content {
            flex: 1;
            padding: 1.5em;
            margin-left: 15%;
        }

        .chart {
            height: 50%;
        }

        #new {
            width: 8vw;
        }

        #dash-container {
            min-width: 100%;
        }

        .nav-link:hover {
            background-color: #eee;
        }

        .card-text {
            font-size: 0.8em;
            color: gray;
        }

        .card-small {
            background-color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 9.5em;
        }

        .card-top-text, .card-bottom-text {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .card-top-half, .card-bottom-half {
            height: 50%;
        }

        .card-bottom-half {
            padding-top: 0.2em;
        }

        .card-top-half, .card-bottom-half {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .info-box-pos {
            color: green;
        }

        .info-box-neg {
            color: red;
        }

        #car-loan-progress {
            width: 50%;
        }

        .progress.car-loan {
            height: 0.5em;
        }

        h5 {
            margin-bottom: 0;
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
                    <button class="nav-link text-start ps-4 w-100" type="submit" onclick="">Income</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-4 w-100" type="submit" onclick="">Expenses</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-4 w-100" type="submit" onclick="">Transfers</button>
                </li>
            </ul>
        </div>

        <div class="nav-section mt-4" id="nav-profile">
            <p class="text-start ps-3 pe-3 w-100 fw-bold border-bottom mb-0">Budget</p>

            <ul class="navbar-nav lh-1">
                <li class="nav-item">
                    <button class="nav-link text-start ps-4 w-100" type="submit" onclick="">Income</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-4 w-100" type="submit" onclick="">Expenses</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-4 w-100" type="submit" onclick="">Budgeted vs. Actual</button>
                </li>
            </ul>
        </div>

        <div class="nav-section mt-4" id="nav-profile">
            <p class="text-start ps-3 pe-3 w-100 fw-bold border-bottom mb-0">Settings</p>

            <ul class="navbar-nav lh-1">
                <li class="nav-item">
                    <button class="nav-link text-start ps-4 w-100" type="submit" onclick="viewPage('Profile')">Profile</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-4 w-100" type="submit" onclick="">Preferences</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-4 w-100" type="submit" onclick="">Categories & Accounts</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start ps-4 w-100" type="submit" onclick="">About & Help</button>
                </li>
            </ul>
        </div>

        <div class="nav-section mt-4" id="nav-logout">
            <button class="nav-link fw-bold p-2 bg-secondary-subtle m-auto border rounded" type="submit" onclick="viewPage('SignOut')">Sign Out</button>
        </div>
    </nav>
<!--    <div class="position-absolute h-100 border-end border-2 shadow-sm bg-light d-flex align-items-center" id="nav-bar">-->
<!--        <ul class="nav flex-column w-100 p-3 gap-4">-->
<!--            <li class="nav-item rounded-3">-->
<!--                <form action="/controller.php" method="post">-->
<!--                    <input type="hidden" name="page" value="MainPage">-->
<!--                    <input type="hidden" name="command" value="Dashboard">-->
<!---->
<!--                    <button class="btn btn-primary fs-5 w-100" type="submit">Dashboard</button>-->
<!--                </form>-->
<!--            </li>-->
<!---->
<!--            <li class="nav-item rounded-3">-->
<!--                <form action="/controller.php" method="post">-->
<!--                    <input type="hidden" name="page" value="MainPage">-->
<!--                    <input type="hidden" name="command" value="History">-->
<!---->
<!--                    <button class="btn btn-secondary fs-5 w-100" type="submit">History</button>-->
<!--                </form>-->
<!--            </li>-->
<!---->
<!--            <li class="nav-item rounded-3">-->
<!--                <form action="/controller.php" method="post">-->
<!--                    <input type="hidden" name="page" value="MainPage">-->
<!--                    <input type="hidden" name="command" value="Profile">-->
<!---->
<!--                    <button class="btn btn-secondary fs-5 w-100" type="submit">Profile</button>-->
<!--                </form>-->
<!--            </li>-->
<!---->
<!--            <li class="nav-item rounded-3">-->
<!--                <form action="/controller.php" method="post">-->
<!--                    <input type="hidden" name="page" value="MainPage">-->
<!--                    <input type="hidden" name="command" value="SignOut">-->
<!---->
<!--                    <button class="btn btn-danger fs-5 w-100" type="submit">Sign Out</button>-->
<!--                </form>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
    <div id="content-container">
        <section class="vh-100 container" id="card-small-content">
            <div class="row p-3 gap-4"> <!-- This is the div for an entire row on the dashboard page -->

                <!-- Here is the overall structure for a small dashboard card. -->
                <div class="col card-small p-2 rounded shadow-sm">
                    <div class="card-top-half"> <!-- Top half of the card -->
                        <div class="card-top-text"> <!-- Text for the top of the card -->
                            <span class="card-text">Current Balance</span> <!-- Top right corner -->
                            <span class="card-text info-box-pos ">+$3,000 (6.7%)</span> <!-- Top left corner -->
                        </div>
                        <div></div> <!-- Just in case I want to add anything else here later -->
                    </div>

                    <h5>$29,437.29</h5> <!-- The primary statistic (dollar amount, percentage, etc.) -->

                    <div class="card-bottom-half"> <!-- Bottom half of the card -->
                        <div></div> <!-- Just in case I want to add anything else here later -->
                        <div class="card-bottom-text"> <!-- Text for the bottom of the card -->
                            <span class="card-text">All Accounts</span> <!-- Bottom right corner -->
                            <span class="card-text">As of today</span> <!-- Bottom left corner -->
                        </div>
                    </div>
                </div>

                <div class="col card-small p-2 rounded shadow-sm">
                    <div class="card-top-half">
                        <div class="card-top-text">
                            <span class="card-text">7 Day Spending</span>
                            <span class="card-text info-box-neg">+3% vs avg</span>
                        </div>
                        <div></div>
                    </div>
                    <h5>$120.00</h5>
                    <div class="card-bottom-half">
                        <div></div>
                        <div class="card-bottom-text">
                            <span class="card-text">Since Sep 20</span>
                            <span class="card-text"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-3 gap-4">
                <div class="col card-small p-2 rounded shadow-sm">
                    <div class="card-top-half">
                        <div class="card-top-text">
                            <span class="card-text">Monthly Savings Rate</span>
                            <span class="card-text info-box-pos">+5% vs Aug</span>
                        </div>
                        <div></div>
                    </div>
                    <h5>52.57%</h5>
                    <div class="card-bottom-half">
                        <div></div>
                        <div class="card-bottom-text">
                            <span class="card-text">Aim for 60%</span>
                            <span class="card-text"></span>
                        </div>
                    </div>
                </div>
                <div class="col card-small p-2 rounded shadow-sm">
                    <div class="card-top-half">
                        <div class="card-top-text">
                            <span class="card-text">Monthly Needs Rate</span>
                            <span class="card-text info-box-neg">-10% vs Aug</span>
                        </div>
                        <div></div>
                    </div>
                    <h5>25.76%</h5>
                    <div class="card-bottom-half">
                        <div></div>
                        <div class="card-bottom-text">
                            <span class="card-text">Aim for 30%</span>
                            <span class="card-text"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-3 gap-4">
                <div class="col card-small p-2 rounded shadow-sm">
                    <div class="card-top-half">
                        <div class="card-top-text">
                            <span class="card-text">Monthly Wants Rate</span>
                            <span class="card-text info-box-neg">-8% vs Aug</span>
                        </div>
                        <div></div>
                    </div>
                    <h5>15.76%</h5>
                    <div class="card-bottom-half">
                        <div></div>
                        <div class="card-bottom-text">
                            <span class="card-text">Aim for 10%</span>
                            <span class="card-text"></span>
                        </div>
                    </div>
                </div>
                <div class="col card-small p-2 rounded shadow-sm">
                    <div class="card-top-half">
                        <div class="card-top-text">
                            <span class="card-text">Title</span>
                            <span class="card-text info-box-neg"></span>
                        </div>
                        <div></div>
                    </div>
                    <h5>%</h5>
                    <div class="card-bottom-half">
                        <div></div>
                        <div class="card-bottom-text">
                            <span class="card-text"></span>
                            <span class="card-text"></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="vh-100 container" id="graphs-charts-content">
            <div class="" id="top-half">
                <canvas id="first-chart"></canvas>
            </div>
            <div class="" id="bottom-half">
                <canvas id="second-chart"></canvas>
            </div>
        </section>
    </div>


<!-- Keeping my previous code here in case I need to reuse anything -->

<!--        <!--  Greeting Card -->
<!--        <div id="greeting" class="d-flex border border-2 bg-light rounded-3 m-2">-->
<!--            <div class="fs-2 fw-medium p-3">-->
<!--                Hello -->
<!--                <span class="text-capitalize" id="name">--><?php //echo getFirstName($_SESSION["username"]);?><!--</span>!&#128075-->
<!--                Here is your dashboard where you can see all of your stats and recent transactions.-->
<!--            </div>-->
<!--        </div>-->

        <!--  Dashboard  -->
<!--        <div id="dash" class="shadow-sm border border-2 bg-light rounded-3 m-2 p-3">-->
<!--            <div id="dash-container" class="container text-center">-->
<!--                <div class="row gap-4">-->
<!--                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">-->
<!--                        <h3>Total Balance</h3>-->
<!--                        <span id="totalBalance"></span>-->
<!--                    </div>-->
<!--                    -->
<!--                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">-->
<!--                        <h3>Total Income</h3>-->
<!--                        <span id="totalIncome"></span>-->
<!--                    </div>-->
<!--                    -->
<!--                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">-->
<!--                        <h3>Total Spending</h3>-->
<!--                        <span id="totalSpending"></span>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <br>-->
<!--                -->
<!--                <div class="row gap-4">-->
<!--                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">-->
<!--                        <h3>Monthly Balance</h3>-->
<!--                        <span id="monthlyBalance"></span>-->
<!--                    </div>-->
<!--                    -->
<!--                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">-->
<!--                        <h3>Monthly Income</h3>-->
<!--                        <span id="monthlyIncome"></span>-->
<!--                    </div>-->
<!--                    -->
<!--                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">-->
<!--                        <h3>Monthly Spending</h3>-->
<!--                        <span id="monthlySpending"></span>-->
<!--                    </div>-->
<!--                </div><br>-->
<!--                -->
<!--                <div class="row gap-4">-->
<!--                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">-->
<!--                        <h3>Avg. Savings Rate</h3>-->
<!--                        <span id="avgRate">20%</span>-->
<!--                    </div>-->
<!--                    -->
<!--                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">-->
<!--                        <h3 id="monthNeeds">Needs</h3>-->
<!--                        <span id="monthNeedsRate">10%</span>-->
<!--                    </div>-->
<!--                    -->
<!--                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">-->
<!--                        <h3 id="monthWants">Wants</h3>-->
<!--                        <span id="monthWantsRate">5%</span>-->
<!--                    </div>-->
<!--                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">-->
<!--                        <h3 id="monthSavings">Savings</h3>-->
<!--                        <span id="monthSavingsRate">5%</span>-->
<!--                    </div>-->
<!--                </div><br>-->
<!--            </div>-->
<!--            -->
<!--        </div>-->

<!--        <!--  Add Transaction Button  -->
<!--        <div class="d-flex justify-content-end m-2">-->
<!--            <button id="newTransaction" class="btn btn-primary fs-5" data-bs-toggle="modal" data-bs-target="#transactionModal">+ New Transaction</button>-->
<!--        </div>-->
<!--        -->
<!--        <!--  Modal  -->
<!--        <div class="modal fade" id="transactionModal">-->
<!--            <div class="modal-dialog modal-dialog-centered">-->
<!--                <div class="modal-content">-->
<!--                    <div class="modal-header">-->
<!--                        <h1 class="modal-title fs-5" id="exampleModalLabel">Transaction Details</h1>-->
<!--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--                    </div>-->
<!--                    <div class="modal-body">-->
<!--                        <form action="/controller.php" method="post" class="needs-validation" novalidate>-->
<!--                            <input type="hidden" name="page" value="MainPage">-->
<!--                            <input type="hidden" name="command" value="AddTransaction">-->
<!--                            <div class="input-group">-->
<!--                                <span class="input-group-text">$</span>-->
<!--                                <div class="form-floating">-->
<!--                                    <input type="number" class="form-control" id="amount" name="amount" step=".01" placeholder="Amount" required>-->
<!--                                    <label for="amount">Amount</label>-->
<!--                                </div>-->
<!--                                <div class="invalid-feedback">-->
<!--                                    Please enter a number.-->
<!--                                </div>-->
<!--                            </div><br>-->
<!--                            <div class="form-floating">-->
<!--                                <select id="category" class="form-select" name="category" required>-->
<!--                                    <option value="">Choose...</option>-->
<!--                                    <option>Income</option>-->
<!--                                    <option>Savings</option>-->
<!--                                    <option>Rent</option>-->
<!--                                    <option>Utilities</option>-->
<!--                                    <option>Groceries</option>-->
<!--                                    <option>Transport</option>-->
<!--                                    <option>Entertainment</option>-->
<!--                                    <option>Hobbies</option>-->
<!--                                    <option>Travel Fund</option>-->
<!--                                    <option>Emergency Fund</option>-->
<!--                                </select>-->
<!--                                <label for="category">Category</label>-->
<!--                                <div class="invalid-feedback">-->
<!--                                    Please choose a valid option.-->
<!--                                </div>-->
<!--                            </div><br>-->
<!--                            <div class="form-floating">-->
<!--                                <select id="account" class="form-select" name="account" required>-->
<!--                                    <option value="">Choose...</option>-->
<!--                                    <option>Chequing</option>-->
<!--                                    <option>Savings</option>-->
<!--                                    <option>Credit Card</option>-->
<!--                                </select>-->
<!--                                <label for="account">Account</label>-->
<!--                                <div class="invalid-feedback">-->
<!--                                    Please choose a valid option.-->
<!--                                </div>-->
<!--                            </div><br>-->
<!--                            <div class="form-floating">-->
<!--                                <input type="date" class="form-control" id="date" name="date" required>-->
<!--                                <label for="date">Date</label>-->
<!--                                <div class="invalid-feedback">-->
<!--                                    Please choose a valid date.-->
<!--                                </div>-->
<!--                            </div><br>-->
<!--                            <div class="w-100 d-flex flex-row-reverse gap-2">-->
<!--                                <button type="submit" class="btn btn-primary" id="submitTransaction">Save Transaction</button>-->
<!--                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
<!--                            </div>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <!--  Recent Transactions  -->
<!--        <div id="recent" class="flex-fill shadow-sm border border-2 bg-light rounded-3 m-2">-->
<!--            <table id="tbl" class="table table-striped-columns table-light align-middle table-hover">-->
<!--                <thead>-->
<!--                    <tr>-->
<!--                        <th class="fs-4">Amount</th>-->
<!--                        <th class="fs-4">Category</th>-->
<!--                        <th class="fs-4">Account</th>-->
<!--                        <th class="fs-4">Date</th>-->
<!--                    </tr>-->
<!--                </thead>-->
<!--            </table>-->
<!--        </div>-->

</body>
<script defer>
    const first_chart = new Chart(document.getElementById('first-chart'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [50, 30, 20],
                backgroundColor: ["rgb(34,139,34)", 'rgb(30,144,255)', 'rgb(178,34,34)']
            }],
            labels: ['Savings', 'Needs', 'Wants'],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    const second_chart = new Chart(document.getElementById('second-chart'), {
        type: 'line',
        data: {
            datasets: [
                {
                    label: "Monthly Balance",
                    data: [100, 50, 85, 210, 150, 175, 160, 75, 110, 120, 90, 130],
                    backgroundColor: "rgb(0, 0, 0)",
                    borderColor: "rgb(75, 192, 192)",
                    tension: 0,
                    borderWidth: 2,

                }
            ],
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    //----- Form Validation -----
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
            }, false)
        })
    })()

    //----- Total Balance Calculation -----
    function setTotalBalance() {
        let totalBalance =
            <?php
                $income = getIncome($_SESSION["username"]);
                $spending = getSpending($_SESSION["username"]);
                $total = $income - $spending;
                echo $total;
            ?>;
        document.getElementById("totalBalance").innerText = "$" + Intl.NumberFormat().format(Math.abs(totalBalance));
        if (totalBalance > 0) {
            document.getElementById("totalBalance").style.color = "green";
        } else if (totalBalance < 0) {
            document.getElementById("totalBalance").innerText = "($" + Intl.NumberFormat().format(Math.abs(totalBalance)) + ")";
            document.getElementById("totalBalance").style.color = "red";
        } else if (totalBalance == 0) {
            document.getElementById("totalBalance").style.color = "grey";
        }
    }
    setTotalBalance();

    //----- Total Income Calculation -----
    function setTotalIncome() {
        let totalIncome =
            <?php
                $income = getIncome($_SESSION["username"]);
                if (empty($income)) {
                    $income = 0;
                }
                echo $income;
            ?>;
        document.getElementById("totalIncome").innerText = "$" + Intl.NumberFormat().format(totalIncome);
        document.getElementById("totalIncome").style.color = "green";
    }
    setTotalIncome();

    //----- Total Spending Calculation -----
    function setTotalSpending() {
        let totalSpending =
            <?php
                $spending = getSpending($_SESSION["username"]);
                if (empty($spending)) {
                    $spending = 0;
                }
                echo $spending;
            ?>;
        document.getElementById("totalSpending").innerText = "($" + Intl.NumberFormat().format(totalSpending) + ")";
        document.getElementById("totalSpending").style.color = "red";
    }
    setTotalSpending();

    //----- Monthly Balance Calculation -----
    function setMonthlyBalance() {
        let monthlyBalance =
            <?php
                $income = getMonthIncome($_SESSION["username"]);
                $spending = getMonthSpending($_SESSION["username"]);
                $total = $income - $spending;
                echo $total;
            ?>;
        document.getElementById("monthlyBalance").innerText = "$" + Intl.NumberFormat().format(Math.abs(monthlyBalance));
        if (monthlyBalance > 0) {
            document.getElementById("monthlyBalance").style.color = "green";
        } else if (monthlyBalance < 0) {
            document.getElementById("monthlyBalance").innerText = "($" + Intl.NumberFormat().format(Math.abs(monthlyBalance)) + ")";
            document.getElementById("monthlyBalance").style.color = "red";
        } else if (monthlyBalance == 0) {
            document.getElementById("monthlyBalance").style.color = "grey";
        }
    }
    setMonthlyBalance();

    //----- Monthly Income Calculation -----
    function setMonthlyIncome() {
        let monthlyIncome =
            <?php
                $income = getMonthIncome($_SESSION["username"]);
                if (empty($income)) {
                    $income = 0;
                }
                echo $income;
            ?>;
        document.getElementById("monthlyIncome").innerText = "$" + Intl.NumberFormat().format(monthlyIncome);
        document.getElementById("monthlyIncome").style.color = "green";
    }
    setMonthlyIncome();


    //----- Monthly Spending Calculation -----
    function setMonthlySpending() {
        let monthlySpending =
            <?php
                $spending = getMonthSpending($_SESSION["username"]);
                if (empty($spending)) {
                    $spending = 0;
                }
                echo $spending;
            ?>;
        document.getElementById("monthlySpending").innerText = "($" + Intl.NumberFormat().format(monthlySpending) + ")";
        document.getElementById("monthlySpending").style.color = "red";
    }
    setMonthlySpending();

    //----- Average Savings Calculation -----
    function setAvgSavingsRate() {
        let income =
            <?php
                $result = getIncome($_SESSION["username"]);
                if (empty($result)) {
                    $result = 0;
                }
                echo $result;
            ?>;
        let totalSavings =
            <?php
                $income = getIncome($_SESSION["username"]);
                if (empty($income)) {
                    $income = 0;
                }
                $needs = getTotalNeeds($_SESSION["username"]);
                if (empty($needs)) {
                    $needs = 0;
                }
                $wants = getTotalWants($_SESSION["username"]);
                if (empty($wants)) {
                    $wants = 0;
                }
                $result = $income - ($needs + $wants);
                echo $result;
            ?>;
        let result = 0;
        if (income != 0) {
            result = ((totalSavings) / income) * 100;
        }
        let r = result.toFixed(2);

        document.getElementById("avgRate").innerText = r + "%";
    }
    setAvgSavingsRate();

    //----- Needs Calculation -----
    function setNeedsRate() {
        let needs =
            <?php
                $result = getNeeds($_SESSION["username"]);
                if (empty($result)) {
                    $result = 0;
                }
                echo $result;
            ?>;
        let total =
            <?php
                $result = getThisMonthIncome($_SESSION["username"]);
                if (empty($result)) {
                    $result = 0;
                }
                echo $result;
            ?>;
        let rate = 0;
        if (total != 0) {
            rate = (needs / total) * 100;
        }
        let r = rate.toFixed(2);

        document.getElementById("monthNeedsRate").innerText = r + "%";
    }
    setNeedsRate();

    //----- Wants Calculation -----
    function setWantsRate() {
        let wants =
            <?php
                $result = getWants($_SESSION["username"]);
                if (empty($result)) {
                    $result = 0;
                }
                echo $result;
            ?>;
        let total =
            <?php
                $result = getThisMonthIncome($_SESSION["username"]);
                if (empty($result)) {
                    $result = 0;
                }
                echo $result;
            ?>;
        let rate = 0;
        if (total != 0) {
            rate = (wants / total) * 100;
        }
        let r = rate.toFixed(2);

        document.getElementById("monthWantsRate").innerText = r + "%";
    }
    setWantsRate();

    //----- Savings Rate -----
    function setSavingsRate() {
        let savings =
            <?php
                $result = getSavings($_SESSION["username"]);
                if (empty($result)) {
                    $result = 0;
                }
                echo $result;
            ?>;
        let total =
            <?php
                $result = getThisMonthIncome($_SESSION["username"]);
                if (empty($result)) {
                    $result = 0;
                }
                echo $result;
            ?>;
        let rate = 0;
        if (total != 0) {
            rate = (savings / total) * 100;
        }
        let r = rate.toFixed(2);

        document.getElementById("monthSavingsRate").innerText = r + "%";
    }
    setSavingsRate();

    let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    let thisMonth = new Date();
    document.getElementById("monthNeeds").innerText = months[thisMonth.getMonth()] + " Needs";
    document.getElementById("monthWants").innerText = months[thisMonth.getMonth()] + " Wants";
    document.getElementById("monthSavings").innerText = months[thisMonth.getMonth()] + " Savings";
    document.getElementById("date").max = "";

    //----- Contruct Transaction Table -----
    function makeTable(data) {
        let str = "";

        str = "<table id='tbl' class='table table-striped-columns table-light align-middle table-hover h-100'>";

        str += "<thead>";
        str += "<tr>";
        for (let i in data[0]) {
            if (i != "Id")
                str += "<th class='fs-4'>" + i + "</th>";
        }
        str += "</tr>";
        str += "</thead>";

        for (let i = 0; i < data.length; i++) {
            str += "<tbody class='table-group-divider'>";
            str += "<tr>";

            for (let j in data[i]) {
                if (j != "Id") {
                    if (j == "Amount") {
                        if (data[i]["Category"] == "Income") {
                            str += "<td class='fs-5 text-success'>$" + Intl.NumberFormat().format(data[i][j]) + "</td>";
                        } else {
                            str += "<td class='fs-5 text-danger'>$" + Intl.NumberFormat().format(data[i][j]) + "</td>";
                        }
                    } else {
                        str += "<td class='fs-5'>" + data[i][j] + "</td>";
                    }
                }

            }
            str += "<td data-id='" + data[i]["Id"] + "' class='fit-btn-content text-center'><button class='btn btn-danger w-75 fs-5'>Delete</button>" + "</td>";

            str += "</tr>";
            str += "</tbody>";
        }

        str += "</table>";

        document.getElementById("recent").innerHTML = str;

        document.querySelectorAll("td[data-id]").forEach(function(eobj) {
            eobj.addEventListener("click", function() {
                let xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let newData = JSON.parse(this.responseText);
                        makeTable(newData);
                        updateTotalBalance();
                        updateTotalIncome();
                        updateTotalSpending();
                        updateMonthlyBalance();
                        updateMonthlyIncome();
                        updateMonthlySpending();
                        updateAvgSavingsRate();
                        updateNeedsRate();
                        updateWantsRate();
                        updateSavingsRate();
                    }
                };
                let id = this.getAttribute("data-id");
                let query = "page=MainPage&command=RefreshTable&DeleteId=" + id;
                xhttp.open("POST", "/controller.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(query);
            })
        });
        return str;
    }

    var purchases =
        <?php
            $transactions = getRecentTransactions($_SESSION["username"]);
            echo $transactions;
        ?>;

    window.onload = function() {
        makeTable(purchases);
    }


    //----- Update Dashboard Functions -----
    function updateTotalBalance() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let totalBalance = this.responseText;

                document.getElementById("totalBalance").innerText = "$" + Intl.NumberFormat().format(Math.abs(totalBalance));
                if (totalBalance > 0) {
                    document.getElementById("totalBalance").style.color = "green";
                } else if (totalBalance < 0) {
                    document.getElementById("totalBalance").innerText = "($" + Intl.NumberFormat().format(Math.abs(totalBalance)) + ")";
                    document.getElementById("totalBalance").style.color = "red";
                } else if (totalBalance == 0) {
                    document.getElementById("totalBalance").style.color = "grey";
                }
            }
        };
        let query = "page=MainPage&command=UpdateTotalBalance";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateTotalIncome() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let totalIncome = this.responseText;

                document.getElementById("totalIncome").innerText = "$" + Intl.NumberFormat().format(totalIncome);
                document.getElementById("totalIncome").style.color = "green";
            }
        };
        let query = "page=MainPage&command=UpdateTotalIncome";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateTotalSpending() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let totalSpending = this.responseText;

                document.getElementById("totalSpending").innerText = "($" + Intl.NumberFormat().format(totalSpending) + ")";
                document.getElementById("totalSpending").style.color = "red";
            }
        };
        let query = "page=MainPage&command=UpdateTotalSpending";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateMonthlyBalance() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let monthlyBalance = this.responseText;

                document.getElementById("monthlyBalance").innerText = "$" + Intl.NumberFormat().format(Math.abs(monthlyBalance));
                if (monthlyBalance > 0) {
                    document.getElementById("monthlyBalance").style.color = "green";
                } else if (monthlyBalance < 0) {
                    document.getElementById("monthlyBalance").innerText = "($" + Intl.NumberFormat().format(Math.abs(monthlyBalance)) + ")";
                    document.getElementById("monthlyBalance").style.color = "red";
                } else if (monthlyBalance == 0) {
                    document.getElementById("monthlyBalance").style.color = "grey";
                }
            }
        };
        let query = "page=MainPage&command=UpdateMonthlyBalance";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateMonthlyIncome() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let monthlyIncome = this.responseText;

                document.getElementById("monthlyIncome").innerText = "$" + Intl.NumberFormat().format(monthlyIncome);
                document.getElementById("monthlyIncome").style.color = "green";
            }
        };
        let query = "page=MainPage&command=UpdateMonthlyIncome";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateMonthlySpending() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let monthlySpending = this.responseText;

                document.getElementById("monthlySpending").innerText = "($" + Intl.NumberFormat().format(monthlySpending) + ")";
                document.getElementById("monthlySpending").style.color = "red";
            }
        };
        let query = "page=MainPage&command=UpdateMonthlySpending";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateAvgSavingsRate() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let result = parseFloat(this.responseText);
                if (isNaN(result)) {
                    result = 0;
                }

                let r = result.toFixed(2);
                document.getElementById("avgRate").innerText = r + "%";
            }
        };
        let query = "page=MainPage&command=UpdateAvgSavingsRate";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateNeedsRate() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let result = parseFloat(this.responseText);
                if (isNaN(result)) {
                    result = 0;
                }

                let r = result.toFixed(2);
                document.getElementById("monthNeedsRate").innerText = r + "%";
            }
        };
        let query = "page=MainPage&command=UpdateNeedsRate";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateWantsRate() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let result = parseFloat(this.responseText);
                if (isNaN(result)) {
                    result = 0;
                }

                let r = result.toFixed(2);
                document.getElementById("monthWantsRate").innerText = r + "%";
            }
        };
        let query = "page=MainPage&command=UpdateWantsRate";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateSavingsRate() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let result = parseFloat(this.responseText);
                if (isNaN(result)) {
                    result = 0;
                }

                let r = result.toFixed(2);
                document.getElementById("monthSavingsRate").innerText = r + "%";
            }
        };
        let query = "page=MainPage&command=UpdateSavingsRate";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function viewPage(page) {
        document.getElementById("command-value").value = page;
        document.getElementById("nav-form").submit();
    }

</script>
</html>
