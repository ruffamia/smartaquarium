
<?php
    session_start();
    if(isset($_SESSION["is_login"])&& $_SESSION["is_login"] == True ){
        header("Location: admin/index.php");
    }

    include 'function.php';

// if valid is true it store value in database
$valid = true;
$toast_flag = false;
$toast_message = 'User Created Successfully';


// if the input is empty the following variable generate error
$error_fname = '';
$error_lname = '';
$error_email = '';
$error_password = '';
$error_rpassword = '';

// To check if $_POST exists
if ($_POST) {
    $fname = test_input($_POST["fname"]);
    $lname = test_input($_POST["lname"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $rpassword = test_input($_POST["rpassword"]);
 // call the function and store it in error generate variable
    $error_fname =  nameChecker($fname);
    $error_lname = nameChecker($lname);
    $error_password = repeatPassword($password,$rpassword);
    $error_rpassword = repeatPassword($password,$rpassword);
    
    $passwords = md5($password);
    if($email == ''){
        $error_email = "email name require!";
        $valid = false;
    } 
//link the config/db.php to establish connection to database
    require 'config/db.php';

// if the valid is true the the following condition run
    if ($valid){

        $efname = $conn -> real_escape_string($fname);
        $elname = $conn -> real_escape_string($lname);
        $eemail = $conn -> real_escape_string($email);
        $epass = $conn -> real_escape_string($passwords);
        $sql = "INSERT INTO users (first_name, last_name, email, password, role)
        VALUES ('$efname', '$elname', '$eemail','$epass','0')";
        if (mysqli_query($conn, $sql)) {
            $toast_flag = true;
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Register</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="post" action="register.php" >
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name" name="fname" >
                                            <span style="color: red; font-size: 13px; " ><?php echo $error_fname; ?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name" name="lname" >
                                            <span style="color: red; font-size: 13px; " ><?php echo $error_lname; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name="email" >
                                        <span style="color: red; font-size: 13px; " ><?php echo $error_email; ?></span>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password" >
                                            <span style="color: red; font-size: 13px; " ><?php echo $error_password; ?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" name="rpassword" >
                                            <span style="color: red; font-size: 13px; " ><?php echo $error_rpassword; ?></span>
                                    </div>
                                </div>
                                <button type="submit"  class="btn btn-primary btn-user btn-block" >
                                    Register Account
                                </button>
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        var toast = '<?php echo $toast_flag ?>';
        var toast_message = '<?php echo $toast_message ?>';

        if(toast){
            Toastify({
  text: toast_message,
  duration: 3000,
  destination: "",
  newWindow: true,
  close: true,
  gravity: "top", // `top` or `bottom`
  position: "right", // `left`, `center` or `right`
  stopOnFocus: true, // Prevents dismissing of toast on hover
  style: {
    background: "linear-gradient(to right, #00b09b, #96c93d)",
  },
  onClick: function(){} // Callback after click
}).showToast();
        }
       
    </script>
</body>

</html>