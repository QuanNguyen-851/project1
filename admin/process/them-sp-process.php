    <?php
    if (isset($_FILES['fileToUpload']) && isset($_POST['ten']) && isset($_POST['hang']) && isset($_POST['theloai']) && isset($_POST['gia'])) {
$target_dir = "../../uploads/anhsp/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$ten = $_POST['ten'];
$hang = $_POST['hang'];
$theloai = $_POST['theloai'];
$gia = $_POST['gia'];
$soluong = $_POST['soluong'];
if (file_exists($target_file)) {
  
  header("location:../common/main.php?exist");
}
   $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
  $filetype = $_FILES["fileToUpload"]["type"];

             $ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if(!array_key_exists($ext, $allowed)){
              $uploadOk = 0;
}

if ($uploadOk == 0) {
 header("location:../common/main.php?fail");

} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $con = mysqli_connect('localhost','root','','project');
      $sql = "INSERT INTO product(tenSP, theLoai,hang,gia,anhSp,soLuong) VALUES ('$ten','$theloai','$hang','$gia','$target_file','$soluong')";
      mysqli_query($con,$sql);
      mysqli_close($con);
     header("location:../common/main.php");
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}
?>