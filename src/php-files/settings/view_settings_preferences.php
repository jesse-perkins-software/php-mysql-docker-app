<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
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

        #content {
            margin-left: 15vw;
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
        #submit-btn {
            margin-top: 25vh;
        }
        #clearBtn, #lockBtn, #deleteBtn {
            width: 27%;
        }

        #content-container {
            height: 100vh;
            margin-left: 15vw;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: center;
        }

        #general-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 40%;
            padding: 1em;
            margin: 1em;
            gap: 0.75em;
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
            min-width: 4.5em;
        }

    </style>
</head>
<body class="bg-light">
    <?php require 'navigation.php'; ?>

    <div class="" id="content-container">
        <div class="rounded border shadow-sm" id="general-info">
            <h4>Account Preferences</h4>
            <form action="/controller.php" method="post" class="needs-validation info-form" id="" novalidate>
                <input type="hidden" name="page" value="Profile">
                <input type="hidden" name="command" value="GeneralInfo">

                <div class="input-group">
                    <span class="input-group-text" id="number-format-input">Number Format</span>
                    <select class="form-select" id="number-input">
                        <option selected>Choose...</option>
                        <option value="1">1,000</option>
                        <option value="2">1,000.00</option>
                        <option value="3">1.000</option>
                        <option value="3">1.000,00</option>
                    </select>
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="date-format-input">Date Format</span>
                    <select class="form-select" id="date-input">
                        <option selected>Choose...</option>
                        <option value="1">MM-DD-YYYY</option>
                        <option value="2">DD-MM-YYYY</option>
                        <option value="3">YYYY-MM-DD</option>
                    </select>
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="budget-period-input">Budget Period</span>
                    <select class="form-select" id="budget-input">
                        <option selected>Choose...</option>
                        <option value="1">Weekly</option>
                        <option value="2">Bi-Weekly</option>
                        <option value="3">Monthly</option>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" value="Save">
            </form>
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
</script>