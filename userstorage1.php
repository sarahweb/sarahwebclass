<?php
ini_set("auto_detect_line_endings", true);
// Create handle to users file
$users = array();
$filename = 'users.txt';


/*echo '<pre>';
print_r($users);
echo '</pre>';
exit;
*/

// Check if form was posted
if (isset($_POST['username'])) {
 	//echo 'posted';

	// Validate username 
	if (!strlen($_POST['username'])) { // User did not enter a name
		$errors['username'] = 'Please enter a username';
	} elseif (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) { // Username not alphanum
		$errors['username'] = 'Username should only contain letters and numbers';
	} elseif (in_array($_POST['username'], $users)) { // Username in file already
		$errors['username'] = 'This username already exists';
	}
	
	$current = file_get_contents($filename);
	$lines = explode("\n", $current);

$t=false;
		foreach ($lines as $key => $user) {

			if($user == $_POST['username']) 		// Validate username
			{
				$t=true;
				break;
			}
		}

if($t)
{
	echo "Username is in use";
}
else {

	$current = file_get_contents($filename);
	// Append a new person to the file
	$current .= $_POST['username']."\n" ;
	// Write the contents back to the file
	file_put_contents($filename, $current);
}
}





// Close Handle


?>

<html>
	<head>
		<title>PHP Username Form</title>
	</head>
	<body>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" />
			<button type="submit">Submit</button>
		</form>
		<h1>Current Users</h1>
		<ul>
			<?php
			$handle = fopen($filename,'a+');
			if ($handle) {
				while (($line = fgets($handle)) !== false) {
					$users[] = $line;
				}
			}
			fclose($handle);
			
			if ($users) {
				foreach ($users as $key => $value)
					echo '<li>' .htmlspecialchars($value, ENT_QUOTES).'</li>';
				} else {
					echo '<p> There are not any users yet.</p>';
				}
			?>
		</ul>
	</body>
</html>
