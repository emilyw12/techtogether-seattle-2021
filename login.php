<?php $title = "Login"; ?>
<?php require_once("header.php"); ?>
<body class="login-body">
    <h2 class="login-h2">LOGIN</h2><br>
    <div class="login">
    <form id="login" method="get" action="login.php">
        <label class="login-username"><b>Username:
        </b>
        </label>
        <input type="text" name="Username" id="Username" placeholder="Username">
        <br><br>
        <label class="login-Password"><b>Password:
        </b>
        </label>
        <input type="Password" name="Pass" id="Pass" placeholder="Password">
        <br><br>
        <input type="button" name="log" id="log" value="Log In">
        <br><br>
        <a href="#" class="login-link">Forgot Password?</a>
    </form>
</div>
<?php require_once("footer.php"); ?>