<?php

require('config/config.php');
require('config/db.php');



$msg = '';
$msgClass = '';

if(isset($_POST['login'])){
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    
    if(empty($_POST['username']) || empty($_POST['password'])){
        
        $msg = 'Username or Password is invalid';
        $msgClass = 'alert-danger';
        
    } else {
        
        $sql = "SELECT * FROM registerinfo WHERE username='$username'";
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $hashedPwdCheck = password_verify($password,$row['password']);
        
     
     
           if($resultCheck > 0 && $hashedPwdCheck == true ){
            
               //$msg = 'Success';
              // $msgClass = 'alert-success';
               header('Location: welcome.php');
            
        } else {
            
               $msg = 'Username doesnt exist or Password doesnt match';
               $msgClass = 'alert-danger';
               
                    
                }
                
               
            
        }
        
    }
    








?>


<!doctype html>
<html>
<head>
  <title>Practice Test</title>
  <link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>



    <div class="container">
        <?php if($msg != ''): ?>
        <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
      <?php endif; ?>
     <form method="post" action="">
      <img src="icon-people-green.png" class="avatar"/>
       <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" class="form-control" placeholder="name123" value="">
        </div>
         <div class="form-group">
           <label>Password</label>
          <input type="password" name="password" class="form-control">
        </div>
        <br>
        <button type="submit" name="login" class="btn btn-primary">Login</button>
         <a href="index.php" class="btn btn-primary">Register</a>
         
    </form>
   </div>

</body>
</html>

