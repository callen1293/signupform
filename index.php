<?php

$msg = '';
$msgClass = '';

//Register

require('config/config.php');
require('config/db.php');


if(isset($_POST['register'])){
    
    
    //get form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    
    $username_check = mysqli_query($conn, "SELECT * FROM registerinfo WHERE username = '$username'");
    $username_count = mysqli_num_rows($username_check);
    
    $user_email_check = mysqli_query($conn, "SELECT * FROM registerinfo WHERE email = '$email'");
    $email_count = mysqli_num_rows($user_email_check);
    
    
    
    if(!empty($username) && !empty($email) && !empty($password) && !empty($confirm_password)){
         
        if($password == $confirm_password){
            
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                
                if($username_count == 0){
                    
                    if($email_count == 0){
                        
                
                
    
           $hashedPwd = password_hash($password,PASSWORD_DEFAULT);

           
           $query = "INSERT INTO registerinfo(username,email,password) VALUES('$username','$email','$hashedPwd')";
                           
                        
           mysqli_query($conn, $query);
                        
          
           //header('location: index.php');   
                    
               $msg = 'Success! You are ready to login';
               $msgClass = 'alert-success';             
                        
                        
                        
             }else{
               $msg = 'Email already exists';
               $msgClass = 'alert-danger';    
                        
                }
                     
                        
        
             }else{
               $msg = 'Username already exists';
               $msgClass = 'alert-danger';
                    
                }
                    
                    
         
             }else{
               $msg = "Please enter a valid email";
               $msgClass = 'alert-danger';
              }
        
         
         
           }else{
               $msg = "Passwords must be the same";
               $msgClass = 'alert-danger';
              }

        
       
           }else{
       
              $msg = 'Please fill in all fields';
              $msgClass = 'alert-danger';
       
     }
    
                        
}

    

?>

<!doctype html>
<html>
<head>
  <title>Practice Test</title>
  <link rel="stylesheet" href="main.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">     
</head>
<body>



    <div class="container">
      <?php if($msg != ''): ?>
        <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
      <?php endif; ?>
     <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      <img src="download.png" class="avatar"/>
       <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" class="form-control" placeholder="name123" value="<?php echo isset($_POST['username']) ? $username : ''; ?>">
        </div>
         <div class="form-group">
          <label>Email</label>
          <input type="text" name="email" class="form-control" placeholder="test@test.com"value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
        </div>
         <div class="form-group">
           <label>Password</label>
          <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
          <label>Confirm Password</label>
         <input type="password" name="confirm_password" class="form-control">
       </div>
        <br>
        <button type="submit" name="register" class="btn btn-primary">Register</button>
         <a href="login.php" class="btn btn-primary">Login</a>
    </form>
   </div>

    
    
<script>src="http://code.jquery.com/jquery-3.3.1.js"integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="crossorigin="anonymous""></script>
<script>src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"</script>
</body>
</html>



