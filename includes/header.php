<?php
oB_start();
session_start();
if(isset($_SESSION['username'])){
  include_once 'config.php';
  include_once 'controller/functions.php';
  // include_once 'includes/footer.php';
  // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  $available_langs = array('en','ar');
  $get_lang=$_GET['lang'];
  // $_SESSION['lang'] = $get_lang;  
  if(isset($_GET['lang']) && $_GET['lang'] != ''){ 
    // check if the language is one we support
    if(in_array($_GET['lang'], $available_langs))
    {       
      $_SESSION['lang'] = $_GET['lang']; // Set session
    }
  }
  // Include active language
  if ($get_lang=='en'){
    include_once 'languages/lang.en.php';
  }else{
    include_once 'languages/lang.ar.php';
  }
  $c_lang=$_SESSION['lang'];
  
 
  

  // $$$$$$$$$$$$$$$$$$$$$$$$$$$
  $id=$_SESSION['ID'];
  $stmt=$con->prepare("SELECT adminactive,lang from users where id=?");
  $stmt->execute(array($id));
  $rows=$stmt->fetch();

?>

<!Doctype HTML>
 <html lang="en">
  <meta charset='utf-8'>
  <head>
  <title> <?php get_title() ?></title>
  <header id="allhead">
  <link rel='stylesheet' href='assets/css/style.css'/>
  </head>
  <body>
  <div class="header">
      <a href="/assets/img/logo2.png" class="logo"></a>
       <div class="header-right">
          
             <a class="active" href="Dashboard.php?do=edit&lang=<?php echo $c_lang?>"><?php echo $lang['prfole']; ?></a>
            <a class="active" href="home.php?lang=<?php echo $c_lang?>"><?php echo $lang['home']; ?></a>
            <a class="active" href="cart.php?do=mycourses&lang=<?php echo $c_lang?>"><?php echo $lang['mycourse']; ?></a>

            <?php 
        // if user is admin will show Dashboard butto  
          if($rows['adminactive'] > 0){
          echo '<a  class="active"href="Dashboard.php?do=manage&lang='.$c_lang.'">'.$lang["dashboard"].'</a>';}
          ?>
        
      </div>
      <div class="header-left">
      <a class='active' href='logout.php'><?php echo $lang['logout']; ?></a>
      <div> 
        <?php 
        if ($get_lang=='en'){
          ?>
           <a class='active' href='<?php echo $_SERVER['PHP_SELF'] ?>?lang=ar'><?php echo $lang['language']?></a>
        <?php
        }else{?>
            <a class='active' href='<?php echo $_SERVER['PHP_SELF'] ?>?lang=en'><?php echo $lang['language'] ?></a>
        <?php }
        ?>
    </div>
      </div>
  </div>
</header>
  <?php
  }else{
    header('location:index.php');
  }
