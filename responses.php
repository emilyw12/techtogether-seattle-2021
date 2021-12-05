<?php session_start(); ?>
<?php $title = $_SESSION['first_name']."'s Digital Diary"; ?>
<?php require_once('include/header.php'); 
require_once('include/database.php');
require_once('include/functions.php');
$results = pullMinMaxIds('prompts', 'prompt_id', $conn);  
$results = generatePrompts(5, $conn);
print_r($results);
echo '<hr />';
$res = pullPrompt(223, $conn);
echo "<hr />";
/*
223. Do You Feel Your Stress Comes From A Lack Of Compassion Or Feeling Of Self-worth?
88. If You Could Write A Letter To Any One Fear&comma; Which One Would It Be?
105. Focus More On How You Feel In Your Body&comma; Not In Your Mind&comma; Then Write About It.
216. How Do You Help Your Sleep Habits – In A Healthy Way?
204. Have You Experienced Physical Changes Due To Your Anxiety?
*/
?>  
<h1>Responses</h1>
<?php require_once('include/footer.php'); ?>