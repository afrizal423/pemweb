<?php
	require_once("../session.php");
    require_once("../class.user.php");
    require_once("class.admin.php");

	$auth_user = new USER();
	$user_id = $_SESSION['user_session'];
	$stmt = $auth_user->runQuery("select * from buku
    where judulbuku like '%:judulbuku%'");
	$stmt->execute(array(":judulbuku"=> "malin"));
    $userRow=$stmt->fetchObject();
    echo json_encode($userRow);
    // $kt = new Admin();
    // $anu = $kt->runQuery("select * from mahasiswa inner join anggota using(id_mhs)");
    // $hs = $anu->execute();
    // header('Content-type: application/json');
    // $row = $anu->fetchObject();
    // echo json_encode($row);
    $kt = new Admin();
    //$id = htmlentities($_GET['npm']);
    $id2 = htmlentities(isset($_GET['sukses']));
    $id = htmlentities($_GET['id']);
    // $anu = $kt->runQuery("select * from mahasiswa where npm_mhs=:npm");
    // $hs = $anu->execute(array(":npm"=>$id));
    //header('Content-type: application/json');
    //$row = $anu->fetchObject();
    if($id2){
        echo "true";
        echo $id;
    } else{
        echo "false";
    }
    //echo json_encode($row);
?>