<?php session_start(); ?>
<?php $title = $_SESSION['first_name']."'s Digital Diary"; ?>
<?php require_once('include/header.php'); 
require_once('include/database.php');
require_once('include/functions.php');

echo $_SERVER['REQUEST_URI']; echo '<br />';
for ($i = 0; $i < 100; $i++) {
    generateUsername($conn) ; echo '<br />';
}
 
?>   
<?php require_once('include/footer.php'); ?>