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
        <?php include(__DIR__ . '/../view/css/global_variables.css'); ?>

        .container {
            height: 100vh;
        }

        #nav-bar {
            width: var(--nav-bar-width);
        }

        #content-container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            overflow-y: auto;
        }

        #graphs-charts-content {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .graph {
            height: 47.5%;
            padding: 1em 1.5em 3em 1.5em;
            text-align: center;
        }

        #card-small-content {
            display: flex;
            flex-direction: column;
            flex: 1;
            margin-left: var(--nav-bar-width);
        }

        .row {
            display: flex;
            flex: 1;
        }

        canvas {
            display: flex;
        }

        #first-chart {
            margin-bottom: 1.5em;
        }

        .progress {
            height: 0.5em;
        }

        #new {
            width: 8vw;
        }

        #dash-container {
            min-width: 100%;
        }

        .nav-link {
            width: 100%;
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
            transition: transform 0.3s ease;
        }

        .card-small:hover {
            transform: scale(1.05);
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
            color: var(--green_text);
        }

        .info-box-neg {
            color: var(--red_text);
        }

        canvas {
            padding-top: 0.75em;
        }

    </style>
</head>
<body>
    <?php require 'navigation.php'; ?>

    <div id="content-container">
        <div class="container" id="card-small-content">
            <div class="row p-3 gap-4"> <!-- This is the div for an entire row on the dashboard page -->

                <!-- Here is the overall structure for a small dashboard card. -->
                <div class="col card-small p-2 rounded shadow-sm border" id="current-balance-card">
                    <div class="card-top-half"> <!-- Top half of the card -->
                        <div class="card-top-text"> <!-- Text for the top of the card -->
                            <span class="card-text">Current Balance</span> <!-- Top right corner -->
                            <span class="card-text info-box-pos "></span> <!-- Top left corner -->
                        </div>
                        <div></div> <!-- Just in case I want to add anything else here later -->
                    </div>

                    <h5 id="current-balance-total"></h5> <!-- The primary statistic (dollar amount, percentage, etc.) -->

                    <div class="card-bottom-half"> <!-- Bottom half of the card -->
                        <div></div> <!-- Just in case I want to add anything else here later -->
                        <div class="card-bottom-text"> <!-- Text for the bottom of the card -->
                            <span class="card-text">All Accounts</span> <!-- Bottom right corner -->
                            <span class="card-text">As of today</span> <!-- Bottom left corner -->
                        </div>
                    </div>
                </div>

                <div class="col card-small p-2 rounded shadow-sm border" id="week-spending-card">
                    <div class="card-top-half">
                        <div class="card-top-text">
                            <span class="card-text">7 Day Spending</span>
                            <span class="card-text info-box-neg"></span>
                        </div>
                        <div></div>
                    </div>
                    <h5 id="week-spending-total"></h5>
                    <div class="card-bottom-half">
                        <div></div>
                        <div class="card-bottom-text">
                            <span id="week-spending-start-date" class="card-text"></span>
                            <span class="card-text"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-3 gap-4">
                <div class="col card-small p-2 rounded shadow-sm border" id="month-spending-card">
                    <div class="card-top-half">
                        <div class="card-top-text">
                            <span class="card-text">30 Day Spending</span>
                            <span class="card-text info-box-pos"></span>
                        </div>
                        <div></div>
                    </div>
                    <h5 id="month-spending-total"></h5>
                    <div class="card-bottom-half">
                        <div></div>
                        <div class="card-bottom-text">
                            <span id="month-spending-start-date" class="card-text"></span>
                            <span class="card-text"></span>
                        </div>
                    </div>
                </div>
                <div class="col card-small p-2 rounded shadow-sm border" id="most-recent-purchase-card">
                    <div class="card-top-half">
                        <div class="card-top-text">
                            <span class="card-text">Most Recent Purchase</span>
                            <span class="card-text" id="most-recent-date"></span>
                        </div>
                        <div></div>
                    </div>
                    <h5 id="most-recent-amount"></h5>
                    <div class="card-bottom-half">
                        <div></div>
                        <div class="card-bottom-text">
                            <span class="card-text" id="most-recent-description">@</span>
                            <span class="card-text"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-3 gap-4">
                <div class="col card-small p-2 rounded shadow-sm border" id="top-transaction-category-card">
                    <div class="card-top-half">
                        <div class="card-top-text">
                            <span class="card-text">Top Transaction Category</span>
                            <span class="card-text">Sep</span>
                        </div>
                        <div></div>
                    </div>
                    <h5>Groceries</h5>
                    <div class="card-bottom-half">
                        <div></div>
                        <div class="card-bottom-text">
                            <span class="card-text">$450</span>
                            <span class="card-text">As of today</span>
                        </div>
                    </div>
                </div>
                <div class="col card-small p-2 rounded shadow-sm border" id="budget-spent-card">
                    <div class="card-top-half">
                        <div class="card-top-text">
                            <span class="card-text">Budget Spent</span>
                            <span class="card-text">87%</span>
                        </div>
                        <div></div>
                    </div>
                    <h5>$4,350</h5>
                    <div class="card-bottom-half">
                        <div class="progress" role="progressbar">
                            <div class="progress-bar" style="width: 87%"></div>
                        </div>
                        <div class="card-bottom-text">
                            <span class="card-text">Sep</span>
                            <span class="card-text"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-3 gap-4">
                <div class="col card-small p-2 rounded shadow-sm border" id="biggest-purchase-card">
                    <div class="card-top-half">
                        <div class="card-top-text">
                            <span class="card-text">Biggest Purchase</span>
                            <span class="card-text">Nov</span>
                        </div>
                        <div></div>
                    </div>
                    <h5 id="biggest-purchase-value"></h5>
                    <div class="card-bottom-half">
                        <div></div>
                        <div class="card-bottom-text">
                            <span class="card-text">@ BestBuy</span>
                            <span class="card-text">As of today</span>
                        </div>
                    </div>
                </div>
                <div class="col card-small p-2 rounded shadow-sm border" id="payday-countdown-card">
                    <div class="card-top-half">
                        <div class="card-top-text">
                            <span class="card-text">Payday Countdown</span>
                            <span class="card-text">Nov</span>
                        </div>
                        <div></div>
                    </div>
                    <h5>3 Days</h5>
                    <div class="card-bottom-half">
                        <div></div>
                        <div class="card-bottom-text">
                            <span class="card-text"></span>
                            <span class="card-text"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" id="graphs-charts-content">
            <div class="graph" id="top-half">
                <h2>Monthly Spending</h2>
                <canvas id="first-chart"></canvas>
            </div>
            <div class="graph" id="bottom-half">
                <h2>Yearly Spending</h2>
                <canvas id="second-chart"></canvas>
            </div>
        </div>
    </div>
