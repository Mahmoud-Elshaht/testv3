<?php
$page_title='Dashboards';
include_once 'includes/header.php';
// include_once 'includes/newheader.php';
if(isset($_SESSION['username'])){
    $user_id=$_SESSION['ID'];
    $do = isset($_GET['do']) ? $_GET['do']:'manage';
// $c_lang=$_SESSION['lang'];
// ############## start manage member  #############
if($do == 'manage'){
// $$$$$$$$$$$$$$ query fetch all data from content table$$$$$$$$$$$$$
  $contents=select('*','content');
  // $$$$$$$$$$$$$$ query fetch all data from cart table$$$$$$$$$$$$$
  $carts=select('*','cart');
  /// $$$$$$$$$$$$$$ query fetch all data from users table$$$$$$$$$$$$$
  $users=select('*','users');
  // #################################################
?>
<h1 class="text-center"><?php echo $lang['Manage MEMBERS'] ?></h1>

<table style="width:100%" id="deluser">

  <tr>
    <th><?php echo $lang['member id'] ?></th>
    <th><?php echo $lang['Manage MEMBERS'] ?></th>
    <th><?php echo $lang['email'] ?></th>
    <th><?php echo $lang['active_admin'] ?></th>
    <th><?php echo $lang['sigup_time'] ?></th>
    <th><?php echo $lang['control'] ?></th>
  </tr>
  <?php 
   foreach($users as $row){
        echo"<tr>";
            echo "<td>" . $row['id'] ."</td>";
            echo "<td>" . $row['name'] ."</td>";
            echo "<td>" . $row['email'] ."</td>";
            if($row['adminactive']>0){
            echo "<td>".$lang['yes']." </td>";
            }else{
              echo "<td>".$lang['no']." </td>";
            }
              echo "<td>" . $row['Created_at'] ."</td>";
              echo "<td> <a href='Dashboard.php?do=delete&id=".$row['id'].'&lang='.$c_lang."> <button type='button'>".$lang['delete']."</a></td>";
              echo'</tr>';}//end for each
?>
 </table>
 <table style="width:100%">
  <tr>
    <th><?php echo $lang['course_name'] ?></th>
    <th><?php echo $lang['start date'] ?></th>
    <th colspan="2"> <?php echo $lang['enroled members'] ?></th>
    <th><?php echo $lang['control'] ?></th>
  </tr>
  <?php
  foreach($contents as $cont){
    echo "<tr>";
        echo "<td>" . $cont['coursName']."</td>";
        echo "<td>" . $cont['startDate']."</td>";
        foreach($users as $user){
          foreach($carts as $cart){
             
                  if($user['id'] == $cart['user_id']){
                      if($cart['content_id']==$cont['id']){
                      
                        echo " <td>" .$cart['user_name'].
                      " <a href='cart.php?do=delete&id=".$cart['id'].'&lang='.$c_lang."'> ".$lang['cancel']."</a> </td>";
                      }
                  }
            }}
        echo "<td> <a href='content.php?do=edit&id=".$cont['id'].'&lang='.$c_lang."> <button type='button'> ".$lang['edit']."<br> </a>";
        echo  "<a href='content.php?do=delete&id=".$cont['id'].'&lang='.$c_lang."> <button type='button'>  ".$lang['delete'] ."</button></a></td>";
        echo"</tr>";}    
?>
  </table>
  <a class="active" href="content.php?do=add&lang=<?php echo $c_lang?>"><?php echo "<button type='button'>" .$lang['add course']."</button>"; ?></a>
  <?php 
// ###########################################################
               // edit member data 
  // ##########################################################3
}elseif($do == 'edit'){ 
    $user_id=$_SESSION['ID'];
      $stmt=$con->prepare("select * from users where id=$user_id");
      $stmt->execute();
      $rows=$stmt->fetch();  
    ?>
     <h1 class="text-center"> <?php echo $lang['Edit-Profile'] ?></h1> 
     <form action="Dashboard.php?do=update&lang=<?php echo $get_lang ?>" method="post" novalidate="novalidate">
    <div class="container">
        <label for="uname"><b><?php echo $lang['username'] ?></b></label>
          <input type="text" value="<?php echo $rows['name'] ?>" name="name" required>
          <label for="email"><b><?php echo $lang['email'] ?></b></label>
          <input type="email" value="<?php echo $rows['email'] ?>" name="email" required>

          <label for="psw"><b><?php echo $lang['Password'] ?></b></label>
          <input type="password" value="<?php echo $rows['password'] ?>"    outocomplete="outocomplete" name="password" required>
          <a href="Dashboard.php?do=update&lang=<?php echo $get_lang?>">
            <button type="submit"><?php echo $lang['update'] ?></button>
          </a>
  </div>
        
 <?php } //<== End Edit member Page ===>

//  ########## update member data ###########
elseif($do=='update'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id    =$_SESSION['ID'];
        $name  =$_POST['name'];
        $email =$_POST['email'];
        $pass  =$_POST['password'];
        $value=$id;
        $check = check_item('id','users',$value);
        if($check>0){
    $stmt=$con->prepare("UPDATE users SET  name=?,email=?,password=? WHERE id=?");
            $stmt ->execute(array($name,$email,$pass,$id));
            header('location:Dashboard.php?lang=<?php echo $get_lang?>&&do=edit');
          
    }}
    //#### start member delete page #####
  }elseif($do=='delete'){
    
      $userid = $_GET['id'];
      $check=check_item('id','users', $userid);
            if($check > 0){
                // delete function in function files
                 delete('users',$userid);
                 header('location:Dashboard.php?lang=<?php echo $get_lang?>');
              }else{
              echo 'errore on delet member page';
            }
// ############ show all content ############
}elseif($do=='allcourses'){
      $user_id=$_SESSION['ID'];
      select('*','content','',$user_id);
      ?>
  <div>
  <label for="uname"><b>MY courses</b></label>
  <?php foreach($contents as $cont){ ?>
    <button type="button"  name="signup"><?php echo $cont['coursName'] ?></button> 
  <?php }?>   
 </div>
  <?php
  }
}
  // #####################################################

