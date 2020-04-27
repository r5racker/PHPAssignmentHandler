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

      <?php
            session_start();
            if(!isset($_SESSION['user_email'])){
                header("Location:../login.php?message=Please Login");
            }
      ?>
      
      
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
			    <div class="col-1">
					<a class="btn btn-outline-primary" href="TeacherHome.php" role="button">
						Home
					</a>
			    </div>
				<div class="col-2">
                                    <a class="btn btn-outline-primary" href="ViewSubmissionList.php" role="button">
					  	Submissions
					  </a>
				</div>
				
				<div class="col-2">
					<a class="btn btn-outline-primary" href="ViewTeacherCourses.php" role="button">
						Courses
					  </a>
			  	</div>

				<div class="col-2">
				      <a class="btn btn-outline-primary" href="ViewAllStudents.php" role="button">
					  	Students
						</a>
				</div>

				<div class="col-3">
				      <a class="btn btn-outline-primary" href="TeacherProfile.php" role="button">
					  	Profile
						</a>
				</div>

				<div class="col-2">
				      <a class="btn btn-outline-primary" href="../Logout.php" role="button">
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
if(isset($_SESSION['user_email'])){
    $dbhandler = new PDO('mysql:host=localhost:3306;dbname=ce4_13','root','');
    //$dbhandler = new PDO('mysql:host=192.168.29.150;dbname=ce4_13','ce4_13','ce4_13');
    //echo "Connection is established...<br/>";
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $ret_sql="select * from Student where student_email=?";
    $ret_prepared_sql=$dbhandler->prepare($ret_sql);
    $ret_prepared_sql->execute(array($_GET["user_email"]));
    $ret_row=$ret_prepared_sql->fetch();
}
    ?>
<div class="container">
  <h2>Profile</h2>         
  
  <div class="form-group">
      <label for="student_image">Photo:</label>
      <img src="../uploads/<?php echo $_GET["user_email"];?>/profile.png" alt="Your Photo" height="200" width="200"/>
  </div>
  
  <div class="form-group">
      <label for="student_first_name">First Name:</label>
      <input type="text" class="form-control" id="student_first_name" placeholder="<?php echo $ret_row['student_first_name']?>" name="student_first_name" disabled>
    </div>
      
<div class="form-group">
      <label for="student_middle_name">Middle Name:</label>
      <input type="text" class="form-control" id="student_middle_name" placeholder="<?php echo $ret_row['student_middle_name']?>" name="student_middle_name" disabled>
    </div>
  
  <div class="form-group">
      <label for="student_last_name">Last Name:</label>
      <input type="text" class="form-control" id="student_last_name" placeholder="<?php echo $ret_row['student_last_name']?>" name="student_last_name" disabled>
    </div>
    
<div class="form-group">
        <label for="student_dob">Birth Date:</label>
        <input type="datetime" class="form-control" id="student_dob" placeholder="<?php echo $ret_row['student_dob']?>" name="student_dob" disabled>
  </div>  
  
<div class="form-group">
      <label for="student_gender">Gender:</label>
      <input type="text" class="form-control" id="student_gender" placeholder="<?php echo $ret_row['student_gender']?>" name="student_gender" disabled>
      </div>  

<div class="form-group">
      <label for="student_semester">Semester:</label>
      <input type="text" class="form-control" id="student_semester" placeholder="<?php echo $ret_row['student_semester']?>" name="student_semester" disabled>
      </div>  
  
  <div class="form-group">
      <label for="student_email">Email:</label>
      <input type="text" class="form-control" id="student_email" placeholder="<?php echo $_GET['user_email']?>" name="student_email" disabled>
    </div>
  
    <div class="form-group">
      <label for="student_address">Address:</label>
      <input type="text" class="form-control" id="student_address" placeholder="<?php echo $ret_row['student_address']?>" name="student_address" disabled>
    </div>
      
<div class="form-group">
      <label for="student_address2">Address2:</label>
      <input type="text" class="form-control" id="student_address2" placeholder="<?php echo $ret_row['student_address2']?>" name="student_address2" disabled>
    </div>
    
<div class="form-group">
      <label for="student_city">City:</label>
      <input type="text" class="form-control" id="student_city" placeholder="<?php echo $ret_row['student_city']?>" name="student_city" disabled>
    </div>  

<div class="form-group">
      <label for="student_state">State:</label>
      <input type="text" class="form-control" id="student_state" placeholder="<?php echo $ret_row['student_state']?>" name="student_state" disabled>
      </div>
  
<div class="form-group">
      <label for="student_zip">Zip:</label>
      <input type="text" class="form-control" id="student_zip" placeholder="<?php echo $ret_row['student_zip']?>" name="student_zip" disabled>
      </div>  
  
     <div class="form-group">
      <label for="student_mobile_no">Mobile Number:</label>
      <input type="text" class="form-control" id="student_mobile_no" placeholder="<?php echo $ret_row['student_mobile_no']?>" name="student_mobile_no" disabled>
    </div> 
      
      <div class="form-group">
        <label for="student_id_no">ID Number:</label>
        <input type="text" class="form-control" placeholder="<?php echo $ret_row['student_id_no']?>" id="student_id_no" name="student_id_no" disabled>
  </div>
        
  
</div>
    

        
</body>
</html>




