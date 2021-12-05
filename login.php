<?php $title = "Login"; ?>
<?php require_once("include/header.php");
 require_once("include/functions.php");

$failure_msg = "";
if ($_POST['email'] != '' && $_POST['password'] != '') {
    require_once("include/database.php");
    $sql = "SELECT user_id, email, first_name, last_name, school, 
    (SELECT r.name FROM roles r WHERE r.role_id = u.user_role) AS user_role, 
    per_week_goal, per_month_goal, per_year_goal, active, date_created, 
    date_last_login, date_updated FROM users u 
    WHERE u.email = :email AND u.password = PASSWORD(:password) AND active = 1 LIMIT 1";
	
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', cleanUserInput($_POST['email']));
    $stmt->bindParam(':password', cleanUserInput($_POST['password']));
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($res);
    if ($res['user_id'] != '') {
        $_SESSION['user_id'] = $res['user_id'];
        $_SESSION['email'] = $res['email'];
        $_SESSION['first_name'] = $res['first_name'];
        $_SESSION['last_name'] = $res['last_name']; 
        $_SESSION['full_name'] = $res['first_name'].' '.substr($res['last_name'], 0, 1).'.';
        $_SESSION['user_role'] = $res['user_role'];
        $_SESSION['school'] = $res['school'];
        $_SESSION['per_week_goal'] = $res['per_week_goal'];
        $_SESSION['per_month_goal'] = $res['per_month_goal'];
        $_SESSION['per_year_goal'] = $res['per_year_goal'];

        //print_r($_POST);  echo '|<br />';
        //print_r($res);   echo '|<br />';
        //print_R($_SESSION); echo '|<br />';
        header('Location: home.php');    
    } else {
       $db_fail = 1;
    }
	
} 

if ($_POST['log'] == 'Log In' && ($_POST['email'] == '' || $_POST['password'] == '' || $db_fail == 1)) {
    if ($db_fail == 1) {
        $failure_msg = "Invalid login credentials provided";
    } else {
        $failure_msg = "Missing email and/or password";
    }
    $email = $_POST['email'];
    $password = $_POST['password'];
} else { $email = ""; $password = ""; } ?>
<body class="login-body">
    <h2 class="login-h2">LOGIN</h2><br>
    <div class="login">
    <form id="login" method="post" action="login.php">
        <?php if ($failure_msg != '') { ?>
                <div style="font-weight:bold; color: red;">
                    <?php echo $failure_msg; ?>
                </div>
            <?php } ?>
        <label class="login-username"><b>E-mail Address:
        </b>
        </label>
        <input type="text" name="email" id="Username" placeholder="E-mail" value="<?php echo $email; ?>">
        <br><br>
        <label class="login-Password"><b>Password:
        </b>
        </label>
        <input type="Password" name="password" id="Pass" placeholder="Password"  value="<?php echo $password; ?>">
        <br><br>
        <input type="submit" name="log" id="log" value="Log In">
        <br><br>
        <a href="#" class="login-link">Forgot Password?</a>
    </form>
</div>
<?php require_once("include/footer.php"); ?>