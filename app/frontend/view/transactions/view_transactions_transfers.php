<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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

        #content-container {
            height: 100vh;
            margin-left: var(--nav-bar-width);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            justify-content: start;
        }

        #account-transactions {
            padding-bottom: 2em;
        }

        #account-type {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        #account-name {
            display: flex;
            flex-direction: row;
            padding: 1em 1em 1em 1em;
        }

        #account-amount {
            padding: 1em 1em 1em 1em;
        }

        h4 {
            font-size: 1.5em;
        }

        #account-name span {
            opacity: 75%;
            font-weight: normal;
            font-size: 0.6em;

            padding-top: 0.55em;
        }

        #account-header {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        #account-name span:nth-child(1) {
            padding-left: 0.5em;
        }

        .container {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .row, [class*='col'] {
            margin: 0;
            padding: 0;
        }

        .row {
            margin: 0 1em 0 1em;
            padding: 0.15em 0 0.15em 0;
        }

        .row.individual-transactions {
            color: black;
        }

        .row:nth-child(even) {
            background-color: #f5f5f5;
        }

        .row:hover {
            background-color: #f5f5f5;
        }

        [class*='col']:nth-child(1) {
            padding-left: 1em;
        }

        [class*='col']:nth-child(5) {
            padding-right: 1em;
        }

        .transaction-info {
            margin-bottom: 1em;
        }

        .input-group-text {
            width: 22.5%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .text-green {
            color: var(--green_text);
        }

        .text-red {
            color: var(--red_text);
        }

        .modal-footer {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

    </style>
</head>
<body>
    <?php require(__DIR__ . '/../navigation.php'); ?>

    <div class="" id="content-container">

        <div class="" id="account-header">
            <div id="account-type">
                <h4 id="account-name">Transfers</h4>
                <button onclick="clearTransactionData()" class="btn btn-secondary" id="new-transaction-button" data-bs-toggle="modal" data-bs-target="#newTransactionModel">+ New Transaction</button>
            </div>
            <h4 id="account-amount"></h4>
        </div>

        <?php require(__DIR__ . '/../modals/new_transaction_modal.php'); ?>

        <?php require(__DIR__ . '/../modals/edit_transaction_modal.php'); ?>

        <div class="" id="account-transactions">
            <div class="container" id="transactions-container">
                <div class="row border-bottom border-top" id="transaction-column-titles">
                    <div class="col">Date</div>
                    <div class="col-3">Description</div>
                    <div class="col">Amount</div>
                    <div class="col-2">Account</div>
                    <div class="col">Category</div>
                    <div class="col-3">Notes</div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<script defer>
    //----- Form Validation -----
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.Savings-validation')

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

    function submitAction(action) {
        document.getElementById('action-input').value = action;
        document.getElementById('editTransactionForm').submit();
    }

    function viewPage(page) {
        document.getElementById("command-value").value = page;
        document.getElementById("nav-form").submit();
    }

    document.addEventListener('DOMContentLoaded', function() {
        fetchTransactions();
        fetchCategorySelectionOptions();
        fetchAccounts();
        document.getElementById('subpage-new-transactions').value = "Transfers";
        document.getElementById('subpage-edit-transactions').value = "Transfers";
    });

    function fetchTransactions() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.responseText);
                makeTransactions(data);
            }
        };
        let query = "page=Transactions&command=FetchTransactions&subpage=Transfers";
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    <?php include(__DIR__ . '/../js/modal-functions.js'); ?>

</script>