<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1, h2, h3, h4, h5, h6, p, span {
            margin: 0;
            padding: 0;
        }

        #nav-bar {
            width: 15vw;
        }

        #content {
            margin-left: 15vw;
            display: flex;
            flex-direction: column;
            height: 100vh;
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
            height: 0.75em;
        }

        .row {
            display: flex;
            flex-direction: column;
            flex: 1;
            margin: 1em;
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
            /*transform: scale(1.01);*/
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

        #content-container {
            height: 100vh;
            margin-left: 15vw;
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
        }

    </style>
</head>
<body>
    <?php require 'navigation.php'; ?>

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
                        <span class="card-text info-box-neg">300%</span>
                    </div>
                    <div></div>
                </div>
                <h5>$400</h5>
                <div class="card-bottom-half">
                    <div class="progress" role="progressbar">
                        <div class="progress-bar" style="width: 300%"></div>
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
                        <span class="card-text info-box-pos">100%</span>
                    </div>
                    <div></div>
                </div>
                <h5>$300</h5>
                <div class="card-bottom-half">
                    <div class="progress" role="progressbar">
                        <div class="progress-bar" style="width: 100%"></div>
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
                        <span class="card-text">20%</span>
                    </div>
                    <div></div>
                </div>
                <h5>$100</h5>
                <div class="card-bottom-half">
                    <div class="progress" role="progressbar">
                        <div class="progress-bar" style="width: 20%"></div>
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

    function viewPage(page) {
        document.getElementById("command-value").value = page;
        document.getElementById("nav-form").submit();
    }

</script>