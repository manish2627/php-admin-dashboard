<?Php 

function uploadImage(){
    $filename= $_FILES['profile_pic']['name'];
    $tempname= $_FILES['profile_pic']['tmp_name'];
    $folder = "assets/img/profile".$filename;
    move_uploaded_file($tempname,$folder);
}
if (isset($_POST['submit'])&& isset($_FILES['profile_pic'])){
   
    uploadImage();
  


}
?>
<form action="" method="POST"  enctype="multipart/form-data">
    <input type="file" name="profile_pic">
    <button type="submit" name='submit'>submit</button>
</form>