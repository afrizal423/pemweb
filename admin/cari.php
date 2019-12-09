<?php
	require_once("../session.php");
    require_once("../class.user.php");
    require_once("class.admin.php");

    $kt = new Admin();
     $query2 =  $kt->runQuery("select * from detail_peminjaman WHERE id_detail=:user_id");
     $query2->execute(array(":user_id"=>$_GET['id'] ));
     $data2 = $query2->rowCount(); //ambil data
     if($data2 > 0 && $data2 < 2) true;
    else echo '<script language="javascript">alert("Akses Gagal!"); document.location="listpeminjaman";</script>';
?>
<?php if(isset($_GET['id']) && isset($_GET['judulbuku']) ) {
include_once('view/cari-view.php');
//echo $_GET['judulbuku'];
include_once('view/footer.php');
     }?>
<?php if(isset($_GET['id']) && isset($_GET['pengarang']) ) {
include_once('view/cari-view.php');
//echo $_GET['pengarang'];
include_once('view/footer.php');
     }?>
<?php if(isset($_GET['id']) && isset($_GET['penerbit']) ) {
include_once('view/cari-view.php');
//echo $_GET['penerbit'];
include_once('view/footer.php');
     }?>
<?php if(isset($_GET['id']) && isset($_GET['isbn']) ) {
include_once('view/cari-view.php');
//echo $_GET['isbn'];
include_once('view/footer.php');
     }?>
     <?php if(isset($_GET['id']) && isset($_GET['buku']) && isset($_GET['simpan']) ) {
         date_default_timezone_set("Asia/Jakarta");
         //echo $_GET['buku'];
         $kt = new Admin();
         $kt->saveBuku($_GET['id'],$_GET['buku'],date('Y-m-d'));
         echo '<script language="javascript">alert("Sukses!"); document.location="pinjam?iddetil='.$_GET['id'].'";</script>';

//include_once('view/cari-view.php');
//echo $_GET['pengarang'];
//include_once('view/footer.php');
     }?>