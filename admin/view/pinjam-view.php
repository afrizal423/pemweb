<?php
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
                                                                <td><input type="text" name="keyword"></td>
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
$show = $kt->getBooks();
while($data = $show->fetch(PDO::FETCH_OBJ)){
echo "
<tr>
<td>$data->judulbuku</td>
<td>$data->pengarang</td>
<td> <a class='waves-effect waves-light btn modal-trigger' href='#$data->id_buku'>Detail Buku</a></td>
<td><!-- <a class='blue waves-effect waves-light btn modal-trigger' href='#update$data->id_buku'>Update Buku</a>-->
<a class='red btn btn-danger' href='buku?delete=$data->id_buku'>Delete</a></td>

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