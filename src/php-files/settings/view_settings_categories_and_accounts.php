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

        #general-info {
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

        .add-button {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: end;
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
    <?php require 'navigation.php'; ?>

    <div class="" id="content-container">
        <div class="rounded border shadow-sm" id="general-info">
            <h4 class="section-title">Categories</h4>

            <div class="add-button">
                <button class="btn btn-primary" id="save-categories" data-bs-toggle="modal" data-bs-target="#newCategoryModal">Add</button>
            </div>
        </div>

        <!-- Add Category Model Starts -->
        <div class="modal fade" id="newCategoryModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="transaction-info">
                            <div class="input-group">
                                <span class="input-group-text" id="date-input">Category Group</span>
                                <select class="form-select" id="budget-input">
                                    <option selected>New Category Group</option>
                                    <option value="1">Home & Utilities</option>
                                    <option value="2">Food & Groceries</option>
                                    <option value="3">Transportation</option>
                                    <option value="4">Shopping & Personal</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text" id="email-input">New Category</span>
                                <input type="text" class="form-control" placeholder="Bus Fare">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Category Model Ends -->

        <div class="rounded border shadow-sm" id="general-info">
            <h4 class="section-title">Accounts</h4>
            <div class="row">
                <div class="col regular-accounts-container">
                    <h5>Banking</h5>
                    <div class="categories-list">
                        <p>CIBC Chequing Account</p>
                        <p>CIBC Savings Account</p>
                        <p>TD Credit Card</p>
                        <p>RBC TFSA</p>
                    </div>
                </div>
            </div>

            <div class="add-button">
                <button class="btn btn-primary" id="save-accounts" data-bs-toggle="modal" data-bs-target="#newAccountModal">Add</button>
            </div>

            <!-- Add Account Model Starts -->
            <div class="modal fade" id="newAccountModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">New Account</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="transaction-info">
                                <div class="input-group">
                                    <span class="input-group-text" id="date-input">Account Group</span>
                                    <select class="form-select" id="budget-input">
                                        <option selected>New Account Group</option>
                                        <option value="1">Banking</option>
                                        <option value="2">Investments</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text" id="email-input">New Account</span>
                                    <input type="text" class="form-control" placeholder="Credit Card (Costco)">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Account Model Ends -->
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
        //load_Accounts();
    });

    function fetch_Categories() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.responseText);
                load_Categories(data);
            }
        };
        let query = "page=Settings&command=LoadCategoriesAndAccounts";
        xhttp.open("POST", "/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function load_Categories(data) {
        console.log(data);

        let array = [];

        data.forEach(group => {
            let outerDiv = document.createElement('div');
            outerDiv.class = "col regular-accounts-container";

            let h5 = document.createElement('h5');
            let div = document.createElement('div');
            div.class = "categories-list";

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

        for (let i = 0; i < array.length; i++) {
            let row = document.createElement('div');
            row.className = 'row';

            row.appendChild(array[i]);

            document.getElementById('general-info').appendChild(row);
        }
    }
</script>