</body>
<script defer>
    const first_chart = new Chart(document.getElementById('first-chart'), {
        type: 'doughnut',
        data: {
            datasets: [
                {
                    data: [50, 30, 20],
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

    const second_chart = new Chart(document.getElementById('second-chart'), {
        data: {
            datasets: [
                {
                    type: "bar",
                    label: "Savings",
                    data: [50, 25, 42.5, 105, 75, 87.5, 80, 37.5, 55, 60, 45, 65],
                    backgroundColor: "rgb(6, 95, 70)",
                    borderColor: "rgb(6, 95, 70, 0.5)",
                    tension: 0,
                    order: 1
                },
                {
                    type: "bar",
                    label: "Needs",
                    data: [35, 15, 32.5, 75, 50, 57.5, 60, 22.5, 35, 30, 25, 45],
                    backgroundColor: "rgb(30, 58, 138)",
                    borderColor: "rgb(30, 58, 138, 0.5)",
                    tension: 0,
                    order: 1
                },
                {
                    type: "bar",
                    label: "Wants",
                    data: [20, 10, 10, 30, 25, 30, 20, 15, 20, 15, 20, 20],
                    backgroundColor: "rgb(178, 34, 34)",
                    borderColor: "rgb(178, 34, 34, 0.5)",
                    tension: 0,
                    order: 1
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
            },
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    title: {
                        display: false,
                        text: 'Amount (CAD)',
                        font: {
                            size: 15
                        }
                    },
                    stacked: true,
                }
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        load_Card1_Info();
        load_Card2_Info();
        load_Card3_Info();
        load_Card4_Info();
        //load_Card5_Info();
        //load_Card6_Info();
        load_Card7_Info();
        //load_Card8_Info();
    });

    function load_Card1_Info() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('current-balance-total').innerHTML = "$" + Number(this.responseText).toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }
        };
        let query = "page=MainPage&command=LoadCard1";
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function load_Card2_Info() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let weeklyTotal = document.getElementById('week-spending-total');
                if (this.responseText === "") {
                    weeklyTotal.innerHTML = "$0";
                } else {
                    if (this.responseText > 0) {
                        weeklyTotal.innerHTML = "$" + Number(this.responseText).toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    } else if (this.responseText < 0) {
                        weeklyTotal.innerHTML = "$(" + Math.abs(Number(this.responseText)).toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + ")";
                    }
                }
                let today = new Date();
                let sevenDaysAgo = new Date();
                sevenDaysAgo.setDate(today.getDate() - 7);
                sevenDaysAgo = sevenDaysAgo.toLocaleString('en-CA', { month: 'short', day: 'numeric' });
                document.getElementById('week-spending-start-date').innerHTML = `Since ${sevenDaysAgo} `;
            }
        };
        let query = "page=MainPage&command=LoadCard2";
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function load_Card3_Info() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let monthlyTotal = document.getElementById('month-spending-total');
                if (this.responseText === "") {
                    monthlyTotal.innerHTML = "$0";
                } else {
                    if (this.responseText > 0) {
                        monthlyTotal.innerHTML = "$" + Number(this.responseText).toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    } else if (this.responseText < 0) {
                        monthlyTotal.innerHTML = "$(" + Math.abs(Number(this.responseText)).toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + ")";
                    }
                }
                let today = new Date();
                let thirtyDaysAgo = new Date();
                thirtyDaysAgo.setDate(today.getDate() - 30);
                thirtyDaysAgo = thirtyDaysAgo.toLocaleString('en-CA', { month: 'short', day: 'numeric' });
                document.getElementById('month-spending-start-date').innerHTML = `Since ${thirtyDaysAgo} `;
            }
        };
        let query = "page=MainPage&command=LoadCard3";
        xhttp.open("POST", "/../controller/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function load_Card4_Info() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let recentPurchaseAmount = document.getElementById('most-recent-amount');
                let recentPurchaseDate = document.getElementById('most-recent-date');
                let recentPurchaseDescription = document.getElementById('most-recent-description');

                let data = JSON.parse(this.responseText);
                let transaction = data[0];

                if (Object.keys(data).length === 0) {
                    recentPurchaseAmount.innerHTML = "$0";
                    const date = new Date();
                    recentPurchaseDate.innerHTML = date.toLocaleDateString('en-CA', { month: 'short', day: 'numeric' });
                    recentPurchaseDescription.innerHTML = "@ ";
                } else {
                    if (transaction.amount > 0) {
                        recentPurchaseAmount.innerHTML = "$" + Number(transaction.amount).toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    } else if (transaction.amount < 0) {
                        recentPurchaseAmount.innerHTML = "$(" + Math.abs(Number(transaction.amount)).toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + ")";
                    } else {
                        recentPurchaseAmount.innerHTML = "$0";
                    }
                    const date = new Date(transaction['date']);
                    recentPurchaseDate.innerHTML = date.toLocaleDateString('en-CA', { month: 'short', day: 'numeric' });
                    recentPurchaseDescription.innerHTML = "@ " + transaction['description'];
                }
            }
        };
        let query = "page=MainPage&command=LoadCard4";
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function load_Card7_Info() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = this.responseText;

                document.getElementById('biggest-purchase-value').innerHTML = "$" + Number(this.responseText).toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }
        };
        let query = "page=MainPage&command=LoadCard7";
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }


    // Saving so that I can use this as a template for AJAX requests
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
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    //----- Search Bar AJAX Request Example
    function searchTransactions(string) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let newData = JSON.parse(this.responseText);
                makeTable(newData);
            }
        };
        let query = "page=History&command=UpdateSearch&SearchStr=" + string;
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

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
            str += "<tr id='rows'>";

            for (let j in data[i]) {
                if (j != "Id") {
                    if (j == "Amount") {
                        if (data[i]["Category"] == "Income") {
                            str += "<td class='fs-5 text-success'>$" + data[i][j] + "</td>";
                        } else {
                            str += "<td class='fs-5 text-danger'>$" + data[i][j] + "</td>";
                        }
                    } else {
                        str += "<td class='fs-5'>" + data[i][j] + "</td>";
                    }
                }

            }
            str += "<td class='fit-btn-content text-center' id='buttons'>" + "<button data-id='" + data[i]["Id"] + "' class='btn btn-secondary w-75 fs-5 mb-2' data-label='edit' data-bs-toggle='modal' data-bs-target='#transactionModal'>Edit</button>" + "<button data-label='delete' data-id='" + data[i]["Id"] + "' class='btn btn-danger w-75 fs-5'>Delete</button>" + "</td>";


            str += "</tr>";
            str += "</tbody>";
        }

        str += "</table>";

        document.getElementById("history").innerHTML = str;

        document.querySelectorAll("button[data-id]").forEach(function(eobj) {
            eobj.addEventListener("click", function() {
                let xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let newData = JSON.parse(this.responseText);
                        makeTable(newData);
                    }
                };
                let id = this.getAttribute("data-id");
                if (this.getAttribute("data-label") == "delete") {
                    let query = "page=History&command=RefreshTable&DeleteId=" + id;
                    xhttp.open("POST", "/../controller/controller.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send(query);
                } else if (this.getAttribute("data-label") == "edit") {
                    let id = this.getAttribute("data-id");
                    console.log("ID: " + id);
                    document.getElementById("editId").value = id;
                }
            });
        });

        return str;
    }


    <?php include(__DIR__ . '/../js/modal-functions.js'); ?>
</script>
</html>
