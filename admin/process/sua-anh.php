<?php
if (isset($_GET['ma'])&& isset($_FILES['fileToUpload']) && isset($_GET['anh'])) {
	$ma = $_GET['ma'];
	$anh = $_GET['anh'];
	$uploadOk = 1;
	if ($anh==1) {
	$target_dir = "../../uploads/anhsp/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$sql = "UPDATE product SET anhSp ='$target_file' WHERE maSP='$ma'";
} else if ($anh==2) {
	$target_dir = "../../uploads/anh2/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$sql = "UPDATE product SET anhSp2 ='$target_file' WHERE maSP='$ma'";
} else if ($anh==3) {
	$target_dir = "../../uploads/anh3/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$sql = "UPDATE product SET anhSp3 ='$target_file' WHERE maSP='$ma'";
} else {
	$target_dir = "../../uploads/anh4/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$sql = "UPDATE product SET anhSp4 ='$target_file' WHERE maSP='$ma'";
}
	
$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
  $filetype = $_FILES["fileToUpload"]["type"];

             $ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if(!array_key_exists($ext, $allowed)){
              $uploadOk = 0;
}
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";

} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $con = mysqli_connect('localhost','root','','project');
      $sql1 = "SELECT * FROM product WHERE maSP = '$ma'";
      $result = mysqli_query($con,$sql1);
      while ($src = mysqli_fetch_array($result)) {
      	$anh1 = $src['anhSp'];
      	$anh2 = $src['anhSp2'];
      	$anh3 = $src['anhSp3'];
      	$anh4 = $src['anhSp4'];
      }
      if($anh==1 && $anh1!=''){
      	unlink($anh1);
      } else if ($anh == 2 && $anh2 != '') {
      	unlink($anh2);
      } else if ($anh == 3 && $anh3 != '') {
      	unlink($anh3);
      } else if ($anh == 4 && $anh4 != '') {
      	unlink($anh4);
      }
      mysqli_query($con,$sql);
      mysqli_close($con);
     header("location:../common/main.php?command=3&ma=$ma");
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}