<?php
	require_once("../session.php");
    require_once("../class.user.php");
    require_once("class.admin.php");

	$auth_user = new USER();
	$user_id = $_SESSION['user_session'];
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

    $kt = new Admin();
    $anu = $kt->runQuery("select * from mahasiswa inner join anggota using(id_mhs)");
    $hs = $anu->execute();
    header('Content-type: application/json');
    $row = $anu->fetchObject();
    echo json_encode($row);
    // $kt = new Admin();
    // $id = htmlentities($_GET['npm']);
    // $anu = $kt->runQuery("select * from mahasiswa where npm_mhs=:npm");
    // $hs = $anu->execute(array(":npm"=>$id));
    // header('Content-type: application/json');
    // $row = $anu->fetchObject();
    // echo $row->id_mhs;
?>