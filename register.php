<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>

    <link rel="icon" href="./resources/icon.svg">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>

<body style="background-image: linear-gradient(to right top, #274f8b, #3969a4, #4d84be, #62a0d7, #78bcf0);">

    <div class="container-fluid vh-100 d-flex">
        <div class="row align-items-center w-100 justify-content-center">
            <div class="col-6 text-center">
                <div class="form-signin border border-1 rounded w-100 m-auto bg-white d-none" id="signin">
                    <img class="mb-4" src="resources/logo.webp" height="100px">

                    <h1 class="h3 mb-3 fw-normal text-uppercase fw-bold">Register</h1>

                    <div class="text-danger d-none" id="msgdiv">
                        <span id="msg"></span>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" placeholder="name@example.com">
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                        <label for="password">Password</label>
                    </div>

                    <button class="w-100 mt-3 btn btn-lg btn-primary" type="submit" onclick="signUp();">Register</button>
                    <a class="w-100 mb-5 mt-3 link-primary text-decoration-none" onclick="toggleView();" type="submit">Switch to Log in</a>
                </div>

                <?php

                $email = "";
                $password = "";

                if (isset($_COOKIE["email"])) {
                    $email = $_COOKIE["email"];
                }

                if (isset($_COOKIE["password"])) {
                    $password = $_COOKIE["password"];
                }

                ?>

                <div class="form-signin border border-1 rounded w-100 m-auto bg-white" id="login">
                    <img class="mb-4" src="resources/logo.webp" height="100px">
                    <h1 class="mb-3 fw-normal text-uppercase fw-bold">Log In</h1>

                    <div class="text-danger d-none" id="msgdiv2">
                        <span id="msg2"></span>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email2" value="<?php echo $email ?>" placeholder="name@example.com">
                        <label for="email2">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password2" value="<?php echo $password ?>" placeholder="Password">
                        <label for="password2">Password</label>
                    </div>

                    <div class="row">
                        <div class="col-6 checkbox text-start mb-3">
                            <label>
                                <input type="checkbox" value="remember-me" id="r"> Remember me
                            </label>
                        </div>
                        <div class="col-6 text-end">
                            <a href="#" onclick="forgotPassword();">Forgot Password</a>
                        </div>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit" onclick="login();">Log in</button>
                    <a class="w-100 mt-3 mb-5 link-primary text-decoration-none" onclick="toggleView();" type="submit">Switch to Register</a>
                </div>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label">New Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="npi" required>
                                <button class="btn btn-outline-secondary" type="button" value="" onclick="showPassword();"><i id="npb" class="bi bi-eye-slash-fill"></i></button>
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Re-Type Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="rpi" required>
                                <button class="btn btn-outline-secondary" type="button" value="" onclick="showReTypePassword();"><i id="rpb" class="bi bi-eye-slash-fill"></i></button>
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Verification Code</label>
                            <input type="text" class="form-control" id="vc" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset Password</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js " integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3 " crossorigin="anonymous "></script>
    <script src="script.js "></script>
</body>

</html>