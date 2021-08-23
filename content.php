<?php 
$page_title='Content';

include_once 'includes/header.php';
// include_once 'includes/newheader.php';
if(isset($_SESSION['username'])){
  $do = isset($_GET['do']) ? $_GET['do']:'home.php';
  // #####################################
  
  if($do == 'add'){
  ?>
  <div class='container' >
    <form  action="content.php?do=insert&lang='<?php echo $c_lang ?>'" method="post">
          <label class="col-sm-2 control-label"><b><?php echo $lang['language insert'] ?></b>
          <select name='lang' required>
              <option > </option>
                <option value="en">english</option>
                <option value="ar">arabic</option>
            </select>
            </label>
          <input type="text" placeholder="<?php echo $lang['course_name'] ?>" name="coursename" required>
        
          <input type="text" placeholder="<?php echo $lang['lesson_name'] ?>" name="lessonname" required>

          <input type="text" placeholder="<?php echo $lang['subject'] ?>" name="explan" required>
          <input type="date" placeholder="input start date" name="date" required>
          <button type="submit"><?php echo $lang['add'] ?></button>
    </form>
  </div>
<?php 
  

  }//end add page
  elseif($do=='insert'){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $course_name=$_POST['coursename'];
        $leson_name=$_POST['lessonname'];
        $explan   =$_POST['explan'];
        $date     =$_POST['date'];
        $lang   =$_POST['lang'];
        $stmt=$con->prepare('INSERT INTO content (coursName,lessonName,explan,startDate,lang)
                                       values(:cname,:lname,:explan,:date,:lang)');
        $stmt->execute([':cname'=>$course_name,
                        ':lname'=>$leson_name,
                        ':explan' =>$explan,
                        ':date'=>$date,
                        ':lang'=>$lang]);
                header('location:home.php?lang='.$get_lang);
  }}//end inser page
// ############ edit page ###########3
elseif($do=='edit'){
$content_id=isset($_GET['id'])?$_GET['id']:'dashboard.php';
  $contents=select('*','content','id',$content_id);
foreach($contents as $cont){
  ?>
  <form action="content.php?do=update&id=<?php echo $cont['id'];  ?>" Method="POST">
    <div>
      <input type="text" name="coursName" value="<?php echo $cont['coursName']; ?>" for="uname">
      <input type="text" name="lessonName" value="<?php echo $cont['lessonName']; ?>" for="uname">
      <input type="text" name="explan" value="<?php echo $cont['explan']; ?>"  for="uname">
      <input type="date" name="date" value="<?php echo $cont['startDate']; ?>"  for="uname">
</div>
<button type="submit"> <?php echo $lang['update'] ?> </button>
</form>


<?php

}}//end edit page 
// ########### add coure to member profie #############3
elseif($do=='enroll'){
  $id=isset($_GET['id'])?$_GET['id']:'home.php';
   $user_id=$_SESSION['ID'];
   $stmt=$con->prepare('INSERT INTO content (user_id)values(:id)');
   $stmt->execute(['id'=>$user_id,]);
}// end enroll page


elseif($do=='update'){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id    =$_GET['id'];
    $cname  =$_POST['coursName'];
    $lname =$_POST['lessonName'];
    $explan  =$_POST['explan'];
    $date  =$_POST['date'];
    $stmt=$con->prepare("UPDATE content SET  coursName=?,lessonName=?,explan=?,startDate=? WHERE id=?");
        $stmt->execute(array($cname,$lname,$explan,$date,$id));
        header('location:Dashboard.php?lang='.$c_lang);
}}//end update page
// ############### delete page #####################
elseif($do=='delete'){
  $id    =$_GET['id'];
  $check=check_item('id','content', $id);

            if($check > 0){
                $stmt=$con->prepare("DELETE FROM content WHERE id=?");
                $stmt->execute(array($id));
              header('location:Dashboard.php?lang='.$c_lang);
            }
}// ###########end delet pasge ##########################3
 // #################### start reject page ###############
elseif($do='reject'){
  $content_id=$_GET['id'];
  $stmt=$con->prepare("UPDATE content SET  user_id=0 WHERE id=?");
  $stmt->execute(array($content_id));
  header('location:Dashboard.php?lang='.$c_lang);

}//end reject page

}//end file

?>

