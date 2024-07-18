<?php include('config/dbconnection.php') ?>
<?php
session_start();
$msg="";
$suc="";
$err="";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = base64_encode($_POST['password']);
    $otp = isset($_POST['usr-otp']) ? $_POST['usr-otp'] : null;

    if ($otp) {
        // Verify OTP
        if ($_SESSION['otp'] == $otp) {
            $style='style="background-color:#70e55fa3"';
            $msg= "OTP Verified";
            echo "<script type='text/javascript'> document.location = 'dash/dashboard.php'; </script>";
        } else {
            // echo "<script>document.getElementById('status-desc').innerText = 'Invalid OTP'; document.querySelector('.signin-status').classList.remove('d-none');</script>";
            $style='style="background-color:#df6161a3"';
            $msg= "Invalid OTP Please Enter Correct OTP !!";
        }
    } else {
        // echo  '---'.$password;die;
        // $conn = mysqli_connect($host, $username, $password, $dbname);
        
        // if (!$conn) {
            //     die("Connection failed: " . mysqli_connect_error());
            // }
            
            $sql = "SELECT username, password FROM adminlogin WHERE username='$username' and password='$password'";
            // echo $sql;die;
            $stmt = mysqli_query($conn, $sql);
            // mysqli_stmt_bind_param($stmt, "ss", $username, $password);
            // mysqli_stmt_execute($stmt);
            // $result = mysqli_stmt_get_result($stmt);
            
            if (mysqli_num_rows($stmt) > 0) {
                // $_SESSION['alogin'] = $_POST['username'];
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
           
                $msg= "Admin Login Successfully !..";
                $suc =true;
                echo "<script>
                // Redirect to dashboard after 3 seconds (3000 milliseconds)
                setTimeout(function() {
                    window.location.href = 'dash';
                }, 2000); // 3000 milliseconds = 3 seconds
            </script>";
        

               
    } else {
        // echo "<script>alert('Invalid Details');</script>";
        $msg= "Invalid Username or Password !..";
        $err =true;
    }
    }
    mysqli_close($conn);
}
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
    <div id="form-main-wrapper">
        <div class="form-container">
    
            <script>
        // Hide message after 2 seconds (2000 milliseconds)
        setTimeout(function() {
            var messageDiv = document.getElementById('message');
            if (messageDiv) {
                messageDiv.style.display = 'none';
            }
        }, 3000); // 2000 milliseconds = 2 seconds
    </script>

            <!-- <div class="form-wrapper">
                <div class="form-con form">
                    <form action="" method="POST" id="usernamePasswordForm">
                        <div class="field-con">
                            <label for="username">User Name: </label>
                            <input type="text" id="username" name="username" required />
                        </div>
                        <div class="field-con">
                            <label for="passkey">Password: </label>
                            <input type="password" id="passkey" name="password" required />
                        </div>

                        <div class="flex form-btn-con">
                            <span class="remember-me">
                                <input type="checkbox" name="remember-me" id="rem-me" /> <label for="rem-me"><span>Remember Me</span></label>
                            </span>

                            <div class="sub-btn-wrap">
                                <input type="submit" class="form-submit" name="login" value="Sign In" />
                            </div>
                        </div>
                    </form>
                    <form action="" method="POST" id="otpForm" class="d-none">
                        <div class="field-con">
                            <label for="otp">OTP: </label>
                            <input type="text" id="otp" name="usr-otp" required/>
                        </div>

                        <div class="flex form-btn-con">
                            <div class="sub-btn-wrap">
                                <input type="submit" class="form-submit" name="login" value="Sign In" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="form-con add-links">
                <a href="admin-forget-password.php" title="">Forget password?</a>
                <a href="#" title="Back to trendy mania" id="switchToOTP">Login with OTP</a>
            </div>
        </div>
    </div> -->




        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        
                <?php 
                // echo 'vaibhav'.$msg;
                if(!empty($msg)){?>
            <div id="message" class="signin-status">
               <?php 
                
                if($suc){?>
                    <div class="alert alert-success text-center" role="alert">
                    <h6 class="text-success"><b><?=$msg;?></b></h6>
                </div>
                <?php  }?>
                <?php 
                
                if($err){?>
                    <div class="alert alert-danger text-center " role="alert">
                    <h6 class="text-danger"><b><?=$msg;?></b></h6>
                </div>
                <?php  }?>

              
            </div>
            <?php }?>
                        <!-- Login With ID Pass -->
                    <form action="" method="POST" id="usernamePasswordForm">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <a href="" class="">
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Admin Sign In !..</h3>
                            </a>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="@Admin">
                            <label for="floatingInput">User Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="passkey" name="password" placeholder="Password">
                            <label for="floatingPassword">Password <span class="text-danger">*</span></label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <a href="">Forgot Password</a>
                        </div>
                        <button type="submit" name="login" value="Sign In"  class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                        <p class="text-center fw-bold mb-0">Login With <a href="" id="switchToOTP">OTP</a></p>
                    
                    </form>
                    <!-- Login With Password Close -->

                         <!-- Login With OTP -->
                    <form action="" method="POST" id="otpForm" class="d-none">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <a href="" class="">
                                <h3 class="text-success"><i class="fa fa-hashtag me-2"></i>Admin Sign In !..</h3>
                            </a>
                       
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="@Admin">
                            <label for="floatingInput">User Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="passkey" name="password" placeholder="Password">
                            <label for="floatingPassword">OTP <span class="text-danger">*</span></label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <a href="">Forgot Password</a>
                        </div>
                        <button type="submit" name="login" value="Sign In"  class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                        <p class="text-center fw-bold mb-0">Login With <a href="" id="usernamePasswordForm">Username / Password</a></p>
                    </form>
                    <!-- Login With OTP Close -->

                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->


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
    </script>

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
   

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

<hr>



</body>

</html>