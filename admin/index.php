<?php
include('config/dbconnection.php');
session_start();

$msg = "";
$otp = "";

if (isset($_POST['login_otp'])) {
    if (!isset($_POST['amdin_otp'])) {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>OTP is required</b></div>";
    } else {
        $otp = $_POST['amdin_otp'];
        $mobile_no = $_POST['mobile_no'];
        $stored_otp = getvalfield($conn, "otps", "count(*)", "otp='$otp' and created_at <= valid_time");
        $username = getvalfield($conn, "adminlogin", "username", "mobile_no='$mobile_no'");
        $password = getvalfield($conn, "adminlogin", "password", "mobile_no='$mobile_no'");
        // echo 'sada'.$password;die;
        if ($stored_otp > 0) {
            $_SESSION['otp'] = $otp;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $msg = "<div class='msg-container'><b class='alert alert-success msg'>OTP Verified. Admin Login Successfully!..</b></div>";
            echo "<script>
            setTimeout(function() {
                window.location.href = 'dash/';
            }, 2000); // 3000 milliseconds = 3 seconds
        </script>";
        // die;
        } else {
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Invalid OTP Please Enter Correct OTP !!</b></div>";
        }
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = base64_encode($_POST['password']);
    if (isset($username) && isset($password)) {
        $sql = "SELECT username, password FROM adminlogin WHERE username='$username' and password='$password'";
        $stmt = mysqli_query($conn, $sql);

        if (mysqli_num_rows($stmt) > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;

            echo "<script>
            setTimeout(function() {
                window.location.href = 'dash/';
                }, 2400); // 3000 milliseconds = 3 seconds
                </script>";
                $msg ="<div class='msg-container'><b class='alert alert-success msg'>Admin Login Successfully!..</b></div>";
            // exit(); // Ensure the script stops executing after redirection
        } else {
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Invalid Username or Password !..</b></div>";
        }
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div id="form-main-wrapper">
        <div class="form-container">
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <?php if (isset($msg)) echo $msg;?>
                            <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->
                            <form action="" method="POST" id="usernamePasswordForm">
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <a href="" class="">
                                        <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Admin Sign In !..</h3>
                                    </a>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="@Admin" required>
                                    <label for="floatingInput">User Name <span class="text-danger">*</span></label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="passkey" name="password" placeholder="Password" required>
                                    <label for="floatingPassword">Password <span class="text-danger">*</span></label>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                    <a href="">Forgot Password</a>
                                </div>
                                <button type="submit" name="login" value="Sign In" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                                <p class="text-center fw-bold mb-0">Login With <a href="" id="switchToOTP">OTP</a></p>
                            </form>

                            <form action="" method="POST" id="otpForm" class="d-none">
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <a href="" class="">
                                        <h3 class="text-success"><i class="fa fa-hashtag me-2"></i>Admin Sign In !..</h3>
                                    </a>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="123-456-7890" onchange="otpsend(this.value); startCountdown()" maxlength="10" required>
                                    <label for="floatingInput">Admin Mobile No. <span class="text-danger">*</span></label>
                                    <div id="aa_container">
                                        <p class="text-success fw-bold" style="font-size:12px" id="aa"></p>
                                    </div>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="amdin_otp" placeholder=" " maxlength="6" required>
                                    <label for="floatingPassword">OTP <span class="text-danger">*</span></label>
                                    <div id="otp-time" class="d-flex align-items-center justify-content-between">
                                        <span id="countdown"></span>
                                        <a href="" id="resend" class="" style="display: none;" onclick="otpsend(this.value);">Resend otp</a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                        <label class="form-check-label" for="exampleCheck2">Check me out</label>
                                    </div>
                                    <a href="">Forgot Password</a>
                                </div>
                                <button type="submit" name="login_otp" value="Sign In" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                                <p class="text-center fw-bold mb-0">Login With <a href="" id="usernamePasswordForm">Username / Password</a></p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('switchToOTP').addEventListener('click', function(event) {
            event.preventDefault();
            const usernamePasswordForm = document.getElementById('usernamePasswordForm');
            const otpForm = document.getElementById('otpForm');
            const switchLink = document.getElementById('switchToOTP');

            if (usernamePasswordForm.classList.contains('d-none')) {
                usernamePasswordForm.classList.remove('d-none');
                otpForm.classList.add('d-none');
                switchLink.textContent = 'Login with OTP';
            } else {
                usernamePasswordForm.classList.add('d-none');
                otpForm.classList.remove('d-none');
                switchLink.textContent = 'Login with Username/Password';
            }
        });

        function startCountdown() {
            var countDownDate = new Date(Date.now() + 300000); // 300000 = 5 minutes in milliseconds

            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("countdown").innerHTML = minutes + "m " + seconds + "s ";

                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("countdown").innerHTML = "OTP expired";
                    document.getElementById("resend").style.display = "block";
                }
            }, 1000);
        }

        function otpsend(mobile) {
    $.ajax({
        type: 'POST',
        url: 'ajax_otpsend.php',
        data: {
            mobile_no: mobile
        },
        success: function(data) {
            $('#aa_container').show();
            $('#aa').append(data.message);

            if (data.status === 'success') {
                startCountdown(); // Call startCountdown if the OTP was sent successfully
            } else {
                console.error(data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("An error occurred: " + error);
        }
    });
}
otpsend();
    </script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- <script src="js/main.js"></script> -->
    <script src="js/custom.js"></script>
</body>
</html>
