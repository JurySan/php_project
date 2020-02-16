<?php
include("session.php");
require_once "config.php";
$id=null;
if(!empty($_GET['id']))
{
    $id=$_REQUEST['id'];
 }
 if ( null==$id ) {
    header("Location: index.php");
  } else {
    $sql = "SELECT * FROM employee where id = ?";
    $q = $conn->prepare($sql);
    $q->execute(array($id));
    $row = $q->fetch(PDO::FETCH_ASSOC);

  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Record</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="container-fluid bg-white">
		<div class="row justify-content-center" >
			<div class="col-md-5 mt-4 bg-light">
				<form class="myform justify-content-center" name="myform" role="form"  method="post">
					<div class="form-group">
						<div class="form-header-group" >
							<div class="header-text">
								<h1 class="form-header mt-4 text-success">View Record : </h1><br><hr>
							</div>
						</div>
                            <div class="form-group" style="margin-left:30px;">
                                <div class="form-row ">
                                    <div class="form-group col-md-5">
                                        <label>Photo 			:</label>
                                    </div>
                                    <div class="form-group  col-md-5">
                                        <p class="form-control-static">
                                            <img src="image/<?php echo $row['my_image'];  ?>" width="30px" alt="">
                                            </p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label>Employee Name 			: </label>
                                    </div>
                                    <div class="form-group  col-md-5">
                                        <p class="form-control-static"><?php echo $row['ename'];  ?></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label>Date Of Birth 			: </label>
                                    </div>
                                    <div class="form-group  col-md-5">
                                          <p class="form-control-static"><?php echo $row["dob"]; ?></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                    <label>Gender 			: </label>
                                    </div>
                                    <div class="form-group  col-md-5">
                                         <p class="form-control-static"><?php echo $row["gender"]; ?></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label>Email Address 			: </label>
                                    </div>
                                    <div class="form-group  col-md-5">
                                        <p class="form-control-static"><?php echo $row["email"]; ?></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label>Permenent Address 			: </label>
                                    </div>
                                    <div class="form group col-md-5">
                                        <p class="form-control-static"><?php echo $row["address"]; ?></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label>Contact Number : </label>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <p class="form-control-static"><?php echo $row["phone"]; ?></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label>Position : </label>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <p class="form-control-static"><?php echo $row["position"]; ?></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label>Salary : </label>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <p class="form-control-static"><?php echo $row["salary"]; ?></p>
                                    </div>
                                </div>
                                <div class="form-row mt-4">
                                  <p><a href="index.php" class="btn btn-primary">Back</a></p>
                                </div>
                            </div>
                    </div>
				</form>

		   	</div>
		</div>
    </div>


</body>
</html>

