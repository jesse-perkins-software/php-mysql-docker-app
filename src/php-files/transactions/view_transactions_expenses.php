<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        <?php include 'global_variables.css' ?>

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
        }    </style>
</head>
<body>
    <?php require 'navigation.php'; ?>

    <div class="" id="content-container">

        <div class="" id="account-header">
            <div id="account-type">
                <h4 id="account-name">Expenses</h4>
                <button onclick="clearTransactionData()" class="btn btn-secondary" id="new-transaction-button" data-bs-toggle="modal" data-bs-target="#newTransactionModel">+ New Transaction</button>
            </div>
            <h4 id="account-amount"></h4>
        </div>

        <?php require 'new_transaction_modal.php'; ?>

        <?php require 'edit_transaction_modal.php'; ?>

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

    function viewPage(page) {
        document.getElementById("command-value").value = page;
        document.getElementById("nav-form").submit();
    }

    function makeTransactions(data) {
        let transactionData = data;

        let total_amount = 0;
        for (let i = 0; i < transactionData.length; i++) {
            let div = document.createElement('div');
            div.className = "row border-bottom individual-transactions";
            div.id = transactionData[i]['transactionID'];

            let dateColumn = document.createElement('div');
            dateColumn.className = "col";
            dateColumn.textContent = transactionData[i]['date'];
            dateColumn.value = transactionData[i]['date'];

            let descriptionColumn = document.createElement('div');
            descriptionColumn.className = "col-3";
            descriptionColumn.textContent = transactionData[i]['description'];
            descriptionColumn.value = transactionData[i]['description'];

            let amountColumn = document.createElement('div');
            let amount = Number(transactionData[i]['amount']);
            if (amount < 0) {
                amountColumn.className = "col individual-transaction-amount text-red";
                amountColumn.textContent = "($" + Math.abs(amount).toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + ")";
                amountColumn.value = transactionData[i]['amount'];
            } else {
                amountColumn.className = "col individual-transaction-amount text-green";
                amountColumn.textContent = "$" + amount.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                amountColumn.value = transactionData[i]['amount'];
            }
            total_amount += amount;

            let accountColumn = document.createElement('div');
            accountColumn.className = "col-2";
            accountColumn.textContent = transactionData[i]['accountName'];
            accountColumn.value = transactionData[i]['accountName'];

            let categoryColumn = document.createElement('div');
            categoryColumn.className = "col";
            categoryColumn.textContent = transactionData[i]['groupName'];
            categoryColumn.value = transactionData[i]['groupName'];

            let notesColumn = document.createElement('div');
            notesColumn.className = "col-3";
            notesColumn.textContent = transactionData[i]['notes'];
            notesColumn.value = transactionData[i]['notes'];

            div.appendChild(dateColumn);
            div.appendChild(descriptionColumn)
            div.appendChild(amountColumn);
            div.appendChild(accountColumn);
            div.appendChild(categoryColumn);
            div.appendChild(notesColumn);

            div.addEventListener('click', function() {
                let transaction = transactionData[i];
                console.log(div.id);

                document.getElementById('transaction-id').value = div.id;
                document.getElementById('date-edit').value = transaction['date'];
                document.getElementById('category-edit').value = transaction['groupName'];
                document.getElementById('account-edit').value = transaction['accountName'];
                document.getElementById('amount-edit').value = transaction['amount'];
                document.getElementById('notes-edit').value = transaction['notes'];

                fetchDescriptionForEdit(transaction['groupName'], transaction['description']);


                let modal = new bootstrap.Modal(document.getElementById('editTransactionModel'));
                modal.show();
            });

            document.getElementById('transactions-container').appendChild((div));

        }
        document.getElementById('account-amount').textContent = "$" + total_amount.toLocaleString();
    }

    function fetchTransactions() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.responseText);
                makeTransactions(data);
            }
        };
        let query = "page=Transactions&command=FetchTransactions&subpage=Expenses";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function assignCategories(data) {
        let categoryOptions = document.querySelectorAll('.select-category');

        categoryOptions.forEach(field => {
            for (let i = 0; i < data.length; i++) {
                let categoryOption = document.createElement('option');
                categoryOption.textContent = data[i];
                categoryOption.value = data[i];
                field.appendChild(categoryOption);
            }

            field.addEventListener('change', (event) => {
                const selectedCategory = event.target.value;
                let descriptionOptions;

                descriptionOptions = document.querySelectorAll('.select-description');
                descriptionOptions.forEach(i => {
                    i.replaceChildren(i.options[0]);
                });

                fetchDescriptionSelectionOptions(selectedCategory);
            });
        });
    }

    function fetchCategorySelectionOptions() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.responseText);
                assignCategories(data);
            }
        };
        let query = "page=Transactions&command=FetchCategorySelectionOptions";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function assignDescriptions(data) {
        let descriptionOptions = document.querySelectorAll('.select-description');

        descriptionOptions.forEach(field => {
            for (let i = 0; i < data.length; i++) {
                let descriptionOption = document.createElement('option');
                descriptionOption.textContent = data[i];
                descriptionOption.value = data[i];
                field.appendChild(descriptionOption);
            }
        });
    }

    function fetchDescriptionSelectionOptions(selectedCategory) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.responseText);
                assignDescriptions(data);
            }
        };

        let query = "page=Transactions&command=FetchDescriptionSelectionOptions&selectedCategory=" + selectedCategory;
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function addAccountOptions(data) {
        let accountOptions = document.querySelectorAll(".select-account");

        accountOptions.forEach(field => {
            for (let i = 0; i < data.length; i++) {
                let accountOption = document.createElement('option');
                accountOption.textContent = data[i];
                accountOption.value = data[i];
                field.appendChild(accountOption);
            }
        });
    }

    function fetchAccounts() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.responseText);
                addAccountOptions(data);
            }
        };
        let query = "page=Transactions&command=FetchAccountOptions";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function clearTransactionData() {
        document.getElementById('date-entry').value = "";
        document.getElementById('category-options').value = "";
        document.getElementById('description-options').value = "";
        document.getElementById('account-options').value = "";
        document.getElementById('amount-entry').value = "";
        document.getElementById('notes-entry').value = "";

        let baseOption = document.createElement('option');
        baseOption.textContent = "Select...";
        baseOption.setAttribute('value', "");

        document.getElementById('description-options').replaceChildren(baseOption);
    }

    function fetchDescriptionForEdit(selectedCategory, descriptionValue) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.responseText);
                let descriptionOptions = document.getElementById('description-edit');
                descriptionOptions.replaceChildren();

                let baseOption = document.createElement('option');
                baseOption.textContent = "Select...";
                baseOption.value = "";
                descriptionOptions.appendChild(baseOption);

                assignDescriptions(data);

                document.getElementById('description-edit').value = descriptionValue;
            }
        };

        let query = "page=Transactions&command=FetchDescriptionSelectionOptions&selectedCategory=" + selectedCategory;
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    document.addEventListener('DOMContentLoaded', function() {
        fetchTransactions();
        fetchCategorySelectionOptions();
        fetchAccounts();
        document.getElementById('subpage-value').value = "Expenses";
    });

    function submitAction(action) {
        document.getElementById('action-input').value = action;
        document.getElementById('editTransactionForm').submit();
    }
</script>