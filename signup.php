<?php 
include_once 'config.php';
include_once 'controller/functions.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
  $user_name=$_POST['username'];
  $email=$_POST['email'];
  $password=$_POST['password'];


$value=$email;
$check=check_item('email', 'users', $value);
if($check==0){
  $stmt=$con->prepare('INSERT INTO users(name,email,password)
                                   values(:name,:email,:password)');

 

$stmt->execute([':name'     =>$user_name,
                ':email'    =>$email,
                ':password' =>$password]);

              header('location:index.php');
}else{
  echo '<h3 div  class="text-center alert alert-succes"> Please input other data' .'</h3>';
}
      
}
?>


<!-- <!Doctype HTML>
<meta charset='utf-8'>
<head>
<link rel='stylesheet' href='assets/css/style.css'/>
</head> -->
<!Doctype HTML>
<meta charset='utf-8'>
<head>
<link rel='stylesheet' href='assets/css/style.css'/>
<title>SIGN UP</title>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" novalidate="novalidate">
  <div class="imgcontainer">
    <img src="assets/img/loginavatar.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
   <label for="uname"><b>username</b></label>
    <input type="text" placeholder="Enter user name" name="username" required>
    <label for="email"><b>email</b></label>
    <input type="email" placeholder="Enter email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">signup</button>
    <label><span class="sp">
    <a href="index.php" class="btn hero-btn">
      <button type="button"  name="signup">Sign in</button> 
      </a>
    </label>
   </div>
    
   </div>
  
   <div class="container" style="background-color:#f1f1f1">
    <!-- <button type="button" class="cancelbtn">Cancel</button> -->
    <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
   </div>
</form>




ll