<?php
session_start();
include('assets/inc/config.php');

if (isset($_POST['user_login'])) {
    $user_email = $_POST['user_email'];
    $user_pwd = sha1(md5($_POST['user_pwd'])); // double encrypt to increase security


    $stmt = $mysqli->prepare("SELECT user_email, user_pwd, user_id FROM mis_user WHERE user_email = ? AND user_pwd = ?");
    $stmt->bind_param('ss', $user_email, $user_pwd);
    $stmt->execute();
    $stmt->bind_result($user_email, $user_pwd, $user_id);
    $rs = $stmt->fetch();

    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_email'] = $user_email;


    if ($rs) {
        header("location: mis_user_dashboard.php");
    } else {
        $err = "Access Denied. Please check your credentials.";
    }
}
//     if ($rs) {
//         // Check  value and navigate to a specific page accordingly
//         switch ( {
//             case "Employment":
//                 header("Location: mis_user_register_employment.php");
//                 break;
//             case "Scholarship":
//                 header("Location: mis_user_register_scholarship.php");
//                 break;
//             case "SPES":
//                 header("Location: mis_user_register_spes.php");
//                 break;
//             case "GIP":
//                 header("Location: mis_user_register_gip.php");
//                 break;
//             case "TesdaTraining":
//                 header("Location: mis_user_register_tesdatraining.php");
//                 break;
//             // Add other cases as needed
//             default:
//                 $err = "Invalid; // Handling othervalues
//                 break;
//         }
//     } else {
//         $err = "Access Denied. Please check your credentials.";
//     }
// }
?>
<!--End Login-->
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <title>PESO Manolo Fortich</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="MartDevelopers" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/Peso_log.png">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <!--Load Sweet Alert Javascript-->
        
        <script src="assets/js/swal.js"></script>
        <!--Inject SWAL-->
        <?php if(isset($success)) {?>
        <!--This code for injecting an alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Success","<?php echo $success;?>","success");
                            },
                                100);
                </script>

        <?php } ?>

        <?php if(isset($err)) {?>
        <!--This code for injecting an alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Failed","<?php echo $err;?>","error");
                            },
                                100);
                </script>

        <?php } ?>



    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="index.php">
                                        <span><img src="assets/images/Peso_log.png" alt="" height="100"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Enter your email address and password to access User panel.</p>
                                </div>

                                <form method='post' >

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">User Email </label>
                                        <input class="form-control" name="user_email" type="text" id="emailaddress" required="" placeholder="Enter your Email">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" name="user_pwd" type="password" required="" id="password" placeholder="Enter your password">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-success btn-block" name="user_login" type="submit"> Log In </button>
                                    </div>

                                </form>

                                <!--
                                For Now Lets Disable This 
                                This feature will be implemented on later versions
                                <div class="text-center">
                                    <h5 class="mt-3 text-muted">Sign in with</h5>
                                    <ul class="social-list list-inline mt-3 mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
                                        </li>
                                    </ul>
                                </div> 
                                -->

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <!-- <p> <a href="mis_user_reset_pwd.php" class="text-white-50 ml-1">Forgot your password?</a></p> -->
                               <p class="text-white-50">Don't have an account? <a href="mis_user_register.php" class="text-white ml-1"><b>Sign Up</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <?php include ("assets/inc/footer1.php");?>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>