<?php 
ob_start();
session_start();
include_once 'config.php';
include_once 'controller/functions.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    
  $username = $_POST['username']; 
  $userpass =$_POST['password'];
  $stmt = $con -> prepare("SELECT 
                              id,name,Password 
                          FROM
                             users
                          WHERE 
                          name=? 
                          AND  
                          password=?
                          LIMIT 1 ");

  $stmt->execute(array($username ,$userpass));
  $row=$stmt->fetch();
  $count=$stmt->rowcount();
  if($count > 0){
      $_SESSION['username'] = $username;
      $_SESSION['ID']=$row['id']; 
      header('location:home.php?lang=en');
      // print_r($row);
  }else{
      echo 'error';
      // header('location:index.php');
  }}
?>
<!Doctype HTML>
<meta charset='utf-8'>
<title>login</title>
<head>
<link rel='stylesheet' href='assets/css/style.css'/>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" novalidate="novalidate">
  <div class="imgcontainer">
    <img src="assets/img/loginavatar.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
      <label for="username"><b>email</b></label>
      <input type="text" placeholder="Enter user" name="username" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <button type="submit">Login</button>
      <!-- <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label> -->
      <label><span class="sp">
        <a href="signup.php" class="btn hero-btn">
          <button type="button"  name="signup">Sign up</button> 
        </a>
      </label>
  </div>
  
  <div class="container" style="background-color:#f1f1f1">
  </div>
</form>
<!-- ###################################### -->
</body>
</html>
