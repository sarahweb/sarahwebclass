<?php
// Create a cookie called MyCookie and set it's value
if(!isset($_COOKIE['MyCookie']))
{
  echo "Welcome newcomer!";
  $cookie_value = "Colin";
  setcookie("MyCookie", $cookie_value);

}
// Delete a cookie
if(isset($_GET['forget']))
{
setcookie('MyCookie', "", time()-3600); // Set expiration time to 1hr ago
}
// Output the value of MyCookie
if(isset($_COOKIE['MyCookie']))
{
  //$value = $_COOKIE['MyCookie']; // Note that the first time you run this - you will get an undefined error because the cookie is not actually visible until the next time the page loads
  //echo $value;
  echo "Good to see you again old friend!";
}


/*

To remove a cookie we have to set its expiration time to a time in the past

*/

?>
<?php if(isset($_COOKIE['MyCookie'])): ?>
<a href="firstcontact.php?forget" title="Forget Me">Forget Me</a>
<?php endif; ?>

<?php

?>
