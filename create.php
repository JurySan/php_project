<?php
include("session.php");
require_once  "config.php";

$image=$ename=$dob=$gender=$email=$address=$phone=$position=$salary="";
$image_err=$ename_err=$dob_err=$gender_err=$email_err=$address_err=$phone_err=$position_err=$salary_err="";


 if(isset($_POST['submit']))
         {
             $uploads="image/";
            $image=$_FILES['image']['name'];
            $imageTmp=$_FILES['image']['tmp_name'];
            $ext=pathinfo($image,PATHINFO_EXTENSION);
            //$newname=rand().time().'.'.$ext;
             move_uploaded_file($imageTmp,$uploads.$ext);

            $ename=$_POST['ename'];
            $dob=$_POST['dob'];
            $gender=$_POST['gender'];
            $email=$_POST['email'];
            $address=$_POST['address'];
            $phone=$_POST['phone'];
            $position=$_POST['position'];
            $salary=$_POST['salary'];

            if(empty($image) || empty($ename) || empty($dob)  || empty($gender) || empty($email) || empty($address) || empty($phone) || empty($position) || empty($salary))

                {
                        if(empty($image)) {
                            $image_err = "Please Enter a photo";
                        }
                        if(empty($ename))
                        {
                            $ename_err="Please Enter a name";
                        }elseif(!filter_var($ename, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                            $ename_err="Please enter a valid name";
                        }

                        $test_date = '2019-06-24' ;
                        if(empty($dob)){
                            $dob_err="Please enter date of birth. ";

                        }elseif (!preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $test_date, $dob)) {
                            $dob_err= 'Please enter a valid date';
                        }


                        if(empty($gender)){
                            $gender_err="Please enter date of birth. ";
                        }

                        if(empty($email)){
                            $email_err="Please enter email address.";

                        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $email_err="Please Enter a valid email address.";

                        }

                        if(empty($address))
                        {
                            $address_err="Please Enter a address";
                        }elseif(!filter_var($address, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                            $address_err="Please enter a valid address";
                        }

                        if(empty($position)){
                            $position_err = "Please enter your position.";

                        }

                        if(empty($phone)){
                            $phone_err = "Please enter  phone number.";

                        } elseif(!ctype_digit($phone)){
                            $phone_err = "Please enter a valid phone number.";

                        }

                        if(empty($salary)){
                            $salary_err = "Please enter the salary amount.";

                        } elseif(!ctype_digit($salary)){
                            $salary_err = "Please enter a positive integer value.";

                        }


                }else{

                $stmt=$conn->prepare("INSERT INTO employee(my_image,ename,dob,gender,email,address,phone,position,salary) VALUES (:image, :ename , :dob, :gender, :email, :address, :phone, :position, :salary)");

                $stmt->bindParam(':image',$image);
                $stmt->bindParam(':ename',$ename);
                $stmt->bindParam(':dob',$dob);
                $stmt->bindParam(':gender',$gender);
                $stmt->bindParam(':email',$email);
                $stmt->bindParam(':address',$address);
                $stmt->bindParam(':phone',$phone);
                $stmt->bindParam(':position',$position);
                $stmt->bindParam(':salary',$salary);
                $res=$stmt->execute();

                if($res){
                    header("Location:index.php");
                }
                }




            }
	

    	
    	
    		

 ?>


 <!DOCTYPE html>
<html>
<head>
	<title>Create Employee Information</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/jquery-3.3.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="container-fluid bg-white">
		<div class="row justify-content-center" >
			<div class="col-md-6 mt-4 bg-light">
				<form class="myform justify-content-center" name="myform" role="form"  enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<div class="form-group" >
						<div class="form-header-group" >
							<div class="header-text">
								<h2 class="form-header mt-4 text-success">Employee Information : </h2><br><hr><br>
							</div>
						</div>
						<div class="form-group"style="margin-left: 50px;">
                            <?php
                            ?>
							<div class="form-row p-4 <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
								<div class="form-group col-md-5">
                                    <label>Photos   :</label>
								</div>
								<div class="form-group  col-md-5">
									<input type="file" name="image" class="input-group" width="30" value="<?php echo $image; ?>" >
									<span class="help-block"><?php echo $image_err;?></span>
								</div>
							</div>
							<div class="form-row p-4 <?php echo (!empty($ename_err)) ? 'has-error' : ''; ?>">
								<div class="form-group col-md-5">
									<label>Employee Name 	:</label>
								</div>
								<div class="form-group  col-md-5">
									<input type="text" name="ename" class="form-control" value=" <?php echo $ename; ?>">
									<span class="help-block"><?php echo $ename_err;?></span>
								</div>
							</div>
							<div class="form-row p-4 <?php echo (!empty($dob_err)) ? 'has-error' : ''; ?>">
								<div class="form-group col-md-5">
									<label>Date Of Birth 	:</label>
								</div>
								<div class="form-group  col-md-5">
									  <input class="form-control" id="datepicker" name="dob" value=" <?php echo $dob;?>">
									  <span class="help-block"><?php echo $dob_err; ?></span>
									   
								</div>
							</div>
							<div class="form-row p-4 <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
								<div class="form-group col-md-5">
									<label>Gender : </label>
								</div>
								<div class="form-group  col-md-5">
									  <input type="radio"   name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>  value="male">Male
                                    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>  value="female">Female
                                    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?>  value="other">Others

									  <span class="help-block"><?php echo $gender_err;?></span>
								</div>
							</div>
							<div class="form-row p-4 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
								<div class="form-group col-md-5">
									<label>Email Address : </label>
								</div>
								<div class="form-group  col-md-5">
									<input type="text" name="email" class="form-control" value=" <?php echo $email; ?>">
									<span class="help-block"><?php echo $email_err;?></span>
								</div>
							</div>
							<div class="form-row p-4 <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
								<div class="form-group col-md-5">
									<label>Permenent Address : </label>
								</div>
								<div class="form group col-md-5">
									<textarea class="form-control " name="address" rows="3"><?php echo $address; ?></textarea>
									<span class="help-block"><?php echo $address_err;?></span><br>
								</div>
							</div>
							<div class="form-row p-4 <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
								<div class="form-group col-md-5">
									<label>Contact Number : </label>
								</div>
								<div class="form-group col-md-5">
									<input type="text" name="phone" class="form-control" value=" <?php echo $phone; ?>">
									<span class="help-block"><?php echo $phone_err;?></span>
								</div>
					   		</div>
					   		<div class="form-row p-4 <?php echo (!empty($position_err)) ? 'has-error' : ''; ?>">
								<div class="form-group col-md-5">
									<label>Position : </label>
								</div>
								<div class="form-group col-md-5">
									<select class="form-control " name="position" value="<?php echo $position; ?>">
									  <option value="">-- Please select your Department --</option>
								      <option value="IT">IT</option>
								      <option value="HR">HR</option>
								      <option value="Management">Management</option>
								      <option value="Marketing">Marketing</option>
								    </select>
								    <span class="help-block"><?php echo $position_err;?></span>
								</div>
							</div>
							<div class="form-row p-4 <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
								<div class="form-group col-md-5">
									<label>Salary : </label>
								</div>
								<div class="form-group col-md-5">
									<input type="text" name="salary" class="form-control " value="<?php echo $salary; ?>">
									<span class="help-block"><?php echo $salary_err;?></span>
								</div>
					   	</div>
				   		</div>
				   		<div class="form-row mt-4">
				   			<div class="form-group col-md-6 offset-md-4">
				   				<button type="submit" class="btn btn-primary" name="submit">Submit</button>
				   				<button type="reset" class="btn btn-danger">Clear</button>
				   				<a href="index.php" class="btn btn-primary">Back</a>
				   			</div>	
				   		</div>	
				   	</div>
				</form>

		   	</div>
		</div>
	</div>

 <script>
		 $('#datepicker').datepicker({
			 uiLibrary: 'bootstrap4',
			 format: 'yyyy-mm-dd'
		});


		 </script>
</body>
</html>
