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

        h1, h2, h3, h4, h5, h6, p, span {
            margin: 0;
            padding: 0;
        }

        #content-container {
            height: 100vh;
            margin-left: 15vw;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            justify-content: start;
            padding: 1em;
        }

        #nav-bar {
            width: 15vw;
        }

        .nav-link {
            width: 100%;
        }

        .nav-link:hover {
            background-color: #eee;
        }

        #accounts-container {
            display: flex;
            flex-direction: column;
            gap: 2em;
        }

        .accounts-a-tag {
            text-decoration: none;
            color: black;
            transition: transform 0.3s ease;
            width: 60vw;
        }

        .accounts-a-tag:hover {
            transform: scale(1.01);
        }

        .account {
            background-color: white;
        }

        .account-heading {
            padding: 1em;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }


        .account-details {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .transaction {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 0.25em 1em 0.25em 1em;
        }

        .transaction-details {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 20%;
        }

        .info-box-pos {
            color: green;
        }

        .info-box-neg {
            color: red;
        }

    </style>
</head>
<body>
    <?php require 'navigation.php'; ?>

    <div id="content-container" class="">
        <section class="" id="accounts-container">
            <a href="#" class="accounts-a-tag" onclick="viewPage('Accounts-Chequing')">
                <div class="account rounded shadow-sm border" id="account-1">
                    <div class="account-heading">
                        <div class="account-details">
                            <h4 class="account-type">Chequing</h4>
                            <p class="account-number">1234 5678 9012 3456</p>
                        </div>
                        <h4 class="account-amount">$14,000</h4>
                    </div>
                    <div class="account-transactions">
                        <div class="transaction border-bottom border-top">
                            <div class="transaction-details">
                                <p class="transaction-place">Earls</p>
                                <p class="transaction-date">Sep 22</p>
                            </div>
                            <p class="transaction-amount">-$150</p>
                        </div>
                        <div class="transaction border-bottom">
                            <div class="transaction-details">
                                <p class="transaction-place">Save On</p>
                                <p class="transaction-date">Sep 19</p>
                            </div>
                            <p class="transaction-amount">-$200</p>
                        </div>
                        <div class="transaction border-bottom">
                            <div class="transaction-details">
                                <p class="transaction-place">Dairy Queen</p>
                                <p class="transaction-date">Sep 18</p>
                            </div>
                            <p class="transaction-amount">-$15</p>
                        </div>
                    </div>
                </div>
            </a>

            <a href="#" class="accounts-a-tag" onclick="viewPage('Accounts-Savings')">
                <div class="account rounded shadow-sm border" id="account-1">
                    <div class="account-heading">
                        <div class="account-details">
                            <h4 class="account-type">Savings</h4>
                            <p class="account-number">2345 6789 0123 4567</p>
                        </div>
                        <h4 class="account-amount">$30,000</h4>
                    </div>
                    <div class="account-transactions">
                        <div class="transaction border-bottom border-top">
                            <div class="transaction-details">
                                <p class="transaction-place">London Drugs</p>
                                <p class="transaction-date">Sep 22</p>
                            </div>
                            <p class="transaction-amount">$800</p>
                        </div>
                        <div class="transaction border-bottom">
                            <div class="transaction-details">
                                <p class="transaction-place">Wendy's</p>
                                <p class="transaction-date">Sep 20</p>
                            </div>
                            <p class="transaction-amount">-$20</p>
                        </div>
                        <div class="transaction border-bottom">
                            <div class="transaction-details">
                                <p class="transaction-place">E-Transfer</p>
                                <p class="transaction-date">Sep 19</p>
                            </div>
                            <p class="transaction-amount">-$190</p>
                        </div>
                    </div>
                </div>
            </a>

            <a href="#" class="accounts-a-tag" onclick="viewPage('Accounts-Credit-Card')">
                <div class="account rounded shadow-sm border" id="account-1">
                    <div class="account-heading">
                        <div class="account-details">
                            <h4 class="account-type">Credit Card</h4>
                            <p class="account-number">5678 9012 3456 7890</p>
                        </div>
                        <h4 class="account-amount">-$2,000</h4>
                    </div>
                    <div class="account-transactions">
                        <div class="transaction border-bottom border-top">
                            <div class="transaction-details">
                                <p class="transaction-place">BC Hydro</p>
                                <p class="transaction-date">Sep 19</p>
                            </div>
                            <p class="transaction-amount">-$80</p>
                        </div>
                        <div class="transaction border-bottom">
                            <div class="transaction-details">
                                <p class="transaction-place">Shaw</p>
                                <p class="transaction-date">Sep 18</p>
                            </div>
                            <p class="transaction-amount">-$100</p>
                        </div>
                        <div class="transaction border-bottom">
                            <div class="transaction-details">
                                <p class="transaction-place">Car Insurance</p>
                                <p class="transaction-date">Sep 17</p>
                            </div>
                            <p class="transaction-amount">-$1,800</p>
                        </div>
                    </div>
                </div>
            </a>
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
