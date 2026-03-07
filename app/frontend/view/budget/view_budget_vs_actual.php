<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        <?php include(__DIR__ . '/../css/global_variables.css'); ?>

        #nav-bar {
            width: var(--nav-bar-width);
        }

        #header-container {
            height: 20vh;
            background-color: #E9E9E9;
            padding: 2em;
        }

        #header-amount {
            font-size: 1.25em;
        }


        #buttons {
            width: 10vw;
        }
        #searchBar {
            height: 5vh;
        }
        #amount-filter, #category-filter, #account-filter, #date-filter {
            display: none;
        }

        .nav-link {
            width: 100%;
        }

        .nav-link:hover {
            background-color: #eee;
        }

        .progress {
            height: 0.5em;
        }

        .row {
            display: flex;
            flex-direction: column;
            flex: 1;
            margin: 1em;
        }

        .card-text {
            font-size: 1em;
        }

        .card-small {
            background-color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 100%;
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
            padding-top: 0.5em;
        }

        .card-top-half, .card-bottom-half {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 0.2em;
        }

        .info-box-pos {
            color: green;
        }

        .info-box-neg {
            color: red;
        }

        #content-container {
            height: 100vh;
            margin-left: var(--nav-bar-width);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            justify-content: start;
        }

        #chart-container {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            margin-top: 1em;
            height: 35vh;
        }

        .chart {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
            flex: 1;
            gap: 1em;
        }

        .chart canvas {
            flex: 1;
            height: 65%;
        }

        .row .col:nth-child(1) .card-text:first-child {
            color: rgb(178,34,34);
        }

        .row .col:nth-child(1) .progress-bar {
            background-color: rgb(178,34,34);
        }

        .row .col:nth-child(2) .card-text:first-child {
            color: rgb(30, 58, 138);
        }

        .row .col:nth-child(2) .progress-bar {
            background-color: rgb(30, 58, 138);
        }

        .row .col:nth-child(3) .card-text:first-child {
            color: rgb(6, 95, 70);
        }

        .row .col:nth-child(3) .progress-bar {
            background-color: rgb(6, 95, 70);
        }

        #wants-progress-budgeted, #needs-progress-budgeted, #savings-progress-budgeted {
            opacity: 50%;
        }

    </style>
