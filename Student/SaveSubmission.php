<?php
session_start();
if(isset($_SESSION['user_email'])){
    
    $base_dir_path="..\\uploads";
        $target_location=$base_dir_path."\\".$_SESSION['user_email']."\\".basename($_FILES["submission_file"]["name"]);
        if(! (move_uploaded_file($_FILES["submission_file"]["tmp_name"], $target_location))){
                echo "\nError: ".$_FILES["submission_file"]["name"].", ".$target_location. $_FILES["submission_file"]["error"] . "<br>size?:".$_FILES["submission_file"]["size"]." png?:".strcmp($_FILES["submission_file"]["type"],'image/png');
                echo '<a href="SubmissionPage.php">try again</a>';
                die();
        }
        $ext = pathinfo($target_location, PATHINFO_EXTENSION);
        $new_name=$base_dir_path."\\".$_SESSION['user_email']."\\"."S".$_POST['assignment_id'].".".$ext;
        rename($target_location,$new_name);
    
    $file_name="S".$_POST['assignment_id'].".".$ext;
    $dbhandler = new PDO('mysql:host=localhost:3306;dbname=ce4_13','root','');
    //$dbhandler = new PDO('mysql:host=192.168.29.150;dbname=ce4_13','ce4_13','ce4_13');
    echo "Connection is established...<br/>";
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    if(isset($_FILES['submission_file'])){
        $dbhandler = new PDO('mysql:host=localhost:3306;dbname=ce4_13','root','');
        //$dbhandler = new PDO('mysql:host=192.168.29.150;dbname=ce4_13','ce4_13','ce4_13');
        //echo "Connection is established...<br/>";
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        try{
            $ret_sql="select c_id from Assignments where assign_id=?";
            $ret_prepared_sql=$dbhandler->prepare($ret_sql);
            $ret_prepared_sql->execute(array($_POST["assignment_id"]));
            $ret_row=$ret_prepared_sql->fetch();
            $c_id= $ret_row["c_id"];
            
            //$input_date=$_POST["assignment_due_date"];
            //$todays_date=date("Y-m-d H:i:s",strtotime($input_due_date));
            $todays_date=date("Y-m-d H:i:s");
            
            $sql="insert into Submissions"
            . "(assign_id,student_email,c_id,submission_date,submission_file_name) "
            . "values(?,?,?,?,?)";
            $prepared_sql=$dbhandler->prepare($sql);
            $prepared_sql->execute(array($_POST["assignment_id"],$_SESSION["user_email"],$c_id,$todays_date,$file_name));
            
            
            
        }
        catch(PDOException $e){
            
            //$input_date=$_POST["assignment_due_date"];
            //$todays_date=date("Y-m-d H:i:s",strtotime($input_due_date));
            $todays_date=date("Y-m-d ");
            
            $sql1="update Submissions "
            . "SET submission_date=?,submission_file_name=? "
            . "where assign_id=?";
            $prepared_sql1=$dbhandler->prepare($sql1);
            $prepared_sql1->execute(array($todays_date,$file_name,$_POST["assignment_id"]));
            
            
            echo "<br><h3>Your submission file is replaced Sucessfully</h3>";
            
            //echo $e->getMessage();
            //die();
        }
    }
    else{
        header("Location:SubmissionPage.html");
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
        <td><a class="btn btn-outline-primary" href='StudentAssignmentDisplay.php' role="button">View Submissions</a></td></tr>
<br><td><a class="btn btn-outline-primary" href='StudentHome.php' role="button">Add more at Home</a></td></tr>
</center>
    </body>
</html>