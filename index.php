<?php
include("session.php");
require_once "config.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Detail</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>


</head>
<body>
<?php
$search_keyword='';
if(isset($_POST['btnSearch']))
{
    $search_keyword=$_POST['keyword'];

}
$sql="SELECT * FROM employee WHERE ename LIKE :keyword OR dob LIKE :keyword OR gender LIKE :keyword OR email LIKE :keyword OR address LIKE :keyword OR phone LIKE :keyword OR position LIKE :keyword OR salary LIKE :keyword ORDER BY id ASC";
$stmt=$conn->prepare($sql);
$stmt->bindValue(':keyword','%'.$search_keyword.'%',PDO::PARAM_STR);
$stmt->execute();
$result=$stmt->fetchAll();



?>

	<div class="wrapper ">
		<div class="container">
			<div class="row">
                <div class="col-md-12 mt-4" >
                    <a href="logout.php" class="pull-right  ">Logout</a><br>
                </div>
                <?php if (isset($_SESSION['success'])) : ?>
                <div class="col">
                    <div class="alert alert-<?=$_SESSION['success-login']?>">
                    <?php
          	            echo $_SESSION['success'];
                        unset($_SESSION['success']); ?>
                </div>
                </div>
                <?php endif ?>
				<div class="col-md-12">
					<div class="page-header clearfix">
                        <a href="create.php" class="btn btn-success pull-right">Add New Employee</a>
                        <div class="input-group col-md-2 col-offset-md-10 mb-3">
                            <form method="post">
                            <input type="text" class="form-control" name='keyword' placeholder='Search' id="keyword" value="<?php echo $search_keyword; ?>" >
                            <div class="input-group-prepend">
                                <button class="btn btn-info" type="submit" name="btnSearch"  >Search</button>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                            </div></form>
                        </div>
					</div>
                    <div class="col-md-12">
                        <h2 class="pull-left text-success">Employees Details</h2>
                    </div>
                    <table class="table table-bordered table-striped table-hover ">
                        <thead class="text-white bg-dark">
                        <tr>
                            <td>Photo</td>
                            <td>Employee Name</td>
                            <td>Date of Birth</td>
                            <td>Gender</td>
                            <td>Email</td>
                            <td>Address</td>
                            <td>Phone Number</td>
                            <td>Position</td>
                            <td>Salary</td>
                            <td>Action</td>
                        </tr>

                        </thead>
                        <tbody>
                        <?php
                            if (!empty($result)) {

                                foreach ($result as $row) { ?>
                                    <tr class="table-row">
                                        <td><img src="image/<?php echo $row['my_image']; ?>" width="30px"></td>
                                        <td><?php echo $row['ename']; ?></td>
                                        <td><?php  $newDate = date("d-M-Y", strtotime($row['dob']));
                                                echo $newDate; ?></td>
                                        <td><?php echo $row['gender']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['position']; ?></td>
                                        <td><?php echo $row['salary']; ?></td>
                                        <td><?php
                                            echo " <a href='view.php?id=" . $row['id'] . "' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>&nbsp;&nbsp;";
                                            echo "<a href='update.php?id=" . $row['id'] . "' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>&nbsp;&nbsp;";
                                            echo "<a href='delete.php?id=" . $row['id'] . "' title='Delete Record' data-toggle='tooltip' onclick='javascript:confirmationDelete($(this));return false;'><span class='glyphicon glyphicon-trash'></span></a>";
                                            ?></td>
                                    </tr>

                                <?php }

                        }
                        ?>
                        </tbody>

                    </table>

				</div>
		</div>
<!--            <div class="row justify-content-center">-->
<!--                <div class="col-md-12">-->
<!--                    <nav aria-label="Page navigation example">-->
<!--                        <ul class="pagination" >-->
<!--                            <li class="page-item ">-->
<!--                                <a class="page-link" href="?page=1" tabindex="-1" aria-disabled="true">Previous</a>-->
<!--                            </li>-->
<!--                            --><?php //for($p=1; $p<=$total_page; $p++){?>
<!--                            <li class="page-item --><?//= $page == $p ? 'active' : ''; ?><!--"><a href="--><?//= '?page='.$p; ?><!--">--><?//= $p; ?><!--</a></li>-->
<!---->
<!--                            --><?php //}?>
<!--                            <li class="page-item"><a href="?page=--><?//= $total_page; ?><!--">Next</a></li>-->
<!--                        </ul>-->
<!--                    </nav>-->
<!--                </div>-->
<!--            </div>-->
<!--	</div>-->


    <script>

        function confirmationDelete(anchor)
        {
            var conf = confirm('Are you sure want to delete this record?');
            if(conf)
                window.location=anchor.attr("href");

        }
   </script>
</body>
</html>






