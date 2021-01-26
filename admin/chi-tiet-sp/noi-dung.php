<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="../jquery-3.1.1.min.js"></script>
	<script src="../ckeditor/ckeditor.js"></script>
	<script src="../ckfinder/ckfinder.js"></script>
</head>
<body>
	<?php
	if (isset($_GET['ma'])) {
		$ma=$_GET['ma'];
	}
	?>
	<form action="../process/noi-dung.php?ma=<?php echo $ma; ?>" method="POST">
						<textarea id="noi-dung" name="noi-dung"></textarea>
						<button>Chốt</button>
					</form>
						<script>
		CKEDITOR.replace('noi-dung', {
			filebrowserBrowseUrl:'../ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl: '../ckfinder/ckfinder.html?type=Image',
			filebrowserFlashBrowseUrl: '../ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl:'../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserUploadUrl:'../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			filebrowserUploadUrl:'../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
		});
	</script>
</body>
</html>