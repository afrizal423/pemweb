<?php
session_start();
require_once("class.user.php");
$login = new USER();

// jika terdapat session, maka langsung saja diarahkan ke home
if($login->is_loggedin()!="")
{
	$login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect('/pemweb/admin');
	}
	else
	{
		$error = "Wrong Details !";
	}	
}
?>
<html>
<head>
<title>Login Page</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
</head>
<body>

<div class="signin-form">
	<div class="container">
       <form class="form-signin" method="post" id="login-form">
        <h2 class="form-signin-heading">Please LogIn</h2><hr />
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="txt_uname_email" placeholder="Username or NIP" required />
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="txt_password" placeholder="Your Password" />
        </div>
        
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-default">
                <i class="glyphicon glyphicon-log-in"></i>&nbsp;SIGN IN
            </button>
        </div>  
      	<br>
            <label>Belum punya akun? <a href="sign-up.php">Klik Disini</a></label>
      </form>
    </div>
    
</div>
</body>
</html>