<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if(isset($_SESSION[user_email])){
    unset($_SESSION[user_email]);
}
header("Location:login.php?message=Sucessfully Loged out");
?>