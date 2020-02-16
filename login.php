
<?php
require_once  "config.php";
session_start();

$email=$password="";
$email_err=$password_err="";


if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    //var_dump($password);
    if(empty($email) ||  empty($password))
    {
        if(empty($email)){
            $email_err="Please enter email address.";
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_err="Please Enter a valid email address.";
        }
        if (empty($password)) {
            $password_err = "Please enter password ";
        }

    }else{

            $stmt=$conn->prepare("SELECT * FROM register WHERE email=:email AND password=:password");

            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':password',$password);
            $stmt->execute();

            $result=$stmt->fetchALL();

            if($stmt->rowCount() > 0)
            {
                $_SESSION['userlogin']=$email;
                $_SESSION['success']="You are now logged in ".$email;
                $_SESSION['success-login']='success';

                header("location:index.php");
            }else{
                echo "Invalid email or password";
            }

        }

}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>

    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="wrapper">
    <div id="formContent" class="fadeInDown ">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first p-3">
            <img src="image/loginIcon.png" id="icon" alt="User Icon" />
            <h1>Login</h1>
        </div>

        <!-- Login Form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="form-row justify-content-center <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <div class="col-md-offset-2 col-md-6">
                    <input type="email" id="" class="fadeIn second form-control" name="email" placeholder="Username or Email" value="">
                    <br><span class="help-block "><?php echo $email_err; ?></span>
                </div>
            </div>
            <div class="form-row justify-content-center <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <div class="col-md-6">
                    <input type="password" id="" class="fadeIn third form-control" name="password" placeholder="Password" value="">
                    <br><span class="help-block "><?php echo $password_err; ?></span>
                </div>
            </div>
            <div class="form-row p-3">
                <div class="col">
                    <!--                    <input type="submit" name="login" class="fadeIn fourth" value="Log In">-->
                    <button type="submit" class="btn btn-primary" name="login">Log In </button>

                </div>
            </div>

        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="register.php">Register Here!</a>
        </div>

    </div>

</div>
</body>
</html>
