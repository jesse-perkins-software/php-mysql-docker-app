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
        <?php include 'global_variables.css' ?>

        #content-container {
            height: 100vh;
            margin-left: var(--nav-bar-width);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            justify-content: start;
            padding: 1em;
        }

        #nav-bar {
            width: var(--nav-bar-width);
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
            gap: 1em;
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
            width: 15em;
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

    <form action="controller.php" method="post" id="account-form">
        <input type="hidden" name="page" value="Accounts">
        <input type="hidden" name="command" value="" id="account-value"> <!-- Value changes depending on the nav button clicked -->
    </form>

    <div id="content-container" class="">
        <section class="" id="accounts-container">

        </section>
    </div>
</body>
<script defer>
    function viewPage(page) {
        document.getElementById("command-value").value = page;
        document.getElementById("nav-form").submit();
    }

    function viewAccount(accountName) {
        document.getElementById("account-value").value = accountName;
        document.getElementById("account-form").submit();
    }

    document.addEventListener('DOMContentLoaded', function() {
        fetchAccountDetails();
    });

    function fetchAccountDetails() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.responseText);
                generateAccountHeaders(data);
            }
        };
        let query = "page=Accounts&command=FetchAccountDetails";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function generateAccountHeaders(data) {
        console.log(data);

        let accounts_HTML = "";

        data['accountTotals'].forEach(account => {
            let account_transactions = data['accountDetails'].filter(transactions => transactions['accountName'] === account['accountName']);

            accounts_HTML += `
                <a href="#" class="accounts-a-tag" onclick="viewAccount('${account['accountName']}')">
                    <div class="account rounded shadow-sm border" id="account-1">
                        <div class="account-heading">
                            <div class="account-details">
                                <h4 class="account-type">${account['accountName']}</h4>
                                <p class="account-number"></p>
                            </div>
                            <h4 class="account-amount">${Number(account['total']).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</h4>
                        </div>
            `;

            accounts_HTML += `<div class="account-transactions">`;
            account_transactions.forEach(transaction => {
                accounts_HTML += `
                    <div class="transaction border-bottom border-top">
                            <div class="transaction-details">
                                <p class="transaction-place">${transaction['description']}</p>
                                <p class="transaction-date">${transaction['date']}</p>
                            </div>
                            <p class="transaction-amount">${Number(transaction['amount']).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</p>
                        </div>
                `;
            });

            accounts_HTML += `
                            </div>
                        </div>
                    </div>
                </a>
            `;
        });

        document.getElementById('accounts-container').innerHTML = accounts_HTML;
    }


</script>
</html>
