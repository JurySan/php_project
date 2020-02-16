<?php
    require_once "config.php";
    $fname=$lname=$email=$username=$password=$cpassword="";
    $fname_err=$lname_err=$email_err=$username_err=$password_err=$cpassword_err="";
    $validpassconfirm="";
    if(isset($_POST['register']))
    {
       $fname=$_POST['fname'];
       $lname=$_POST['lname'];
       $email=$_POST['email'];
       $username=$_POST['username'];
       $password=$_POST['password'];

       $cpassword=$_POST['cpassword'];


       if(empty($fname) || empty($lname) || empty($email) || empty($username) || empty($password) || empty($cpassword))
       {
           if(empty($fname))
           {
               $fname_err="Please Enter a name";
           }elseif(!filter_var($fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
               $fname_err="Please enter a valid name";
           }

           if(empty($lname))
           {
               $lname_err="Please Enter a name";
           }elseif(!filter_var($lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
               $lname_err="Please enter a valid last name";
           }

           if(empty($email)){
               $email_err="Please enter email address.";
           }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
               $email_err="Please Enter a valid email address.";
           }

           if(empty($username))
           {
               $username_err="Please Enter a username";
           }elseif(!filter_var($username, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
               $username_err="Please enter a valid username name";
           }

           var_dump($password);
           if(empty($password)){
               $password_err="Please enter password ";
           }elseif(!preg_match("#[0-9]+#",$password)){
               $password_err="Your password must at least 1 integer.";
           }

           if(empty($cpassword)){
               $cpassword_err="Please enter confirm password";
           }elseif(!preg_match("#[0-9]+#",$cpassword)){
               $cpassword_err="Your password must contain at least 1 integer.";
           }


       }else{
           $password=md5($password);
           $cpassword=md5($cpassword);
               $stmt=$conn->prepare("INSERT INTO register(fname,lname,email,username,password,cpassword) VALUES (:fname, :lname , :email, :username, :password, :cpassword)");
           $stmt->bindParam(':fname',$fname);
               $stmt->bindParam(':lname',$lname);
               $stmt->bindParam(':email',$email);
               $stmt->bindParam(':username',$username);
               $stmt->bindParam(':password',$password);
               $stmt->bindParam(':cpassword',$cpassword);

               $stmt->execute();
             $last_id=$conn->lastInsertId();
               if($last_id){

                   echo "<div class='alert alert-success text-center ' >Record was saved.</div>";
               }





       }
    }


?>



<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>


    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            background-color: #525252; //
        }
        .centered-form{
            margin-top: 80px;
        }

        .centered-form .panel{
            background: rgba(255, 255, 255, 0.8);
            box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
        }
    </style>
</head>
<body>
<div class="container ">
    <div class="row centered-form ">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Registration</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                                    <input type="text" name="fname" id="first_name" class="form-control input-sm" placeholder="First Name" value="<?php echo $fname; ?>">
                                    <span class="help-block"><?php echo $fname_err;?></span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
                                    <input type="text" name="lname" id="last_name" class="form-control input-sm" placeholder="Last Name" value="<?php echo $lname; ?>">
                                    <span class="help-block"><?php echo $lname_err;?></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <input type="text" name="username" id="username" class="form-control input-sm" placeholder="Username" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err;?></span>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                    <input type="password" name="password" id="password" onkeyup='check();' class="form-control input-sm" placeholder="Password" >
                                    <span class="help-block "><?php echo $password_err; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group <?php echo (!empty($cpassword_err)) ? 'has-error' : ''; ?>">
                                    <input type="password" name="cpassword" onkeyup='check();' id="cpassword"  class="form-control input-sm" placeholder="Confirm Password" >
                                    <span class="help-block" id='message'><?php echo $cpassword_err; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-2 col-md-4">
                                <div class="form-group">
                                    <button type="submit" name="register" class="btn btn-info btn-block" id="submit" >Register</button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <a href="login.php" class="btn btn-info btn-block">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var check = function() {
        if (document.getElementById('password').value ==
            document.getElementById('cpassword').value) {

            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'matching';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'not matching';
        }
    }
</script>

</body>
</html>
