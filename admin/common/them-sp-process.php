    <?php
    if (isset($_FILES['fileToUpload'])) {
$target_dir = "../../uploads/anhsp/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$ten = $_POST['ten'];
$hang = $_POST['hang'];
$theloai = $_POST['theloai'];
$gia = $_POST['gia'];
if (file_exists($target_file)) {
  $uploadOk = 0;
  echo "đã tồn tại";
}
   $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
  $filetype = $_FILES["fileToUpload"]["type"];

             $ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if(!array_key_exists($ext, $allowed)){
              $uploadOk = 0;
  echo "chọn đúng định dạng file";
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $con = mysqli_connect('localhost','root','','project');
      $sql = "INSERT INTO product(tenSP, theLoai,hang,gia,anhSp) VALUES ('$ten','$theloai','$hang','$gia','$target_file')";
      mysqli_query($con,$sql);
      mysqli_close($con);
     header("location:main.php");
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}
?>