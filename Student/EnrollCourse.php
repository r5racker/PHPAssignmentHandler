<?php
        session_start();
    if(isset($_SESSION['user_email'])){
    $dbhandler = new PDO('mysql:host=localhost:3306;dbname=ce4_13','root','');
    //$dbhandler = new PDO('mysql:host=192.168.29.150;dbname=ce4_13','ce4_13','ce4_13');
    //echo "Connection is established...<br/>";
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $ret_sql="INSERT INTO StudentCourse" ."(c_id,student_email)"."VALUES(?,?)";
    $ret_prepared_sql=$dbhandler->prepare($ret_sql);
    $ret_prepared_sql->execute(array($_GET["c_id"],$_SESSION["user_email"]));
    header('Location:ViewAllStudentCourses.php');
    }
?>

