<?php session_start(); 
if ($_GET['logout'] == 1) {
	// clear session variables
	$_SESSION['user_id'] = '';
	$_SESSION['email'] = '';
	$_SESSION['first_name'] = '';
	$_SESSION['last_name'] = '';
	$_SESSION['full_name'] = '';
	$_SESSION['user_role'] = '';
	$_SESSION['school'] = '';
	$_SESSION['per_week_goal'] = '';
	$_SESSION['per_month_goal'] = '';
	$_SESSION['per_year_goal'] = '';

	// remove all session variables
	session_unset();
	
	// destroy the session
	session_destroy();
} elseif ($_SESSION['user_id'] != '') {
	header('Location: home.php');
}
?>
<?php $title = "Digital Diary"; ?>
<?php require_once('include/header.php'); ?>
	<div class="home__hero">
		<div class="home__hero-text">
			<h1 class="home__heading">Tech Together University - Digital Journal</h1>
			<p class="home__subheading">The university-wide online journal for documenting your mental wellness journey</p>
		</div>
	</div>
	<section class="home__about">
		<div class="home__about-div">
			<div class="home__about-div-text">
				<h2>Daily prompts</h2>
				<p>Take time out of your busy day to respond to a daily prompt from your feed. Our prompt generator will ask you to think and write about various aspects of your life. </p>
			</div>
			<div class="home__about-div-img about-img-prompt">
			</div>
		</div>

		<div class="home__about-div">
			<div class="home__about-div-text">
				<h2>Interact with other students</h2>
				<p>You can read what other students on your campus have to say about their mental wellness. Be inspired and motivated by others students, and share your personal stories in an anonymized, safe, and private space.</p>
			</div>
			<div class="home__about-div-img about-img-students">
			</div>
		</div>

		<div class="home__about-div">
			<div class="home__about-div-text">
				<h2>Reflect on your journey</h2>
				<p>View your past journal responses and keep track of how your mental wellness journey is evolving. Look back on previous submissions and be proud of your growth!</p>
			</div>
			<div class="home__about-div-img about-img-journey">
			</div>
		</div>

		
	</section>
	<button type="button" class="join-button">
			View Your Digital Diary
	</button>
<?php require_once('include/footer.php'); ?>