</head>
<body>
    <?php require(__DIR__ . '/../navigation.php'); ?>

    <div class="" id="content-container">
        <div class="" id="chart-container">
            <div class="chart">
                <h2>Budgeted</h2>
                <div class="canvas-wrapper">
                    <canvas id="budgeted-chart"></canvas>
                </div>
            </div>
            <div class="chart">
                <h2>Actual</h2>
                <div class="canvas-wrapper">
                    <canvas id="actual-chart"></canvas>
                </div>
            </div>
        </div>

        <div class="row p-3 gap-4">
            <div class="col card-small p-2 rounded shadow-sm border">
                <div class="card-top-half">
                    <div class="card-top-text">
                        <span class="card-text">Wants</span>
                        <span class="card-text" id="wants-percent"></span>
                    </div>
                    <div></div>
                </div>
                <h5 id="wants-amount"></h5>
                <div class="card-bottom-half">
                    <div class="progress" id="wants-progress-budgeted" role="progressbar">
                        <div class="progress-bar" id="wants-progress-budgeted-bar"></div>
                    </div>
                    <div class="progress" id="wants-progress-real" role="progressbar">
                        <div class="progress-bar" id="wants-progress-actual-bar"></div>
                    </div>
                    <div class="card-bottom-text">
                        <span class="card-text"></span>
                        <span class="card-text"></span>
                    </div>
                </div>
            </div>
            <div class="col card-small p-2 rounded shadow-sm border">
                <div class="card-top-half">
                    <div class="card-top-text">
                        <span class="card-text">Needs</span>
                        <span class="card-text" id="needs-percent"></span>
                    </div>
                    <div></div>
                </div>
                <h5 id="needs-amount"></h5>
                <div class="card-bottom-half">
                    <div class="progress" id="needs-progress-budgeted" role="progressbar">
                        <div class="progress-bar" id="needs-progress-budgeted-bar"></div>
                    </div>
                    <div class="progress" id="needs-progress-real" role="progressbar">
                        <div class="progress-bar" id="needs-progress-actual-bar"></div>
                    </div>
                    <div class="card-bottom-text">
                        <span class="card-text"></span>
                        <span class="card-text"></span>
                    </div>
                </div>
            </div>
            <div class="col card-small p-2 rounded shadow-sm border">
                <div class="card-top-half">
                    <div class="card-top-text">
                        <span class="card-text">Savings</span>
                        <span class="card-text" id="savings-percent"></span>
                    </div>
                    <div></div>
                </div>
                <h5 id="savings-amount"></h5>
                <div class="card-bottom-half">
                    <div class="progress" id="savings-progress-budgeted" role="progressbar">
                        <div class="progress-bar" id="savings-progress-budgeted-bar"></div>
                    </div>
                    <div class="progress" id="savings-progress-real" role="progressbar">
                        <div class="progress-bar" id="savings-progress-actual-bar"></div>
                    </div>
                    <div class="card-bottom-text">
                        <span class="card-text"></span>
                        <span class="card-text"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<script defer>
    const budgeted_chart = new Chart(document.getElementById('budgeted-chart'), {
        type: 'doughnut',
        data: {
            datasets: [
                {
                    data: [],
                    backgroundColor: ["rgba(6, 95, 70, 0.75)", 'rgba(30, 58, 138, 0.75)', 'rgba(178,34,34, 0.75)']
                }
            ],
            labels: ['Savings', 'Needs', 'Wants'],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    // display: false
                }
            },
            cutout: '0%'
        }
    });

    const actual_chart = new Chart(document.getElementById('actual-chart'), {
        type: 'doughnut',
        data: {
            datasets: [
                {
                    data: [10, 30, 60],
                    backgroundColor: ["rgb(6, 95, 70)", 'rgb(30, 58, 138)', 'rgb(178,34,34)']
                }
            ],
            labels: ['Savings', 'Needs', 'Wants'],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            },
            cutout: '0%'
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        getBudgetedAmounts();
    });

    function getBudgetedAmounts() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                console.log(data);
                formatData(data);
            }
        };
        let query = "page=Budget&command=GetAmounts";
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function formatData(data) {
        let budgetedNeedsAmount = Number(data['needs_budget_total']);
        let budgetedWantsAmount = Number(data['wants_budget_total']);
        let budgetedSavingsAmount = Number(data['savings_budget_total']);
        console.log(budgetedSavingsAmount);

        let budgetTotal = budgetedNeedsAmount + budgetedWantsAmount + budgetedSavingsAmount;

        let actualNeedsAmount = Number(data['needs_actual_total']);
        let actualWantsAmount = Number(data['wants_actual_total']);
        let actualSavingsAmount = Number(data['savings_actual_total']);

        document.getElementById('wants-progress-budgeted-bar').style.width = (budgetedWantsAmount / budgetTotal).toFixed(4) * 100 + "%";
        document.getElementById('needs-progress-budgeted-bar').style.width = (budgetedNeedsAmount / budgetTotal).toFixed(4) * 100 + "%";
        document.getElementById('savings-progress-budgeted-bar').style.width = (budgetedSavingsAmount / budgetTotal).toFixed(4) * 100 + "%";

        let wantsBudgetSpent = Math.abs(actualWantsAmount / budgetedWantsAmount) * 100;
        document.getElementById('wants-percent').textContent = Math.abs(wantsBudgetSpent).toFixed(2) + "%";
        document.getElementById('wants-progress-actual-bar').style.width = Math.abs(wantsBudgetSpent * ((budgetedWantsAmount / budgetTotal).toFixed(4))) + "%";

        let needsBudgetSpent = Math.abs(actualNeedsAmount / budgetedNeedsAmount) * 100;
        document.getElementById('needs-percent').textContent = Math.abs(needsBudgetSpent).toFixed(2) + "%";
        document.getElementById('needs-progress-actual-bar').style.width = Math.abs(needsBudgetSpent * ((budgetedNeedsAmount / budgetTotal).toFixed(4))) + "%";

        let savingsBudgetSpent = Math.abs(actualSavingsAmount / budgetedSavingsAmount) * 100;
        document.getElementById('savings-percent').textContent = Math.abs(savingsBudgetSpent).toFixed(2) + "%";
        document.getElementById('savings-progress-actual-bar').style.width = Math.abs(savingsBudgetSpent * ((budgetedSavingsAmount / budgetTotal).toFixed(4))) + "%";

        document.getElementById('wants-amount').textContent = "$" + Math.abs(actualWantsAmount).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + " out of " + "$" + budgetedWantsAmount.toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
        document.getElementById('needs-amount').textContent = "$" + Math.abs(actualNeedsAmount).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + " out of " + "$" + budgetedNeedsAmount.toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
        document.getElementById('savings-amount').textContent = "$" + Math.abs(actualSavingsAmount).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + " out of " + "$" + budgetedSavingsAmount.toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

        budgeted_chart.data.datasets[0].data = [budgetedWantsAmount.toFixed(2), budgetedNeedsAmount.toFixed(2), budgetedSavingsAmount.toFixed(2)];
        budgeted_chart.update();

        actual_chart.data.datasets[0].data = [Math.abs(actualWantsAmount).toFixed(2), Math.abs(actualNeedsAmount).toFixed(2), Math.abs(actualSavingsAmount).toFixed(2)];
        actual_chart.update();
    }

    <?php include(__DIR__ . '/../js/modal-functions.js'); ?>

</script>