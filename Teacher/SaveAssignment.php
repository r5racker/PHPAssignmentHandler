<?php
session_start();
if(isset($_SESSION['user_email'])){
    $dbhandler = new PDO('mysql:host=localhost:3306;dbname=ce4_13','root','');
    //$dbhandler = new PDO('mysql:host=192.168.29.150;dbname=ce4_13','ce4_13','ce4_13');
    //echo "Connection is established...<br/>";
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $ret_sql="select assign_id from Assignments where assign_name=? and c_id=?";
    $ret_prepared_sql=$dbhandler->prepare($ret_sql);
    $ret_prepared_sql->execute(array($_POST["assignment_name"],$_POST["course_assignment_id"]));
    $ret_row=$ret_prepared_sql->fetch();
    //echo $ret_row["assign_id"]
    if(!isset($ret_row["assign_id"])){
        
        
        $dbhandler = new PDO('mysql:host=localhost:3306;dbname=ce4_13','root','');
        //$dbhandler = new PDO('mysql:host=192.168.29.150;dbname=ce4_13','ce4_13','ce4_13');
        
        
        //echo "Connection is established...<br/>";
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        try{
            $input_initial_date=$_POST["assignment_initial_date"];
            $init_date=date("Y-m-d H:i:s",strtotime($input_initial_date));
            $input_due_date=$_POST["assignment_due_date"];
            $due_date=date("Y-m-d H:i:s",strtotime($input_due_date));
            $teacher_email=$_POST["teacher_assignment_email"];
            
            $sql="insert into Assignments"
            . "(assign_name,teacher_email,c_id,initial_date,due_date,max_size) "
            . "values(?,?,?,?,?,?)";
            
            $prepared_sql=$dbhandler->prepare($sql);
            $prepared_sql->execute(array($_POST["assignment_name"],$_POST["teacher_assignment_email"],$_POST["course_assignment_id"],$init_date,$due_date,$_POST["assignment_max_upload_size"]));
            echo "Creating Assignment";
            $ret_prepared_sql->execute(array($_POST["assignment_name"],$_POST["course_assignment_id"]));
            $ret_row=$ret_prepared_sql->fetch();
            $assign_id=$ret_row["assign_id"];
            echo $assign_id."created successfully";
//            echo "<a href='TeacherHome.php'>Home</a>";
//            echo "<a href='AssignmentPage.php'>Add More Assignments</a>";
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
        //saving the file
        if(!file_exists('..\\uploads\\assignments')) 
            {
                mkdir('..\\uploads\\assignments', 0777, true);
            }
        
        
        $base_dir_path="..\\uploads";
        $target_location=$base_dir_path."\\assignments\\".basename($_FILES["assignment_file"]["name"]);
        if(! (move_uploaded_file($_FILES["assignment_file"]["tmp_name"], $target_location))){
                echo "\nError0101: ".$_FILES["assignment_file"]["name"].", ".$target_location. $_FILES["assignment_file"]["error"] . "<br>size?:".$_FILES["assignment_file"]["size"]." png?:".strcmp($_FILES["assignment_file"]["type"],'image/png');
                die();
        }
        $ext = pathinfo($target_location, PATHINFO_EXTENSION);
        $new_name=$base_dir_path."\\assignments\\"."A".$assign_id.".".$ext;
        rename($target_location,$new_name);
    }
    else{
        //saving the file
        if(!file_exists('..\\uploads\\assignments')) 
            {
                mkdir('..\\uploads\\assignments', 0777, true);
            }
        
        $base_dir_path="..\\uploads";
        $target_location=$base_dir_path."\\assignments\\".basename($_FILES["assignment_file"]["name"]);
        if(! (move_uploaded_file($_FILES["assignment_file"]["tmp_name"], $target_location))){
                echo "\nError0101: ".$_FILES["assignment_file"]["name"].", ".$target_location. $_FILES["assignment_file"]["error"] . "<br>size?:".$_FILES["assignment_file"]["size"]." png?:".strcmp($_FILES["assignment_file"]["type"],'image/png');
                die();
        }
        $ext = pathinfo($target_location, PATHINFO_EXTENSION);
        $new_name=$base_dir_path."\\assignments\\"."A".$assign_id.".".$ext;
        rename($target_location,$new_name);
        header("Location:AssignmentPage.php");
    }
}
else{
    header("Location:../login.php?message=Please Login");
}
?>


    <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>
		Student Registration
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body style="background-color:powderblue;">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        
        
        
    <center>
        <td><a class="btn btn-outline-primary" href="AssignmentPage.php" role="button">Add more assignment's</a></td></tr>
<br><td><a class="btn btn-outline-primary" href="TeacherHome.php" role="button">Home</a></td></tr>
</center>
    </body>
</html>
    