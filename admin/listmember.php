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
        $nama_mhs = strip_tags($_POST['nama_mhs']);
        $npm_mhs = strip_tags($_POST['npm_mhs']);
        $jurusan = strip_tags($_POST['jurusan']);
        $fakultas = strip_tags($_POST['fakultas']);
        $alamat_anggota = strip_tags($_POST['alamat_anggota']);
        $notlp_anggota = strip_tags($_POST['notlp_anggota']);
	
	// if($judulbuku=="")	{
	// 	$error[] = "Kosong !";	
    // } 
    $kt = new Admin();
    if($kt->tmbhMhs($nama_mhs,$npm_mhs,$jurusan,$fakultas)){
        $query =  $kt->runQuery("select * from mahasiswa where npm_mhs=:npm");
        $query->execute(array(":npm"=>$npm_mhs));
        $data = $query->fetchObject();
        $kt->tmbhAnggota($data->id_mhs,$alamat_anggota,$notlp_anggota);	
        $kt->redirect('listmember?sukses');
        //echo json_encode($data->id_mhs);
    }
       /* $Lib = new Library();
        $add = $Lib->addBook($kode, $judul, $pengarang, $penerbit);
        if($add == "Success"){
        header('Location: List.php');
        }
        }*/} else if(isset($_GET['delete'])){
            $kt = new Admin();
if($kt->hpsRak($_GET['delete'])){	
    $kt->redirect('rakbuku?hapus');
}
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
                <!-- Search for small screen -->
                <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
                    <input
                        type="text"
                        name="Search"
                        class="header-search-input z-depth-2"
                        placeholder="Search">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title">List Member Perpustakaan</h5>
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="../admin">Dashboard</a>
                                </li>
                                <li class="active">List Member</li>
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
                                <div class="col s12">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">search</i>
                                        <input type="text" name="Search" placeholder="Search"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="container">
                                        <div class="col s12">
                                           <!-- <a class="waves-effect waves-light  btn">
                                                <i class="material-icons left">add</i>
                                                Add Data</a>
                                             Modal Trigger -->
                                            <a class="waves-effect waves-light btn modal-trigger" href="#modal1"><i class="material-icons left">add</i>Tambah Member</a>

                                            <!-- Modal Structure -->
                                            <div id="modal1" class="modal">
                                                <div class="modal-content">
                                                    <h4>Tambah Buku</h4>
                                                    <form method="post" action="listmember">
                                                        <table>
                                                            <tr>
                                                                <td>Nama</td>
                                                                <td><input type="text" name="nama_mhs"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>NPM</td>
                                                                <td><input type="text" name="npm_mhs"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Program Studi</td>
                                                                <td><input type="text" name="jurusan"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Fakultas</td>
                                                                <td><input type="text" name="fakultas"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Alamat</td>
                                                                <td><input type="text" name="alamat_anggota"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>No Telp</td>
                                                                <td><input type="text" name="notlp_anggota"></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <input
                                                                        type="submit"
                                                                        value="SIMPAN"
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
                    <h4 class="header">Data Member</h4>
                    <table class="table">
                        <tr>
                        <td>No</td>                            
                            <td>NPM</td>
                            <td>Nama</td>
                            <td>jurusan</td>
                            <td>Fakultas</td> 
                            <td>Alamat</td>
                            <td>Telp</td>
                            <td></td>
                        </tr>
                        <?php
                    $kt = new Admin();
$show = $kt->showMember();
$no = 0;
while($data = $show->fetch(PDO::FETCH_OBJ)){
    $no++;
echo "
<tr>
<td>$no</td>
<td>$data->npm_mhs</td>
<td>$data->nama_mhs</td>
<td>$data->jurusan</td>
<td>$data->fakultas</td>
<td>$data->alamat_anggota</td>
<td>$data->notlp_anggota</td>

<!--<td><a class='btn btn-danger' href='rakbuku?delete=$data->id_mhs'>Delete</a></td>-->
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