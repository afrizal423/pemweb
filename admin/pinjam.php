<?php
	require_once("../session.php");
    require_once("../class.user.php");
    require_once("class.admin.php");
	$auth_user = new USER();
	$user_id = $_SESSION['user_session'];
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    // $iddetil = htmlentities($_GET['iddetil']);

	// if($judulbuku=="")	{
	// 	$error[] = "Kosong !";	
    // } 
   
   
    //echo $data2;
    
    
   
?>
<?php //if(isset($_GET['iddetil'])) { ?>
<!--//include_once('view/pinjam-view.php');-->
<?php
        if(isset($_POST['kirim'])){
            $id = strip_tags($_POST['id']);
            $cari = strip_tags($_POST['cari']);
            $keyword = strip_tags($_POST['keyword']);
            //echo "<script>location.href='pinjam?cari&pengarang=afrizal';</script>";
            if ($cari == "judulbuku") echo "<script>location.href='cari?id=".$id."&judulbuku=".$keyword."';</script>";
            if ($cari == "pengarang") echo "<script>location.href='cari?id=".$id."&pengarang=".$keyword."';</script>";
            if ($cari == "penerbit") echo "<script>location.href='cari?id=".$id."&penerbit=".$keyword."';</script>";
            if ($cari == "isbn") echo "<script>location.href='cari?id=".$id."&isbn=".$keyword."';</script>";
    
        
        if($keyword=="")	{
            $error[] = "Kosong !";	
        } 
        $kt = new Admin();
    
        // if($kt->tmbhBuku($id_kategori,$kode_rak,$judulbuku,$pengarang,$penerbit,$isbn,$jumlah_buku_tersedia)){	
        //     $kt->redirect('buku?sukses');
        // }
           /* $Lib = new Library();
            $add = $Lib->addBook($kode, $judul, $pengarang, $penerbit);
            if($add == "Success"){
            header('Location: List.php');
            }
            }*/} else if(isset($_GET['delete'])){
                $iddetil = htmlentities($_GET['iddetil']);

                $kt = new Admin();
                
    if($kt->hilangkanBuku($_GET['delete'],$iddetil)){
        // $query =  $kt->runQuery("select * from buku
        // where id_buku=:id_buku");
        // $query->execute(array(":id_buku"=>$_GET['delete'] ));
        // $data3 = $query->fetchObject(); //ambil data	
        // $tambah = $data3->jumlah_buku_tersedia+1;
        // $query =  $kt->runQuery("update buku set jumlah_buku_tersedia=".$tambah." where id_buku=".$_GET['delete']."");
        // $query->execute();

        $kt->redirect('pinjam?iddetil='.$iddetil.'&hapus');
    }
    }
    $iddetil = htmlentities($_GET['iddetil']);
     $kt = new Admin();
     $query2 =  $kt->runQuery("select * from detail_peminjaman WHERE id_detail=:user_id");
     $query2->execute(array(":user_id"=>$iddetil ));
     $data2 = $query2->rowCount(); //ambil data
     if($data2 > 0 && $data2 < 2) true;
    else echo '<script language="javascript">alert("Akses Gagal!"); document.location="listpeminjaman";</script>';
    $kt = new Admin();
    $query =  $kt->runQuery("select * from detail_peminjaman
    inner join anggota using(id_anggota)
    inner join mahasiswa using(id_mhs)
    where id_detail=:id_detail");
    $query->execute(array(":id_detail"=>$iddetil ));
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
                <!-- <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
                    <input
                        type="text"
                        name="Search"
                        id="Search"
                        class="header-search-input z-depth-2"
                        placeholder="Search">
                </div> -->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title">Data Buku  yang  dipinjam <?php echo $data3->nama_mhs; ?> (<?php echo $data3->id_detail; ?>)</h5>
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="../admin">Dashboard</a>
                                </li>
                                <li class="active">Buku yang dipinjam <?php echo $data3->nama_mhs; ?></li>
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
                                        <input type="text" name="Search" id="cari" placeholder="Search"/>
                                    </div>
                                    <!-- <input type="text" id="cari" class="form-control mt-3 mb-5" placeholder="serach name..."> -->
                                    <div id="result">s</div>
                                </div>
                                <div class="row">
                                    <div class="container">
                                        <div class="col s12">
                                             <!-- <a class="waves-effect waves-light  btn">
                                                <i class="material-icons left">add</i>
                                                Add Data</a>
                                           Modal Trigger -->
                                            <a class="waves-effect waves-light btn modal-trigger" href="#modal1"> <i class="material-icons left">search</i>Cari Buku</a>
                                           
                                            <!-- Modal Structure -->
                                            <div id="modal1" class="modal">
                                                <div class="modal-content">
                                                    <h4>Cari Buku</h4>
                                                    <form method="post" action="pinjam">
                                                        <table><tr>
                                                                <td>Cari Berdasarkan</td>
                                                                <td>
                                                                    <div class="input-field col s12">
                                                                        <select name="cari">
                                                                            <option value="" disabled="disabled" selected="selected">Choose your option</option>
                                                                            <option value='judulbuku'>Judul Buku</option>
                                                                            <option value='pengarang'>Pengarang</option>
                                                                            <option value='penerbit'>Penerbit</option>
                                                                            <option value='isbn'>ISBN</option>
                                                                        </select>
                                                                        <label>Cari Berdasarkan</label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Keyword</td>
                                                                <td><input hidden type="text" value="<?php echo $data3->id_detail; ?>" name="id"><input type="text" name="keyword"></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <input
                                                                        type="submit"
                                                                        value="Cari"
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
                    <h4 class="header">Data Buku yang dipinjam <?php echo $data3->nama_mhs; ?> (<?php echo $data3->id_detail; ?>)</h4>
                    <table class="table">
                        <tr>
                            <td>Judul</td>
                            <td>Pengarang</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php
                    $kt = new Admin();
                    $query =  $kt->runQuery("select * from peminjaman 
                    inner join buku using(id_buku)
where id_detail=:id_detail ");
$query->execute(array(":id_detail"=>$data3->id_detail ));
//$query->debugDumpParams();

$show = $kt->getBooks();
while($data = $query->fetch(PDO::FETCH_OBJ)){
echo "
<tr>
<td>$data->judulbuku</td>
<td>$data->pengarang</td>
<td> <a class='waves-effect waves-light btn modal-trigger' href='#$data->id_buku'>Detail Buku</a></td>
<td><!-- <a class='blue waves-effect waves-light btn modal-trigger' href='#update$data->id_buku'>Update Buku</a>-->
<a class='red btn btn-danger' href='pinjam?iddetil=$data3->id_detail&delete=$data->id_buku'>Delete</a></td>

<!--<td><a class='btn btn-danger' href='buku?delete=$data->id_buku'>Delete</a></td>-->
</tr>
";
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

<?php include_once('view/footer.php');
//}?>


