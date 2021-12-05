<?php session_start(); 
require_once('include/database.php');
require_once('include/functions.php');

// Default response_id
$response_id = 0;

// Locate prompt_id to be responded to
$prompt_id = isset($_POST['prompt_id']) ? $_POST['prompt_id'] : 0;
if ($prompt_id == 0 ) {
	$prompt_id = isset($_GET['pid']) ? $_GET['pid'] : 0;
}

// Default prompt_id to zero if input is invalid
if(!is_numeric($prompt_id)) {
	$prompt_id = 0;
}



 

if ($_POST['response'] != '' && $_SESSION['user_id'] != '') {
	if (cleanUserInput($_POST['sharePublicly']) == "Share Publicly" ) {
		$response_type = "Public";
	} else {
		$response_type = "Private"; 
	}
	
	$response = cleanUserInput($_POST['response']);
 
	if ($response == '') {
		$failure_msg = "Invalid input entered";
		echo "here";
	} else {  
		$insert_sql = 'INSERT INTO user_responses (user_id, prompt_id, response_type, response_text, date_created) 
		VALUES(:user_id, :prompt_id, :response_type, :response_text, NOW());'; 
		$stmt = $conn->prepare($insert_sql);

		$stmt->execute([
			':user_id' => $_SESSION['user_id'],
			':prompt_id' => $prompt_id,
			':response_type' => $response_type,
			':response_text' => $response
		]);

		$response_id = $conn->lastInsertId();
	}
}


?>
<?php $title = $_SESSION['first_name']."'s Digital Diary"; ?>
<?php require_once('include/header.php'); ?>  
<div class="feed_body">
	<?php if ($response_id > 0 && $prompt_id > 0) { 
		$res = pullPrompt($prompt_id, $conn); ?>
		<h1 class= "feed_title">You did it! </h1>
		<p>Great job! Your response has been successfully submitted
			<?php if ($response_type == 'Public') {
				echo " and will be shared publicly with other members. ";
			} else {
				echo " and will only be accessible privately by you. ";
			} 
			echo "<a href='?' class='feed_refresh'>Respond to another prompt.</a> ";
			$responses = getResponses("Recent Responses to Prompt", $conn, $prompt_id);
			
			$result_count = count($responses); 

			// Check number of prompts
			if ($result_count == 1 ) {
				echo " Or read the shared response from another member below.";
			} elseif ($result_count > 1 ) {
				echo " Or read some shared responses by other members below.";
			} else {
				echo " There are currently no public responses to your prompt to view.";
			}
			?>
			</p>

			<div class="chosen-prompt">
					<p><?php echo cleanPrompt($res['prompt']); ?></p>
			</div> 

			<?php 
			
			foreach ($responses AS $response) { ?>
				<div class="chosen-prompt__anonymous-response">
					<p class="chosen-prompt__anonymous-response-user"><?php generateUsername($conn); ?></p>
					<p><?php echo $response['response_text']; ?> </p>
				</div>
			<?php }
			?>
		<?php 
	} else if ($prompt_id == 0 ) { ?>
		<h1 class= "feed_title">Welcome, <?php echo $_SESSION['first_name']; ?>! </h1>
		<p class= "feed_p"> Choose a prompt to focus on today (<a href="?" class="feed_refresh">Refresh</a>): </p>
		<?php 
		$prompt_counter = 1;
		$results = generatePrompts(6, $conn);
		//print_r($results);
		foreach ($results AS $prompt_id => $prompt) { 
			
			if ($prompt_counter % 2 == 0) {
				$class="even";
			} else {
				$class = "odd"; 
			}
			$prompt_counter++; ?>
			<div class= "feed_prompt feed_prompt_<?php echo $class; ?>">
				<p><?php echo $prompt; ?></p>
				<a href="?pid=<?php echo $prompt_id; ?>"></a>
			</div>
		<?php } 
	} else { 
		$res = pullPrompt($prompt_id, $conn); ?>
		<h1 class= "feed_title">Respond</h1>
		<div class="chosen-prompt-page">
			<p>You may choose to response to a different prompt, however, please note that 
				your prompt options will be different from the ones originally provided. 
				<a href="?" class="feed_refresh">Change prompt.</a></p>
				

			<div class="chosen-prompt">
				<p><?php echo cleanPrompt($res['prompt']); ?></p>
			</div>

			<form class="chosen-prompt__response-form" method="post">
				<label for="response">Write your response here</label>
				<input type="textarea" name="response" id="response">
				<input type="hidden" name="prompt_id" value="<?php echo $prompt_id; ?>" />
				<div>
					<input type="submit" name="privatePost" id="private_post" class="post_button" value="Post Privately">
					<input type="submit" name="sharePublicly" id="public_post" class="post_button" value="Share Publicly">
				</div>
			</form>
		</div>

	here 
	<?php } ?>
</div>
<?php require_once('include/footer.php'); ?>