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

        #err-msg {
            display: none;
        }

        #content-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 1em;
            width: 50vw;
            margin-top: 15vh;
            background-color: white;
        }

        /*#signUpForm {*/
        /*    display: flex;*/
        /*    flex-direction: column;*/
        /*    gap: 1em;*/
        /*    width: 40vw;*/
        /*    margin-bottom: 2em;*/
        /*}*/

        #signUpForm {
            display: flex;
            justify-content: center;
        }

        #form-title {
            margin-top: 1em;
        }

        #sign-up-container {
            margin-bottom: 1em;
        }

    </style>
</head>
<body class="bg-light">
    <div class="container bg-white shadow rounded-3" id="content-container">
        <h3 id="form-title">Please Fill In The Form To Make An Account With Us</h3>
        <form id="signUpForm" action="../controller/controller.php" method="post" class="needs-validation p-3 row" novalidate>
            <input type="hidden" name="page" value="SignUpPage">
            <input type="hidden" name="command" value="SignedUp">

            <div class="col-md-6">
                <label for="inputFirstName" class="form-label">First Name</label>
                <input type="text" name="firstName" class="form-control" id="inputFirstName">
            </div>
            <div class="col-md-6">
                <label for="inputLastName" class="form-label">Last Name</label>
                <input type="text" name="lastName" class="form-control" id="inputLastName">
            </div>

            <div class="col-12 pt-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="">
            </div>

            <div class="col-md-6 pt-3 pb-5">
                <label for="inputUsername" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="inputUsername">
            </div>
            <div class="col-md-6 pt-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword">
            </div>

            <div id="sign-up-container">
                <button type="submit" class="btn btn-primary" id="signUpBtn">Sign Up</button>
            </div>


            <label class="fw-lighter bg-danger-subtle text-danger border border-danger p-1 mt-2 rounded-2" id="err-msg">That username already exists.</label>
        </form>
    </div>

    <div class="d-flex justify-content-center">
        <form action="../controller/controller.php" method="post">
            <input type="hidden" name="page" value="SignUpPage">
            <input type="hidden" name="command" value="SignIn">

            <button type="submit" class="btn fw-lighter"><u>Already have an account? Click here to sign in</u></button>
        </form>
    </div>
</body>
</html>
<script defer>
    //----- Form Validation -----
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
</script>