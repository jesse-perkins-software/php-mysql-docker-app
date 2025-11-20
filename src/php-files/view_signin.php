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

        #content-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 1em;
            width: 25vw;
            margin-top: 20vh;
            background-color: white;
        }

        #loginForm {
            gap: 1em;
            width: 20vw;
        }

        #form-title {
            margin-top: 1em;
        }

        /*#err {*/
        /*    display: none;*/
        /*}*/


    </style>
</head>
<body class="bg-light">
    <div class="container shadow rounded" id="content-container">
        <h3 class="" id="form-title">Sign In</h3>
        <form id="loginForm" action="/controller.php" method="post" class="needs-validation" novalidate>
            <input type="hidden" name="page" value="SignInPage">
            <input type="hidden" name="command" value="SignIn">

            <div class="form-floating">
                <input type="text" class="form-control rounded-2" id="username" placeholder="Username" name="username" autocomplete="new-username" required>
                <label for="username" class="form-label">Username:</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control rounded-2" id="password" placeholder="Enter password" autocomplete="new-password" name="password" required>
                <label for="password" class="form-label">Password:</label>
<!--                <div class="invalid-feedback">-->
<!--                    Incorrect username or password.-->
<!--                </div>-->
            </div>

            <button type="submit" class="btn btn-primary mr-2">Sign In</button><br><br>
<!---->
<!--            <span id="err" class="container text-bg-danger rounded-3 p-2">User doesn't exist.</span>-->
        </form>
    </div>
    
    <div class="d-flex justify-content-center">
        <form action="/controller.php" method="post">
            <input type="hidden" name="page" value="SignInPage">
            <input type="hidden" name="command" value="SignUp">

            <button type="submit" class="btn fw-lighter"><u>Don't have an account? Click here to sign up</u></button>
        </form>
    </div>
</body>
</html>
<script defer>
    //let wrongUser =
    //    <?php //
    //        if (empty($wrong_user)) {
    //            $wrong_user = "false";
    //        }
    //        echo $wrong_user;
    //    ?>//;
    //
    //if (wrongUser) {
    //    document.getElementById("err").style.display = "inline";
    //}
    //
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