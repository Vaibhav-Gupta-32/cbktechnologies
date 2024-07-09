<?php
session_start();
include('dbconnection.php');
$msg="";
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
                // echo "<script>alert('Successfully');</script>";
                $style='style="background-color:#70e55fa3"';
                $msg= "User Verified";
                echo "<script>
        // Redirect to dashboard after 3 seconds (3000 milliseconds)
        setTimeout(function() {
            window.location.href = 'dash/dashboard.php';
        }, 2000); // 3000 milliseconds = 3 seconds
    </script>";
    } else {
        // echo "<script>alert('Invalid Details');</script>";
        $msg= "Invalid username or password ! Please Check";
        $style='style="background-color:#df6161a3"';
    }
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        input {
            font-family: 'Poppins', sans-serif;
        }

        #form-main-wrapper {
            width: 100%;
            height: 100vh;
            background: #8A39E1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            width: 450px;
            padding: 20px 15px;
        }

        .admin-avtar {
            text-align: center;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .admin-avtar h1 {
            font-size: 28px;
            font-weight: 400;
            margin-left: 15px;
            color: #fff;
        }

        .signin-status {
            width: 100%;
            background-color: orange;
            padding: 15px 10px;
            border-radius: 3px;
            margin-bottom: 25px;
        }

        .form-con label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .form-con input {
            width: 100%;
            font-size: 16px;
            padding: 5px 10px;
            font-weight: 400;
            outline: none;
        }

        label[for="rem-me"] {
            margin-bottom: 0px;
        }

        .field-con {
            margin-bottom: 20px;
        }

        .field-con:last-child {
            margin-bottom: 0px;
        }

        .flex {
            display: flex;
        }

        .form-btn-con input {
            display: inline-block;
            width: unset;
        }

        .remember-me {
            display: block;
            width: 100%;
            display: flex;
            align-items: center;
        }

        .form-btn-con input[type=checkbox] {
            margin-right: 10px;
        }

   

        .add-links {
            margin-top: 50px;
        }

        .add-links a {
            display: block;
            margin: 10px 0;
            font-size: 14px;
            color: #fff;
        }

        .form {
            background: #fff;
            padding: 40px 30px;
            box-shadow: 0px 16px 40px rgba(0, 0, 0, 0.25);
        }

        .d-none {
            display: none;
        }

        .form-submit {
            background-color: #8A39E1;
            border: none;
            color: #fff;
            padding: 8px 30px !important;
            border: 2px solid transparent;
            font-weight: 500 !important;
            transition: 300ms ease-in-out;
            cursor: pointer;
        }

        .form-submit:hover {
            background-color: #fff;
            border: 2px solid #8A39E1;
            color: #8A39E1;
        }

        @media screen and (max-width: 576px) {
            .flex.form-btn-con {
                flex-direction: column;
            }

            .sub-btn-wrap {
                text-align: center;
                margin-top: 25px;
            }

            .form {
                padding: 40px 20px;
            }

            .admin-avtar h1 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>
    <div id="form-main-wrapper">
        <div class="form-container">
            <div class="admin-avtar">
                <h1>Admin Sign In</h1>
            </div>

                <?php 
                // echo 'vaibhav'.$msg;
                if(!empty($msg)){?>
            <div id="message" class="signin-status" <?=$style;?>>
                <p id="status-desc"> <?=$msg;?></p>
            </div>
            <?php }?>

            <script>
        // Hide message after 2 seconds (2000 milliseconds)
        setTimeout(function() {
            var messageDiv = document.getElementById('message');
            if (messageDiv) {
                messageDiv.style.display = 'none';
            }
        }, 3000); // 2000 milliseconds = 2 seconds
    </script>

            <div class="form-wrapper">
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
    </script>
</body>

</html>