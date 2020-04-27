<!doctype html>
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
	<br>
        <center>
    <?php
        $dbhandler = new PDO('mysql:host=localhost:3306;dbname=ce4_13','root','');
        //$dbhandler = new PDO('mysql:host=192.168.29.150;dbname=ce4_13','ce4_13','ce4_13');
        //echo "Connection is established...<br/>";
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $ret_sql="select * from Courses";
        $ret_prepared_sql=$dbhandler->prepare($ret_sql);
        $ret_prepared_sql->execute();
                
    ?>
            
            <form action="SaveAssignment.php" method="post" style="background-color:wheat" enctype="multipart/form-data">
	
	<!--div class="form-group row">
    <label for="assignment_id" class="col-sm-4 col-form-label">Assignment Id</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="assignment_id" name="assignment_id" required>
    	 <select id="student_assignment_id" class="form-control" name="student_assignment_id" required>
             <option selected>Choose...</option>
        <option>1</option>
		<option>2</option>
		<option>3</option>
		<option>4</option>
		<option>5</option>
		<option>6</option>
		<option>7</option>
		<option>8</option>
      </select>
	</div>
  </div-->
	
	<div class="form-group row">
    <label for="assignment_name" class="col-sm-4 col-form-label">Assignment Name</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="assignment_name" name="assignment_name" required>
    </div>
  </div>
	
	<div class="form-group row">
            <label for="assignment_teacher_email" class="col-sm-4 col-form-label" >Teacher's Email</label>
    <div class="col-sm-6">
      <input type="email" class="form-control" id="teacher_assignment_email" name="teacher_assignment_email" value="<?php echo $_SESSION['user_email'];  ?>" required>
    </div>
  </div>
        <div class="form-group row">
    <label for="course_assignment_id" class="col-sm-4 col-form-label">Course Id</label>
	<div class="col-sm-6">
		<select id="course_assignment_id" class="form-control" name="course_assignment_id" required>
			<option selected>Choose...</option>
                         <?php while($ret_row=$ret_prepared_sql->fetch())
                        {
                        ?>  
                        <option value="<?php echo $ret_row['c_id']; ?>"><?php echo $ret_row['c_name']; ?></option>
                        <?php
                        }
                        ?>
	 	</select>
  </div>
  </div>
  
  <div class="form-group row">
    <label for="assignment_initial_date" class="col-sm-4 col-form-label">Initial Date</label>
    <div class="col-sm-6">
      <input type="date" class="form-control" id="assignment_initial_date" name="assignment_initial_date" required>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="assignment_due_date" class="col-sm-4 col-form-label">Due Date</label>
    <div class="col-sm-6">
      <input type="date" class="form-control" id="assignment_due_date" name="assignment_due_date" required>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="assignment_max_upload_size" class="col-sm-4 col-form-label">Maximum Size Allowed(in kbs)</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="assignment_max_upload_size" name="assignment_max_upload_size" required>
    </div>
  </div>
  
   <div class="form-group row">
    <label for="assignment_file" class="col-sm-4 col-form-label">Maximum Size Allowed(in kbs)</label>
    <div class="col-sm-6">
      <input type="file" class="form-control" id="assignment_file" name="assignment_file" required>
    </div>
  </div>
  
   
        
  <button type="submit" class="btn btn-primary" style="background-color:saddlebrown">Submit</button>
  
  </form>
</center>
        
    </body>
</html>
