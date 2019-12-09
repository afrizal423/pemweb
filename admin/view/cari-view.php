

<?php if(isset($_GET['id']) && isset($_GET['judulbuku']) ) {
//include_once('view/cari-view.php');
//echo $_GET['judul']; 
$judul = $_GET['judulbuku'];?> 

     
     <?php } ?> 
<?php if(isset($_GET['id']) && isset($_GET['pengarang']) ) {
//include_once('view/cari-view.php');
echo $_GET['pengarang'];
     }?>
<?php if(isset($_GET['id']) && isset($_GET['penerbit']) ) {
//include_once('view/cari-view.php');
echo $_GET['penerbit'];
     }?>
<?php if(isset($_GET['id']) && isset($_GET['isbn']) ) {
//include_once('view/cari-view.php');
echo $_GET['isbn'];
     }?>

<?php
        $kt = new Admin();
    $query =  $kt->runQuery("select * from detail_peminjaman
    inner join anggota using(id_anggota)
    inner join mahasiswa using(id_mhs)
    where id_detail=:id_detail");
    $query->execute(array(":id_detail"=>$_GET['id'] ));
    $data3 = $query->fetchObject(); //ambil data

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
                            <h5 class="breadcrumbs-title">Data Buku yang ingin dipinjam <?php echo $data3->nama_mhs; ?> (<?php echo $data3->id_detail; ?>)</h5>
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="../admin">Dashboard</a>
                                </li>
                                <li class="active">Buku yang ingin dipinjam <?php echo $data3->nama_mhs; ?></li>
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
                                    <!-- <div class="input-field col s12">
                                        <i class="material-icons prefix">search</i>
                                        <input type="text" name="Search" placeholder="Search"/>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="container">
                                        <div class="col s12">
                                             <!-- <a class="waves-effect waves-light  btn">
                                                <i class="material-icons left">add</i>
                                                Add Data</a>
                                           Modal Trigger -->
                                            <a class="waves-effect waves-light btn modal-trigger" onclick="window.history.back()"> <i class="material-icons left">arrow_back</i>Kembali</a>
                                           
                                           

                                            <!-- DETAIL BUKU -->


                                            <?php 
                                             $kt = new Admin();
$a = $kt->getBooks();
while($dt = $a->fetch(PDO::FETCH_OBJ)){ ?>
<!-- Modal Structure -->
<div id="<?php echo $dt->id_buku ?>" class="modal">
                                                <div class="modal-content">
                                                    <h4>detail Buku</h4>
                                                        <table>
                                                            <tr>
                                                                <td>Judul Buku</td>
                                                                <td><?php echo $dt->judulbuku ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pengarang Buku</td>
                                                                <td><?php echo $dt->pengarang ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Penerbit Buku</td>
                                                                <td><?php echo $dt->penerbit ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>ISBN</td>
                                                                <td><?php echo $dt->isbn ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Jumlah Buku</td>
                                                                <td><?php echo $dt->jumlah_buku_tersedia ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kategori Buku</td>
                                                                <td><?php 
                                                                    $kt = new Admin();
                                                                    $query =  $kt->runQuery("select * from kategori where id_kategori=:kat");
                                                                    $query->execute(array(":kat"=>$dt->id_kategori));
                                                                    $data = $query->fetchObject();
                                                                    echo $data->namakategori;
                                                                ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Rak Buku</td>
                                                                <td><?php 
                                                                    $kt = new Admin();
                                                                    $query =  $kt->runQuery("select * from rak_buku where kode_rak=:kat");
                                                                    $query->execute(array(":kat"=>$dt->kode_rak));
                                                                    $data = $query->fetchObject();
                                                                    echo $data->namarak;
                                                                ?></td>
                                                            </tr>
                                                        </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                                                </div>
                                                                        </div>

<?php } ?>



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
            }
            else if(isset($_GET['suksesupdate']))
			{
				 ?>
                            <div class="alert alert-info">
                                <i class="glyphicon glyphicon-log-in"></i>
                                &nbsp; Successfully Update
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
                    <h4 class="header">Pencarian Buku dengan ingin dicari oleh <?php echo $data3->nama_mhs; ?> (<?php echo $data3->id_detail; ?>)</h4>
                    <table class="table">
                        <tr>
                            <td>Judul</td>
                            <td>Pengarang</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php if(isset($_GET['id']) && isset($_GET['judulbuku']) ) {
                             $kt = new Admin();
                             $query =  $kt->runQuery("select * from buku
    where judulbuku like '%".$_GET['judulbuku']."%' ");
    $query->execute();
  //  $query->debugDumpParams();
    //$data3 = $query->fetchObject(); //ambil data

                             $show = $kt->getBooks();
                             while($data = $query->fetchObject()){
                             echo "
                             <tr>
                             <td>$data->judulbuku</td>
                             <td>$data->pengarang</td>
                             <td> <a class='waves-effect waves-light btn modal-trigger' href='#$data->id_buku'>Detail Buku</a></td>
                             <td><!-- <a class='blue waves-effect waves-light btn modal-trigger' href='#update$data->id_buku'>Update Buku</a>-->
                             <a class='blue btn btn-danger' href='cari?id=$data3->id_detail&buku=$data->id_buku&simpan'>Pilih</a></td>
                             
                             <!--<td><a class='btn btn-danger' href='buku?delete=$data->id_buku'>Delete</a></td>-->
                             </tr>
                             ";
                             };
     }?>
<?php if(isset($_GET['id']) && isset($_GET['pengarang']) ) {
$kt = new Admin();
$query =  $kt->runQuery("select * from buku
where pengarang like '%".$_GET['pengarang']."%' ");
$query->execute();
//$query->debugDumpParams();
//$data3 = $query->fetchObject(); //ambil data

$show = $kt->getBooks();
while($data = $query->fetchObject()){
echo "
<tr>
<td>$data->judulbuku</td>
<td>$data->pengarang</td>
<td> <a class='waves-effect waves-light btn modal-trigger' href='#$data->id_buku'>Detail Buku</a></td>
<td><!-- <a class='blue waves-effect waves-light btn modal-trigger' href='#update$data->id_buku'>Update Buku</a>-->
<a class='blue btn btn-danger' href='cari?id=$data3->id_detail&buku=$data->id_buku&simpan'>Pilih</a></td>

<!--<td><a class='btn btn-danger' href='buku?delete=$data->id_buku'>Delete</a></td>-->
</tr>
";
};
     }?>
<?php if(isset($_GET['id']) && isset($_GET['penerbit']) ) {
$kt = new Admin();
$query =  $kt->runQuery("select * from buku
where penerbit like '%".$_GET['penerbit']."%' ");
$query->execute();
//$query->debugDumpParams();
//$data3 = $query->fetchObject(); //ambil data

$show = $kt->getBooks();
while($data = $query->fetchObject()){
echo "
<tr>
<td>$data->judulbuku</td>
<td>$data->pengarang</td>
<td> <a class='waves-effect waves-light btn modal-trigger' href='#$data->id_buku'>Detail Buku</a></td>
<td><!-- <a class='blue waves-effect waves-light btn modal-trigger' href='#update$data->id_buku'>Update Buku</a>-->
<a class='blue btn btn-danger' href='cari?id=$data3->id_detail&buku=$data->id_buku&simpan'>Pilih</a></td>

<!--<td><a class='btn btn-danger' href='buku?delete=$data->id_buku'>Delete</a></td>-->
</tr>
";
};
     }?>
<?php if(isset($_GET['id']) && isset($_GET['isbn']) ) {
$kt = new Admin();
$query =  $kt->runQuery("select * from buku
where isbn like '%".$_GET['isbn']."%' ");
$query->execute();
//$query->debugDumpParams();
//$data3 = $query->fetchObject(); //ambil data

$show = $kt->getBooks();
while($data = $query->fetchObject()){
echo "
<tr>
<td>$data->judulbuku</td>
<td>$data->pengarang</td>
<td> <a class='waves-effect waves-light btn modal-trigger' href='#$data->id_buku'>Detail Buku</a></td>
<td><!-- <a class='blue waves-effect waves-light btn modal-trigger' href='#update$data->id_buku'>Update Buku</a>-->
<a class='blue btn btn-danger' href='cari?id=$data3->id_detail&buku=$data->id_buku&simpan'>Pilih</a></td>

<!--<td><a class='btn btn-danger' href='buku?delete=$data->id_buku'>Delete</a></td>-->
</tr>
";
};
     }?>
                        <?php
//                     $kt = new Admin();
// $show = $kt->getBooks();
// while($data = $show->fetch(PDO::FETCH_OBJ)){
// echo "
// <tr>
// <td>$data->judulbuku</td>
// <td>$data->pengarang</td>
// <td> <a class='waves-effect waves-light btn modal-trigger' href='#$data->id_buku'>Detail Buku</a></td>
// <td><!-- <a class='blue waves-effect waves-light btn modal-trigger' href='#update$data->id_buku'>Update Buku</a>-->
// <a class='red btn btn-danger' href='buku?delete=$data->id_buku'>Delete</a></td>

// <!--<td><a class='btn btn-danger' href='buku?delete=$data->id_buku'>Delete</a></td>-->
// </tr>
// ";
// };
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