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

        #general-info, #security-info {
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
            <h4>Personal Information</h4>
            <form action="/controller.php" method="post" class="needs-validation info-form" id="" novalidate>
                <input type="hidden" name="page" value="Profile">
                <input type="hidden" name="command" value="GeneralInfo">

                <div class="input-group">
                    <span class="input-group-text" id="username-input">Username</span>
                    <input type="text" class="form-control" placeholder="johndoe">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="name-input">Name</span>
                    <input type="text" class="form-control" placeholder="John">
                    <input type="text" class="form-control" placeholder="Doe">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="email-input">Email</span>
                    <input type="email" class="form-control" placeholder="johndoe@gmail.com">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="phone-input">Phone Number</span>
                    <input type="tel" class="form-control" placeholder="###-###-####">
                </div>

                <input type="submit" class="btn btn-primary" value="Save">
            </form>
        </div>

        <div class="rounded border shadow-sm" id="security-info">
            <h4>Security</h4>
            <form action="/controller.php" method="post" class="needs-validation info-form" id="" novalidate>
                <input type="hidden" name="page" value="Profile">
                <input type="hidden" name="command" value="SecurityInfo">

                <div class="input-group">
                    <span class="input-group-text" id="password-input">New Password</span>
                    <input type="password" class="form-control" placeholder="password">
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