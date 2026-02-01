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

        #savings-container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: start;
            gap: 10%;
            padding: 1em 0 0 1em;
        }

        #set-actual-savings-budget-form, #set-expected-savings-budget-form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 0.5em;
            padding: 1em;
        }

        #form-save {
            margin-top: 0.5em;
        }

        .budget-titles {
            font-size: 2em;
            text-align: center;
        }

        .input-group-text.label {
            width: 9em;
            text-align: center;
        }

        .expected-categories {
            display: flex;
            flex-direction: column;
            gap: 0.5em;
        }

    </style>
</head>
<body>
    <?php require(__DIR__ . '/../navigation.php'); ?>

    <div class="" id="content-container">
        <div id="savings-container">
            <div class="border shadow-sm rounded" id="set-expected-savings">
                <form action="/../controller/controller.php" method="post" class="needs-validation info-form" id="set-expected-savings-budget-form" novalidate>
                    <input type="hidden" name="page" value="Transactions">
                    <input type="hidden" name="command" value="SetExpectedSavings">

                    <p class="budget-titles">Expected</p>

                    <div class="expected-categories" id="expected-categories"></div>

                    <div class="input-group">
                        <span class="input-group-text label">Total</span>
                        <span class="input-group-text">$</span>
                        <input type="text" id="expected-total" class="form-control" disabled>
                    </div>

                    <input type="submit" id="form-save" class="btn btn-primary" value="Save">
                </form>
            </div>

            <div class="border shadow-sm rounded" id="set-actual-savings">
                <form action="/../controller/controller.php" method="post" class="needs-validation info-form" id="set-actual-savings-budget-form" novalidate>
                    <input type="hidden" name="page" value="Transactions">
                    <input type="hidden" name="command" value="SetActualSavings">

                    <p class="budget-titles">Actual</p>

                    <div class="expected-categories" id="actual-categories"></div>

                    <div class="input-group">
                        <span class="input-group-text label">Total</span>
                        <span class="input-group-text">$</span>
                        <input type="text" id="actual-total" class="form-control" placeholder="30,000" value="3,000" disabled>
                    </div>
                </form>
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        loadSavingsCategories();
    });

    function loadSavingsCategories() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                formatCategories(data);
            }
        };
        let query = "page=Budget&command=LoadSavingsCategories&budgetCategory=Savings";
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateExpectedTotal() {
        let inputs = document.querySelectorAll('#expected-categories input');
        let total = 0;

        inputs.forEach(input => {
            let val = parseFloat(input.value.replace(/,/g, ''));
            if (!isNaN(val)) {
                total += val;
            }
        });

        document.getElementById('expected-total').value = total.toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function formatInput(category) {
        let amount = parseFloat(document.getElementById(category).value.replace(/,/g, ''));
        if (!isNaN(amount)) {
            document.getElementById(category).value = Number(amount).toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }
    }

    function formatCategories(data) {
        let containers = document.querySelectorAll(".expected-categories");

        containers.forEach(container => {
            let div = "";

            if (container.id === "actual-categories") {
                let total = 0;

                data.forEach(item => {
                    let category = item['categoryName'];
                    let amount = Number(item['amount']).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    total += Number(item['amount']);
                    document.getElementById('actual-total').value = total.toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    div += `
                    <div class="input-group">
                        <span class="input-group-text label">${category}</span>
                        <span class="input-group-text">$</span>
                        <input type="text" class="form-control" value=${amount} disabled>
                    </div>
                    `;
                });
                container.innerHTML += div;
            } else {
                data.forEach(item => {
                    let category = item['categoryName'];

                    div += `
                    <div class="input-group">
                        <span class="input-group-text label">${category}</span>
                        <span class="input-group-text">$</span>
                        <input type="text" class="form-control" id=${category} onblur="formatInput('${category}')" onkeyup="updateExpectedTotal()">
                    </div>
                    `;
                });
                container.innerHTML += div;
            }
        });
    }


    <?php include(__DIR__ . '/../js/modal-functions.js'); ?>
</script>