<?php 
$page_title='HOME';
include_once 'includes/header.php';
$page_title='HOME';
if(isset($_SESSION['username'])){
// multiaple language 
$glang=$_SESSION['lang'];
  $do = isset($_GET['do']) ? $_GET['do']:'home.php';
//  func to select data from table content
  $contents=select('*','content','lang',$glang);
?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" novalidate="novalidate">
  <?php foreach($contents as $content){
        $id=$_SESSION['ID'];
          ?> 
          <div class="content">
         <form action="cart.php?do=insert" method="post">
          <div>
            <label name="coursename">
              <h1><?php echo $content['coursName'] ?></h1>
            </label>
            <label name="lessonname">
              <h2><?php echo $content['lessonName'] ?></h4>
            </label>
            <label name="explan">
              <p><?php echo $content['explan']; ?></p>
            </label>
            <a href="cart.php?do=insert&id=<?php echo $content['id'].'&lang='.$c_lang ?>"> <?php echo $lang['enroll'] ?> </a>
         </div>
        </form>
      </div>
     <div class="container" style="background-color:#f1f1f1"></div>  
   </form>
  </body>
</html>
<?php
  }} //end file


