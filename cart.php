<?php 

$page_title='CART';
include_once 'includes/header.php';
// include_once 'includes/newheader.php';


if(isset($_SESSION['username'])&& !empty($_SESSION['username'])){
$do=isset($_GET['do'])?$_GET['do']:'home.php';
$user_id=$_SESSION['ID'];
$user_name=$_SESSION['username'];

//######### start insert to cart page ########

if($do=='insert'){
    $content_id=$_GET['id'];
    $stmt=$con->prepare("SELECT * from content where id=?");
    $stmt->execute(array($content_id));
    $rows=$stmt->fetchall();
   
foreach($rows as $row){
$course_name=$row['coursName'];
$lname=$row['lessonName'];
$explan=$row['explan'];
$startDate=$row['startDate'];
    $stmt=$con->prepare("INSERT INTO cart(user_id,content_id,course_name,lessonName,xplan,user_name)
                               values(:user_id,:content_id,:course_name,:lessonName,:xplan,:user_name)");
//            $value=$user_name;                   
//           $check=check_item('user_name', 'cart', $value);
// if($check>0){
//     $user_name=' ';
         $stmt->execute([':user_id'=>$user_id,
                    ':content_id'=>$content_id,
                    ':course_name' =>$course_name,
                    ':lessonName' =>$lname,
                    ':xplan' =>$explan,
                    ':user_name' =>$user_name,
                    ]);
                   
                   header('location:cart.php?do=mycourses&lang='.$c_lang);

//                 }else{
//                     $stmt->execute([':user_id'=>$user_id,
//                     ':content_id'=>$content_id,
//                     ':course_name' =>$course_name,
//                     ':lessonName' =>$lname,
//                     ':xplan' =>$explan,
//                     ':user_name' =>$user_name,
//                     ]);
//                    header('location:cart.php?do=mycourses');
//  }
}}//end insert pasge

// ########### start mycourses#############

elseif($do=='mycourses'){
        $user_id=$_SESSION['ID'];
        $stmt=$con->prepare("select * from cart where user_id=?");
        $stmt->execute(array($user_id));
        $contents=$stmt->fetchall();?>
  <div class="container" >
        <label for="uname"><b><?php echo $lang['mycourse']; ?></b></label>
        <?php foreach($contents as $cont){ ?>
        <div><button class="active"><?php echo $cont['course_name'] ?></h1> </div> 
  </div>
  <?php
  }}//endmycourses
  // ################### delet member from cours
  elseif($do=='delete'){
    $cart_id=$_GET['id'];
    // $check=check_item('user_id','cart',$cart_id);
    //       if($check > 0){
              $stmt=$con->prepare("DELETE  FROM cart WHERE id=?");
              $stmt->execute(array($cart_id));
            header('location:Dashboard.php?lang='.$c_lang);
  // }else{
  //   echo 'eror in  cart delet page ';
  // }
}}//end file 

  // include_once 'includes/footer.php';