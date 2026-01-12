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

        #content {
            margin-left: var(--nav-bar-width);
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

        #content {
            margin-left: 15vw;
        }

        #content-container {
            height: 100vh;
            margin-left: var(--nav-bar-width);
            overflow-y: auto;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: start;
        }

        .general-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 50%;
            padding: 1em;
            margin: 1em;
        }

        .info-form {
            display: flex;
            flex-direction: column;
            gap: 0.5em;
            width: 100%;
        }

        .input-group-text {
            display: flex;
            justify-content: center;
            width: 8em;
        }

        .input-group {
            margin-bottom: 0.5em;
        }

        .section-title {
            margin-bottom: 1em;
        }

        .row {
            width: 100%;
            margin-bottom: 1em;
        }

        .col {
            width: 100%;
            margin: 0 auto;
        }

        .add-button {
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: end;
            justify-content: end;
            gap: 0.5em;
        }

        .categories-list {
            margin-left: 1em;
        }

        #save-categories {
            width: 4em;
        }

    </style>
</head>
<body class="bg-light">
    <?php require(__DIR__ . '/../navigation.php'); ?>

    <div class="" id="content-container">
        <div class="rounded border shadow-sm general-info" id="">
            <h4 class="section-title">Categories</h4>

            <div class="container" id="row-container"></div>

            <div class="add-button">
                <button class="btn btn-primary" id="save-categories" data-bs-toggle="modal" data-bs-target="#newCategoryModal">Add</button>
            </div>
        </div>

        <!-- Add Category Model Starts -->
        <div class="modal fade" id="newCategoryModal">
            <form action="/../controller/controller.php" method="post" class="needs-validation" novalidate>
                <input type="hidden" name="page" value="Settings">
                <input type="hidden" name="command" value="NewCategory">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">New Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="transaction-info">
                                <div class="input-group">
                                    <span class="input-group-text" id="category-input">Category</span>
                                    <select class="form-select select-category" id="category-options" name="category" aria-label="category-selection" required>
                                        <option value="" selected>Select...</option>
                                        <option value="new">New Category</option>

                                    </select>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text" id="new-category-input">Name</span>
                                    <input type="text" class="form-control" name="name" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Add Category Model Ends -->

        <div class="rounded border shadow-sm general-info" id="">
            <h4 class="section-title">Bank Accounts</h4>
            <div class="container" id="accounts-container"></div>

            <div class="add-button">
                <button class="btn btn-primary" id="save-accounts" data-bs-toggle="modal" data-bs-target="#newAccountModal">Add</button>
                <button class="btn btn-danger" id="save-accounts" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Delete</button>
            </div>

            <!-- Add Account Model Starts -->
            <div class="modal fade" id="newAccountModal">
                <form action="/../controller/controller.php" method="post" class="needs-validation" novalidate>
                    <input type="hidden" name="page" value="Settings">
                    <input type="hidden" name="command" value="NewAccount">

                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">New Account</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="transaction-info">
                                    <div class="input-group">
                                        <span class="input-group-text" id="account-input">Account</span>
                                        <select class="form-select select-category" id="account-options" name="account" aria-label="account-selection" required>
                                            <option value="" selected>Select...</option>
                                            <option value="new">New Account</option>

                                        </select>
                                    </div>
                                    <div class="input-group account-info" id="bank-name-input">
                                        <span class="input-group-text" id="new-bank-input">Bank</span>
                                        <input type="text" class="form-control" name="bank_name" placeholder="CIBC">
                                    </div>
                                    <div class="input-group account-info" id="bank-type-input">
                                        <span class="input-group-text" id="new-type-input">Type</span>
                                        <input type="text" class="form-control" name="account_type" placeholder="E.g. Savings">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Add Account Model Ends -->

            <!-- Delete Account Model Starts -->
            <div class="modal fade" id="deleteAccountModal">
                <form action="/../controller/controller.php" method="post" class="needs-validation" novalidate>
                    <input type="hidden" name="page" value="Settings">
                    <input type="hidden" name="command" value="DeleteAccount">

                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Account</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="transaction-info">
                                    <div class="input-group">
                                        <span class="input-group-text" id="account-input">Bank</span>
                                        <select class="form-select select-category" id="choose-bank-name" name="bank" required>
                                            <option value="" selected>Select...</option>

                                        </select>
                                    </div>
                                    <div class="input-group" id="delete-bank-type">
                                        <span class="input-group-text" id="new-type-input">Type</span>
                                        <select class="form-select select-category" id="choose-bank-account" name="account-type" required>
                                            <option value="" selected>Select...</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Delete Account Model Ends -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<script defer>
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

    function viewPage(page) {
        document.getElementById("command-value").value = page;
        document.getElementById("nav-form").submit();
    }

    document.addEventListener('DOMContentLoaded', function() {
        fetch_Categories();
        fetch_Accounts();
        get_category_options();
        get_account_options();
        document.querySelectorAll('.account-info').forEach(item => {
            item.style.display = "none";
        });
    });

    function get_category_options() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                data.forEach(option => {
                    let optionElement = document.createElement('option');
                    optionElement.value = option;
                    optionElement.innerHTML = option;

                    document.getElementById('category-options').appendChild(optionElement);
                });
            }
        };
        let query = "page=Settings&command=GetCategoryOptions";
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function fetchSelectedBankAccount(bank) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                console.log(data);
                data.forEach(option => {
                    let optionElement = document.createElement('option');
                    optionElement.value = option["typeName"];
                    optionElement.innerHTML = option["typeName"];

                    document.getElementById('choose-bank-account').appendChild(optionElement);
                });
            }
        };
        let query = "page=Settings&command=GetSelectedBankAccounts&selectedBank=" + bank;
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function get_account_options() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                data.forEach(option => {
                    let optionElement = document.createElement('option');
                    optionElement.value = option;
                    optionElement.innerHTML = option;

                    document.getElementById('account-options').appendChild(optionElement);
                    document.getElementById('choose-bank-name').appendChild(optionElement)
                });
                document.getElementById('account-options').addEventListener('change', event => {
                    const selectedAccount = event.target.value;
                    const bankType = document.getElementById('bank-type-input');
                    const bankName = document.getElementById('bank-name-input');

                    if (selectedAccount !== "new") {
                        bankType.style.display = "flex";
                        bankName.style.display = "none";
                    } else {
                        bankType.style.display = "flex";
                        bankName.style.display = "flex";
                    }
                });
                document.getElementById('choose-bank-name').addEventListener('change', selectedBank => {
                    fetchSelectedBankAccount(selectedBank.target.value);
                });
            }
        };
        let query = "page=Settings&command=GetAccountOptions";
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function fetch_Accounts() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                load_Accounts(data);
            }
        };
        let query = "page=Settings&command=LoadAccounts";
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function load_Accounts(data) {
        let array = [];

        data.forEach(group => {
            let outerDiv = document.createElement('div');
            outerDiv.className = "col regular-accounts-container";

            let h5 = document.createElement('h5');
            let div = document.createElement('div');
            div.className = "categories-list";

            let accountList = group['accounts'].split(", ");

            h5.innerHTML = group['bankName'];
            for (let i = 0; i < accountList.length; i++) {
                let p = document.createElement('p');
                p.innerHTML = accountList[i].replace(`${group['bankName']} `, "");
                div.appendChild(p);
            }

            outerDiv.appendChild(h5);
            outerDiv.appendChild(div);

            array.push(outerDiv);
        });

        while (array.length !== 0) {
            let row = document.createElement('div');
            row.className = 'row';
            row.appendChild(array.shift());
            if (array.length > 0) {
                row.appendChild(array.shift());
            }

            document.getElementById('accounts-container').appendChild(row);
        }
    }

    function fetch_Categories() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                load_Categories(data);
            }
        };
        let query = "page=Settings&command=LoadCategories";
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function load_Categories(data) {
        let array = [];

        data.forEach(group => {
            let outerDiv = document.createElement('div');
            outerDiv.className = "col regular-accounts-container";

            let h5 = document.createElement('h5');
            let div = document.createElement('div');
            div.className = "categories-list";

            let categoryList = group['categories'].split(", ");

            h5.innerHTML = group['groupName'];
            for (let i = 0; i < categoryList.length; i++) {
                let p = document.createElement('p');
                p.innerHTML = categoryList[i];
                div.appendChild(p);
            }

            outerDiv.appendChild(h5);
            outerDiv.appendChild(div);

            array.push(outerDiv);
        });

        while (array.length !== 0) {
            let row = document.createElement('div');
            row.className = 'row';
            row.appendChild(array.shift());
            if (array.length > 0) {
                row.appendChild(array.shift());
            }

            document.getElementById('row-container').appendChild(row);
        }
    }
</script>