<?php

/*

In this example we will:
1. Accept a file
2. Create variable to represent the file
3. Get the file extension
4. Validate the file was uploaded properly and that it's a valid size and extension
5. Check if file already exists
6. Move file to server

*/

// Create vars
$errors = array();
$datafield = 'upload';
$allowedfiles = array('gif', 'png', 'jpg', 'jpeg','pdf');
$maxfilesize = 104857600; // 100 MB = 1024*1024*100 bytes
$showfilesize = "10MB";
$success = false;
$message = '';

// Check if our form was submitted
if (isset($_FILES) && isset($_FILES[$datafield])) {

	// Store the data that was sent via $_FILES
	// This is just so we have a shorter variable to work with - $data - instead of having to write out $_FILES['upload'].
	// This also make this code more reusable
	$data = $_FILES[$datafield];

	// Get the filetype of the passed file - this may be a fake extension so it can't actually be trusted but it's a start
	$filetype = pathinfo($data['name'], PATHINFO_EXTENSION);

	// Validate the passed file
	if ($data['error'] == 4) // No file was attached
		$errors['data_incomplete'] = 'Please select a file to upload.';
	elseif ($data['error'] == 1) // php.ini's upload_max_filesize was exceeded
		$errors['data_excessive'] = 'The file you attempted to upload is larger than the maximum allowed filesize of '.$showfilesize.'.';
	elseif ($data['error'] == 3) // The file was only partially uploaded
		$errors['data_failure'] = 'There was a problem uploading your file. Please try again.';
	elseif ($data['error'] == 2 || filesize($data['tmp_name']) > $maxfilesize) // Over php's html form max file size or manually set limit
		$errors['data_excessive'] = 'The file you attempted to upload is larger than the maximum allowed filesize of '.$showfilesize.'.';
	elseif ($data['error'] == 6 || $data['error'] == 7 || $data['error'] == 8) // No folder, cant write, or stopped
		$errors['data_failure'] = 'There was a problem uploading your file. Please try again.';
	elseif (!is_uploaded_file($data['tmp_name'])) // Not sent through POST, possible attack
		$errors['data_failure'] = 'There was a problem uploading your file. Please try again.';
	elseif (!in_array($filetype, $allowedfiles)) // File is not an allowed type
		$errors['data_invalid'] = 'The type of file you selected is invalid. Please select from '.implode(', ', $allowedfiles).'.';

	// Check if the file already exists
	if (!$errors) {
		if (file_exists($data['name'])) {
			$errors['file_exists'] = 'This file already exists.';
		}
	}

	// Move the file to our server - it is currently being saved in some temporary location as defined in your server configuration
	if (!$errors) {
		$move = move_uploaded_file($data['tmp_name'], $data['name']); // Move file to current directory
		if (!$move) {
			$errors['data_unmoved'] = 'There was a problem uploading your file. Please try again.';
		} else {
			$success = true;
			if( $data['type'] == 'image/jpg' || $data['type'] == 'image/gif' || $data['type'] == 'image/jpeg' || $data['type'] == 'image/png' )
			{
				$message = 'Success! Here\'s your file: <img src="'.$data['name'].'" >';
			}
			else {
				$message = 'Success! Here\'s your file: <a href="'.$data['name'].'" title="Download">'.$data['name'].'</a>';
			}

		}
	}

}







// Create vars
$errors1 = array();
$datafield1 = 'pdf';
$allowedfiles1 = array('gif', 'png', 'jpg', 'jpeg','pdf');
$maxfilesize1 = 104857600; // 100 MB = 1024*1024*100 bytes
$showfilesize1 = "10MB";
$success1 = false;
$message1 = '';

// Check if our form was submitted
if (isset($_FILES) && isset($_FILES[$datafield1])) {

	// Store the data that was sent via $_FILES
	// This is just so we have a shorter variable to work with - $data - instead of having to write out $_FILES['upload'].
	// This also make this code more reusable
	$data1 = $_FILES[$datafield1];

	// Get the filetype of the passed file - this may be a fake extension so it can't actually be trusted but it's a start
	$filetype1 = pathinfo($data1['name'], PATHINFO_EXTENSION);

	// Validate the passed file
	if ($data1['error'] == 4) // No file was attached
		$errors1['data_incomplete'] = 'Please select a file to upload.';
	elseif ($data1['error'] == 1) // php.ini's upload_max_filesize was exceeded
		$errors1['data_excessive'] = 'The file you attempted to upload is larger than the maximum allowed filesize of '.$showfilesize1.'.';
	elseif ($data1['error'] == 3) // The file was only partially uploaded
		$errors1['data_failure'] = 'There was a problem uploading your file. Please try again.';
	elseif ($data1['error'] == 2 || filesize($data1['tmp_name']) > $maxfilesize1) // Over php's html form max file size or manually set limit
		$errors1['data_excessive'] = 'The file you attempted to upload is larger than the maximum allowed filesize of '.$showfilesize1.'.';
	elseif ($data1['error'] == 6 || $data1['error'] == 7 || $data1['error'] == 8) // No folder, cant write, or stopped
		$errors1['data_failure'] = 'There was a problem uploading your file. Please try again.';
	elseif (!is_uploaded_file($data1['tmp_name'])) // Not sent through POST, possible attack
		$errors1['data_failure'] = 'There was a problem uploading your file. Please try again.';
	elseif (!in_array($filetype1, $allowedfiles1)) // File is not an allowed type
		$errors1['data_invalid'] = 'The type of file you selected is invalid. Please select from '.implode(', ', $allowedfiles1).'.';

	// Check if the file already exists
	if (!$errors1) {
		if (file_exists($data1['name'])) {
			$errors1['file_exists'] = 'This file already exists.';
		}
	}

	// Move the file to our server - it is currently being saved in some temporary location as defined in your server configuration
	if (!$errors1) {
		$move = move_uploaded_file($data1['tmp_name'], $data1['name']); // Move file to current directory
		if (!$move) {
			$errors1['data_unmoved'] = 'There was a problem uploading your file. Please try again.';
		} else {
			$success1 = true;
			//$message1 = 'Success! Here\'s your file: <a href="'.$data1['name'].'" title="Download">'.$data1['name'].'</a>';
			if( $data1['type'] == 'image/jpg' || $data1['type'] == 'image/gif' || $data1['type'] == 'image/jpeg' || $data1['type'] == 'image/png' )
			{
				$message1 = 'Success! Here\'s your file: <img src="'.$data1['name'].'" >';
			}
			else {
				$message1 = 'Success! Here\'s your file: <a href="'.$data1['name'].'" title="Download">'.$data1['name'].'</a>';
			}
		}
	}

}






