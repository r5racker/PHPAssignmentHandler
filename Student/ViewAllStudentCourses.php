<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>
		Assignment Handler
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body style="background-color:powderblue;">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	
	<div class="container">
		<div class="row justify-content-start">
		    <div class="col-6">
		      <h1>Assignment Handler</h1>
		    </div>
		</div>
	</div>



		<div class="alert alert-primary" role="alert">
		<div class="container">	
			<div class="row justify-content-end">
			    <div class="col-2">
                                <a class="btn btn-outline-primary" href="StudentHome.php" role="button">
						Home
					</a>
			    </div>
				<div class="btn-group col-2">
						<button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Assignments
						</button>
						<div class="dropdown-menu">
                                                    <a class="dropdown-item" href="StudentAssignmentDisplay.php?/email=<?php echo $_SESSION['user_email'];?>">Submitted</a>
                                                  <a class="dropdown-item" href="SubmissionPage.php">Submit here</a>
						</div>
					  </div>
				
				<div class="col-2">
                                    <a class="btn btn-outline-primary" href="ViewAllStudentCourses.php" role="button">
						Courses
					  </a>
			  	</div>

				<div class="col-3">
                                    <a class="btn btn-outline-primary" href="StudentProfile.php" role="button">
					  	Profile
						</a>
				</div>

				<div class="col-2">
				      <a class="btn btn-outline-primary" href="Logout.html" role="button">
					  	Logout
					  </a>
				</div>
				<!--
				<div class="col-2">
				      <a class="btn btn-outline-primary" href="Login.html" role="button">
					  	Contact
					  </a>
				</div>-->
			</div>
		</div>
	</div>
 <?php
session_start();
if(isset($_SESSION['user_email'])){
    $dbhandler = new PDO('mysql:host=localhost:3306;dbname=ce4_13','root','');
    //$dbhandler = new PDO('mysql:host=192.168.29.150;dbname=ce4_13','ce4_13','ce4_13');
    //echo "Connection is established...<br/>";
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $ret_sql="select * from Courses";
    $ret_prepared_sql=$dbhandler->prepare($ret_sql);
    $ret_prepared_sql->execute();
    
    $ret_sql2="select distinct c_id from StudentCourse where student_email=?";
    $ret_prepared_sql2=$dbhandler->prepare($ret_sql2);
    $ret_prepared_sql2->execute(array($_SESSION['user_email']));        
    $ret_row2=$ret_prepared_sql2->fetch();
    ?>

<div class="container table-responsive">
  <h2>Courses List</h2>         
  <table class="table table-hover table-light">
    <thead>
      <tr>
          <th>Assignment ID</th>
        <th>Assignment Name</th>
        <th>Course ID</th>
        <th>Submission List</th>
      </tr>
    </thead>
    <tbody>
     <?php while($ret_row=$ret_prepared_sql->fetch())
    {
?>  
      <tr>
        <td><?php echo $ret_row['c_id']; ?></td>
        <td><?php echo $ret_row['c_name']; ?></td>
        <td><?php echo $ret_row['c_credit']; ?></td>
        <?php
        
        if($ret_row['c_id']==$ret_row2['c_id'])
        {
            $ret_row2=$ret_prepared_sql2->fetch();
            ?>
            <td><a href="LeaveCourse.php?c_id=<?php echo $ret_row['c_id']; ?>&email=<?php echo $_SESSION['user_email']; ?>">Leave</a></td>
<?php        }else{
        ?>
            <td><a href="EnrollCourse.php?c_id=<?php echo $ret_row['c_id']; ?>&email=<?php echo $_SESSION['user_email']; ?>">Enroll</a></td>
<?php            }?>
      </tr>
    <?php }
}?>
    </tbody>
  </table>
</div>  
  </body>
</html>
