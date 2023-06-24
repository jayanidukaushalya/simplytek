<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SimplyTek | Admin Login</title>

    <link rel="icon" href="./resources/icon.svg">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>

    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row justify-content-center align-items-center">
            <div class="col-8 p-5 border rounded shadow-sm">
                <div class="row g-3">
                    <div class="col-12 text-center text-uppercase">
                        <h4>Admin Login</h4>
                    </div>
                    <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control">
                    </div>
                    <div class="col-12 text-end">
                        <a href="#" onclick="forgotPasswordAdmin();">Forgot Password</a>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary text-uppercase" onclick="adminLogin();">Login</button>
                    </div>
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
                    <button type="button" class="btn btn-primary" onclick="resetAdminPassword();">Reset Password</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js " integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3 " crossorigin="anonymous "></script>
    <script src="script.js "></script>
</body>

</html>