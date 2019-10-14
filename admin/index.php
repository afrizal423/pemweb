<?php
	require_once("../session.php");
	require_once("../class.user.php");
	$auth_user = new USER();
	$user_id = $_SESSION['user_session'];
	$stmt = $auth_user->runQuery("SELECT * FROM users inner join pegawai using (nama_pegawai) WHERE users.user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php 
include_once('view/header.php');
?>

<div class="clearfix"></div>
<div class="container-fluid" style="margin-top:80px;">
    <div class="container">
    	<label class="h5">welcome : <?php print($userRow['nama_pegawai']); ?></label>
        <hr>
        <h1>
        <a href="home.php"><span class="glyphicon glyphicon-home"></span> home</a> &nbsp; 
        <a href="profile.php"><span class="glyphicon glyphicon-user"></span> profile</a></h1>
       	<hr>
        <p class="h4">Home Page <?php //echo json_encode($userRow);
         ?></p> 
    </div>
</div>

<?php 
include_once('view/footer.php');
?>
