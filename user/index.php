<?php include('config/dbconnection.php') ?>
<?php
session_start();
$msg = "";
$otp = "";


if (isset($_POST['login_otp'])) {
    $otp = trim(htmlspecialchars($_POST['user_otp']));
    $mobile_no = trim(htmlspecialchars($_POST['mobile_no']));

    if (!empty($otp) && !empty($mobile_no)) {
        // Securely fetch OTP information
        $stmt = $conn->prepare("SELECT COUNT(*) FROM otps WHERE otp = ? AND created_at <= valid_time");
        $stmt->bind_param("s", $otp);
        $stmt->execute();
        $stmt->bind_result($stored_otp);
        $stmt->fetch();
        $stmt->close();

        if ($stored_otp > 0) {
            // Set session variables
            $_SESSION['username'] = $mobile_no;
            $_SESSION['role'] = 'user';

            // Securely insert user login information
            $stmt = $conn->prepare("INSERT INTO userlogin (username, mobile_no) VALUES (?, ?)");
            $stmt->bind_param("ss", $mobile_no, $mobile_no); // Assuming username is the same as mobile_no
            $stmt_execute_result = $stmt->execute();
            $stmt->close();

            if ($stmt_execute_result) {
                $msg = "<div class='msg-container'><b class='alert alert-success msg'>OTP Verified. User Login Successfully!..</b></div>";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'dash/';
                    }, 2000); // 2000 milliseconds = 2 seconds
                  </script>";
            } else {
                $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Failed to log in user. Please try again.</b></div>";
            }
        } else {
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Invalid OTP. Please enter the correct OTP !!</b></div>";
        }
    } else {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Please enter both mobile number and OTP.</b></div>";
    }
}

$conn->close();
?>
<!-- Html Starting -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <!-- Navbar End -->
    <!-- <div class="mt-2"> -->
    <!-- </div> -->
    <div id="form-main-wrapper">
        <div class="form-container">
            <!-- Sign In Start -->
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">

                            <?php if (isset($msg)) echo $msg; ?>

                            <form action="" method="POST" id="">
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <a href="" class="">
                                        <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>User Sign In !..</h3>
                                    </a>

                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="123-456-7890" onchange="otpsend(this.value);startCountdown()" required onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10">
                                    <label for="floatingInput">User Mobile No. <span class="text-danger">*</span></label>
                                    <div id="aa_container">
                                        <p class="text-success fw-bold" style="font-size:12px" id="aa"></p>
                                    </div>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="otp_passkey" name="user_otp" placeholder="Password" maxlength="6" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
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
                                <!-- <p class="text-center mb-0">Login With <a href="" id="usernamePasswordForm">Username / Password</a></p> -->
                                <!-- <p class="text-center mb-0">Don't have an Account? <a href="signup.php">Sign Up</a></p> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/chart/chart.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="js/custom.js"></script>
        <hr>
    </div>


</body>

</html>
<script>
    function otpsend(mobile) {
        $.ajax({
            type: 'POST',
            url: 'ajax_otpsend.php',
            data: {
                mobile_no: mobile
            },
            success: function(data) {
                $('#aa_container').show();
                $('#aa').append(data);

                if (data.status === success) {
                    startCountdown(); // Call startCountdown if the OTP was sent successfully
                } else {
                    console.error(data);
                }
            },
            error: function(xhr, status, error) {
                console.error("An error occurred: " + error);
            }
        });
    }


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
</script>