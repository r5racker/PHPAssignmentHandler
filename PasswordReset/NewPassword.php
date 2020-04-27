<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>
		Assignment Page
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body style="background-color:powderblue;">
      <?php
      $msg="Enter new password";
      if(isset($_POST['user_password'])){
          if(strcmp($_POST['user_password'], $_POST['user_password2'])==0){
                $dbhandler = new PDO('mysql:host=localhost:3306;dbname=ce4_13','root','');
                //$dbhandler = new PDO('mysql:host=192.168.29.150;dbname=ce4_13','ce4_13','ce4_13');
                echo "Connection is established...<br/>";
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $ret_sql="Update users " ."set user_password=? where user_email=?";
                $ret_prepared_sql=$dbhandler->prepare($ret_sql);
                $ret_prepared_sql->execute(array($_POST['user_password'],$_POST["user_email"]));
                header('Location:../login.php?message=Password reset sucessfull');
          }
          else{
              $msg="reentered password missmatch!<br>Try Again";
          }
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
                      <h2>
                          <?php
                            if(isset($msg)){  echo $msg;}
                          ?>
                      </h2>
		    </div>
		</div>
	</div>
    
    <br>
    <form action="" method="post">
      <div class="form-group row">
    <label for="user_email" class="col-sm-4 col-form-label">Email</label>
    <div class="col-sm-6">
      <input type="email" class="form-control" id="user_email" name="user_email"value='<?php echo $_GET['user_email']?>' required>
    </div>
  </div>
        
        <div class="form-group row">
    <label for="user_password" class="col-sm-4 col-form-label">New Password</label>
    <div class="col-sm-6">
      <input type="password" class="form-control" id="user_password" name="user_password" required>
    </div>
  </div>
        <div class="form-group row">
    <label for="user_password2" class="col-sm-4 col-form-label">Re-enter New Password</label>
    <div class="col-sm-6">
      <input type="password" class="form-control" id="user_password2" name="user_password2" required>
    </div>
  </div>
         <button type="submit" class="btn btn-primary">Submit</button>
    </form>