// Create vars
$errors2 = array();
$datafield2 = 'filess';
$allowedfiles2 = array('gif', 'png', 'jpg', 'jpeg','pdf');
$maxfilesize2 = 104857600; // 100 MB = 1024*1024*100 bytes
$showfilesize2 = "10MB";
$success2 = false;
$message2 = '';

// Check if our form was submitted
if (isset($_FILES) && isset($_FILES[$datafield2])) {

	// Store the data that was sent via $_FILES
	// This is just so we have a shorter variable to work with - $data - instead of having to write out $_FILES['upload'].
	// This also make this code more reusable
	$data2 = $_FILES[$datafield2];

	// Get the filetype of the passed file - this may be a fake extension so it can't actually be trusted but it's a start
	$filetype2 = pathinfo($data2['name'], PATHINFO_EXTENSION);

	// Validate the passed file
	if ($data2['error'] == 4) // No file was attached
		$errors2['data_incomplete'] = 'Please select a file to upload.';
	elseif ($data2['error'] == 1) // php.ini's upload_max_filesize was exceeded
		$errors2['data_excessive'] = 'The file you attempted to upload is larger than the maximum allowed filesize of '.$showfilesize2.'.';
	elseif ($data2['error'] == 3) // The file was only partially uploaded
		$errors1['data_failure'] = 'There was a problem uploading your file. Please try again.';
	elseif ($data2['error'] == 2 || filesize($data2['tmp_name']) > $maxfilesize2) // Over php's html form max file size or manually set limit
		$errors2['data_excessive'] = 'The file you attempted to upload is larger than the maximum allowed filesize of '.$showfilesize2.'.';
	elseif ($data2['error'] == 6 || $data2['error'] == 7 || $data2['error'] == 8) // No folder, cant write, or stopped
		$errors2['data_failure'] = 'There was a problem uploading your file. Please try again.';
	elseif (!is_uploaded_file($data2['tmp_name'])) // Not sent through POST, possible attack
		$errors2['data_failure'] = 'There was a problem uploading your file. Please try again.';
	elseif (!in_array($filetype2, $allowedfiles2)) // File is not an allowed type
		$errors2['data_invalid'] = 'The type of file you selected is invalid. Please select from '.implode(', ', $allowedfiles2).'.';

	// Check if the file already exists
	if (!$errors2) {
		if (file_exists($data2['name'])) {
			$errors2['file_exists'] = 'This file already exists.';
		}
	}

	// Move the file to our server - it is currently being saved in some temporary location as defined in your server configuration
	if (!$errors2) {
		$move = move_uploaded_file($data2['tmp_name'], $data2['name']); // Move file to current directory
		if (!$move) {
			$errors2['data_unmoved'] = 'There was a problem uploading your file. Please try again.';
		} else {
			$success2 = true;
			//$message2 = 'Success! Here\'s your file: <a href="'.$data2['name'].'" title="Download">'.$data2['name'].'</a>';
			if( $data2['type'] == 'image/jpg' || $data2['type'] == 'image/gif' || $data2['type'] == 'image/jpeg' || $data2['type'] == 'image/png' )
			{
				$message2 = 'Success! Here\'s your file: <img src="'.$data2['name'].'" >';
			}
			else {
				$message2 = 'Success! Here\'s your file: <a href="'.$data2['name'].'" title="Download">'.$data2['name'].'</a>';
			}
		}
	}

}








?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP Uploads</title>
		
		<style type="text/css"> 
		
		img{
			height:200px;
			width:200px;
		}
		</style>
	</head>
	<body>
		<?php
		if ($success) {
			echo '<p>'.$message.'</p>';
		}
		if ($success1) {
			echo '<p>'.$message1.'</p>';
		}
		if ($success2) {
			echo '<p>'.$message2.'</p>';

		}
		?>
		<h1>PHP Uploads</h1>
		<form action="" method="POST" enctype="multipart/form-data">
			<fieldset>
				<legend>Profile Update</legend>
				<label for="upload">Your Avatar</label>
				<input type="file" name="upload" id="upload" /><br /><br />
				<?php echo $errors ? '<p style="color:red">'.current($errors).'</p><br />' : ''; ?>
				<label for="pdf">Your File</label>
				<input type="file" name="pdf" id="pdf" /><br /><br />
				<?php echo $errors1 ? '<p style="color:red">'.current($errors1).'</p><br />' : ''; ?>
				<label for="filess">Your File</label>
				<input type="file" name="filess" id="filess" /><br /><br />
				<?php echo $errors2 ? '<p style="color:red">'.current($errors2).'</p><br />' : ''; ?>
				<button type="submit" name="submit">Submit</button>
			</fieldset>
		</form>
	</body>
</html>
