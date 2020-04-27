<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Submission Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        
    </head>
    <body style="background-color:burlywood">
        
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
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
				  <a class="dropdown-item" href="StudentAssignmentDisplay.php">Submitted</a>
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
            </div>
        <br>
        <center>
            
            
            
            
            <h2>View Assignment:</h2><br>
    <form method="GET" action="" style="background-color:wheat">
                
    <div class="form-group row">
        <label for="student_assignment_id" class="col-sm-4 col-form-label">Assignment Id</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="assign_id" id="assign_id" value="<?php if(isset($_GET['assign_id'])){ echo $_GET['assign_id'];   }?>">	 
        </div>
    </div>
    <div class="form-group row">
        <label for="assignment_file_ext" class="col-sm-4 col-form-label">Assignment File Type</label>
        <div class="col-sm-6">
            <select id="assignment_file_ext" class="form-control" name="assignment_file_ext" required>
             <option selected>Choose...</option>
             <option value="pdf">pdf</option>
             <option value="docx">docx</option>
             <option value="txt">txt</option>
      </select>
        </div>
    </div>    
        
        <button  class="btn btn-primary" style="background-color:saddlebrown" onclick="setVal()">View Assignment</button><br>
            </form>
            <p><strong><?php if(isset($_GET['assign_id'])){echo $_GET['assign_id'];}?></strong></p><br>
        <div id="list">
        <?php if(isset($_GET['assign_id'])){
            echo '<p><iframe src="../uploads/assignments/A'.$_GET['assign_id'].'.'.$_GET['assignment_file_ext'].'" frameborder="1" height="400"accesskey="" width=" 95% "></iframe></p>';
            }
        ?>
            
        <form action="SaveSubmission.php" method="post" enctype="multipart/form-data" style="background-color:wheat">
	
	<div class="form-group row">
    <label for="assignment_id" class="col-sm-4 col-form-label">Assignment Id</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="assignment_id" id="assignment_id" value="<?php if(isset($_GET['assign_id'])){ echo $_GET['assign_id'];   }?> ">
    	 
	</div>
  </div>
	
	
        <div class="form-group row">
    <label for="student_file" class="col-sm-4 col-form-label">Upload File</label>
	<div class="col-sm-6">
    <input type="file" class="form-control-file"  name="submission_file" id="submission_file"required>
  </div>
  </div>
        
        <button type="submit" class="btn btn-primary" style="background-color:saddlebrown">Submit</button><br>
  
    </form>
        
    </div>
    
</center>
</body>
</html>