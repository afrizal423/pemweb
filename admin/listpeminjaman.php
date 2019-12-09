<?php
	require_once("../session.php");
    require_once("../class.user.php");
    require_once("class.admin.php");

	$auth_user = new USER();
	$user_id = $_SESSION['user_session'];
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    
    if(isset($_POST['kirim'])){
        $tglpinjam = strip_tags($_POST['tglpinjam']);
        $npm_mhs = strip_tags($_POST['npm']);
	
	// if($judulbuku=="")	{
	// 	$error[] = "Kosong !";	
    // } 
    $kt = new Admin();
    $query2 =  $kt->runQuery("select * from users
    inner join pegawai using(id_pegawai) WHERE user_id=:user_id");
    $query2->execute(array(":user_id"=>$_SESSION['user_session'] ));
    $data2 = $query2->fetchObject(); //ambil data

    $kt = new Admin();
    $query =  $kt->runQuery("select * from anggota
    inner join mahasiswa using(id_mhs)
    where npm_mhs=:npm");
    $query->execute(array(":npm"=>$npm_mhs));
    $data = $query->fetchObject(); //ambil data
    $random = $kt->RandomPeminjaman(10);
    
    

    if($kt->insertPinjam($random,$data->id_anggota,$data2->id_pegawai,$tglpinjam)){
        echo "<script>location.href='pinjam?iddetil=".$random." ';</script>";
        //echo json_encode($data->id_mhs);
    }
       /* $Lib = new Library();
        $add = $Lib->addBook($kode, $judul, $pengarang, $penerbit);
        if($add == "Success"){
        header('Location: List.php');
        }
        }*/} else if(isset($_GET['delete'])){
            $kt = new Admin();
// if($kt->hpsRak($_GET['delete'])){	
     $kt->redirect('rakbuku?hapus');
// }
}
?>

<?php 
include_once('view/header.php');
?>
<!--
//////////////////////////////////////////////////////////////////////////// -->
<!-- START MAIN -->
<div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">
        <?php 
include_once('view/menu.php');
?>

        <!--
        //////////////////////////////////////////////////////////////////////////// -->
        <!-- START CONTENT -->
        <section id="content">
            <div id="breadcrumbs-wrapper">
                <!-- Search for small screen 
                <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
                    <input
                        type="text"
                        name="Search"
                        class="header-search-input z-depth-2"
                        placeholder="Search">
                </div>-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title">List Peminjaman Perpustakaan</h5>
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="../admin">Dashboard</a>
                                </li>
                                <li class="active">List Peminjaman</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!--breadcrumbs end-->
            <!--start container-->
            <div class="container">
                <!--card stats start-->
                <div id="card-stats">
                    <!--start container-->
                    <!--start container-->
                    <div class="container">
                        <div class="section">
                            <div class="row">
                                <!-- <div class="col s12">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">search</i>
                                        <input type="text" name="Search" placeholder="Search"/>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="container">
                                        <div class="col s12">
                                           <!-- <a class="waves-effect waves-light  btn">
                                                <i class="material-icons left">add</i>
                                                Add Data</a>
                                             Modal Trigger -->
                                            <a class="waves-effect waves-light btn modal-trigger" href="#modal1"><i class="material-icons left">add</i>Tambah Peminjaman</a>

                                            <!-- Modal Structure -->
                                            <div id="modal1" class="modal">
                                                <div class="modal-content">
                                                    <h4>Tambah Peminjaman</h4>
                                                    <form method="post" action="listpeminjaman">
                                                        <table>
                                                            <tr>
                                                                <td>Tanggal Pinjam</td>
                                                                <td><input type="date" name="tglpinjam" value="<?php date_default_timezone_set("Asia/Jakarta"); echo date('Y-m-d');?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>NPM mahasiswa</td>
                                                                <td><input type="text" name="npm"></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <input
                                                                        type="submit"
                                                                        value="Next"
                                                                        name="kirim"
                                                                        class="waves-effect waves-light  btn"></td>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                            <div class="alert alert-danger">
                                <i class="glyphicon glyphicon-warning-sign"></i>
                                &nbsp;
                                <?php echo $error; ?>
                            </div>
                        <?php
				}
			}else if(isset($_GET['sukses']))
			{
				 ?>
                            <div class="alert alert-info">
                                <i class="glyphicon glyphicon-log-in"></i>
                                &nbsp; Successfully add
                            </div>
                        <?php
			}else if(isset($_GET['hapus']))
			{
				 ?>
                            <div class="alert alert-info">
                                <i class="glyphicon glyphicon-log-in"></i>
                                &nbsp; Successfully Hapus
                            </div>
                            <?php
			} ?>

                        </div>
                    </div>
                </div>
                <div class="container">
                    <h4 class="header">Data Peminjaman</h4>
                    <table class="table">
                        <tr>
                        <td>No</td>                            
                            <td>NPM</td>
                            <td>Nama</td>
                            <td>Tanggal Pinjam</td>
                            <td>Tanggal Kembali</td> 
                            <td>Denda</td>
                            <td>Keterangan</td>
                            <td></td>
                        </tr>
                        <?php
                    $kt = new Admin();
    $query =  $kt->runQuery("select npm_mhs, nama_mhs from detail_peminjaman
    inner join anggota using(id_anggota)
    inner join mahasiswa using(id_mhs)");
    $query->execute();
    $data2 = $query->fetch(PDO::FETCH_OBJ);

$show = $kt->showDetail();
$no = 0;
while($data = $show->fetch(PDO::FETCH_OBJ)){
    $no++;
echo "
<tr>
<td>$no</td>
<td>$data->npm_mhs</td>
<td>$data->nama_mhs</td>
<td>$data->tglpinjam</td>
<td>$data->tglkembali</td>
<td>$data->denda</td>
<td>$data->ket_buku</td>

<td><a class='btn blue' href='pinjam?iddetil=$data->id_detail'>Detail</a><a class='red btn btn-danger' href='listpeminjaman?delete=$data->id_detail'>Delete</a></td>
</tr>";
};
?>
                    </table>
                </div>

                <!--
                //////////////////////////////////////////////////////////////////////////// -->
            </div>
            <!--end container-->
        </section>
        <!-- END CONTENT -->

    </div>
    <!-- END WRAPPER -->
</div>
<!-- END MAIN -->
<!--
//////////////////////////////////////////////////////////////////////////// -->

<?php 
include_once('view/footer.php');
?>