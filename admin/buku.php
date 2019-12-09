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
        $judulbuku = strip_tags($_POST['judulbuku']);
        $pengarang = strip_tags($_POST['pengarang']);
        $penerbit = strip_tags($_POST['penerbit']);
        $isbn = strip_tags($_POST['isbn']);
        $id_kategori = strip_tags($_POST['id_kategori']);
        $kode_rak = strip_tags($_POST['kode_rak']);
        $jumlah_buku_tersedia = strip_tags($_POST['jumlah_buku_tersedia']);
	
	if($judulbuku=="")	{
		$error[] = "Kosong !";	
    } 
    $kt = new Admin();
    if($kt->tmbhBuku($id_kategori,$kode_rak,$judulbuku,$pengarang,$penerbit,$isbn,$jumlah_buku_tersedia)){	
        $kt->redirect('buku?sukses');
    }
       /* $Lib = new Library();
        $add = $Lib->addBook($kode, $judul, $pengarang, $penerbit);
        if($add == "Success"){
        header('Location: List.php');
        }
        }*/} else if(isset($_GET['delete'])){
            $kt = new Admin();
if($kt->deleteBook($_GET['delete'])){	
    $kt->redirect('buku?hapus');
}
} else if(isset($_POST['update'])){
    $id_buku = strip_tags($_POST['id_buku']);
    $judulbuku = strip_tags($_POST['judulbuku']);
        $pengarang = strip_tags($_POST['pengarang']);
        $penerbit = strip_tags($_POST['penerbit']);
        $isbn = strip_tags($_POST['isbn']);
        $id_kategori = strip_tags($_POST['id_kategori']);
        $kode_rak = strip_tags($_POST['kode_rak']);
        $jumlah_buku_tersedia = strip_tags($_POST['jumlah_buku_tersedia']);
	
	if($judulbuku=="")	{
		$error[] = "Kosong !";	
    } 
    $kt = new Admin();
    if($kt->updateBuku($id_buku,$id_kategori,$kode_rak,$judulbuku,$pengarang,$penerbit,$isbn,$jumlah_buku_tersedia)){	
        $kt->redirect('buku?suksesupdate');
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
                            <h5 class="breadcrumbs-title">Data Buku</h5>
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="../admin">Dashboard</a>
                                </li>
                                <li class="active">Buku</li>
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
                                            <a class="waves-effect waves-light btn modal-trigger" href="#modal1"> <i class="material-icons left">add</i>Tambah data Buku</a>
                                           
                                            <!-- Modal Structure -->
                                            <div id="modal1" class="modal">
                                                <div class="modal-content">
                                                    <h4>Tambah Buku</h4>
                                                    <form method="post" action="buku">
                                                        <table>
                                                            <tr>
                                                                <td>Judul Buku</td>
                                                                <td><input type="text" name="judulbuku"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pengarang Buku</td>
                                                                <td><input type="text" name="pengarang"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Penerbit Buku</td>
                                                                <td><input type="text" name="penerbit"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>ISBN</td>
                                                                <td><input type="text" name="isbn"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kategori Buku</td>
                                                                <td>
                                                                    <div class="input-field col s12">
                                                                       
                                                                        <select name="id_kategori">
                                                                            <option value="" disabled="disabled" selected="selected">Choose your option</option>
                                                                            <?php $kt = new Admin();
                                                                            $show = $kt->showBooks();
                                                                            while($data = $show->fetch(PDO::FETCH_OBJ)){
                                                                            echo "
                                                                            <option value='$data->id_kategori'>$data->namakategori</option>";
                                                                            };
                                                                            ?>
                                                                        </select>
                                                                        <label>Kategori Buku</label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Rak Buku</td>
                                                                <td>
                                                                    <div class="input-field col s12">
                                                                        <select name="kode_rak">
                                                                            <option value="" disabled="disabled" selected="selected">Choose your option</option>
                                                                            <?php
                                                                            $kt = new Admin();
                                                                            $show = $kt->showRak();
                                                                            while($data = $show->fetch(PDO::FETCH_OBJ)){
                                                                            echo "
                                                                            <option value='$data->kode_rak'>$data->namarak</option>";
                                                                            };
                                                                            ?>
                                                                        </select>
                                                                        <label>Rak Buku</label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Jumlah buku yang tersedia</td>
                                                                <td><input type="number" name="jumlah_buku_tersedia"></td>
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


<!-- Bagian update -->


<?php 
                                             $kt = new Admin();
$a = $kt->getBooks();
while($dt = $a->fetch(PDO::FETCH_OBJ)){ ?>
<!-- Modal Structure -->
<div id="<?php echo "update".$dt->id_buku ?>" class="modal">
                                                <div class="modal-content">
                                                    <h4>detail Buku</h4>
                                                    <form method="post" action="buku">
                                                        <table>
                                                            <tr>
                                                                <td>Judul Buku</td>
                                                                <td><input type="text" name="judulbuku" value="<?php echo $dt->judulbuku ?>">
                                                                <input hidden type="text" name="id_buku" value="<?php echo $dt->id_buku ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pengarang Buku</td>
                                                                <td><input type="text" name="pengarang" value="<?php echo $dt->pengarang ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Penerbit Buku</td>
                                                                <td><input type="text" name="penerbit" value="<?php echo $dt->penerbit ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>ISBN</td>
                                                                <td><input type="text" name="isbn" value="<?php echo $dt->isbn ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Jumlah Buku</td>
                                                                <td><input type="text" name="jumlah_buku_tersedia" value="<?php echo $dt->jumlah_buku_tersedia ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kategori Buku</td>
                                                                <td><div class="input-field col s12">
                                                                        <select name="id_kategori">
                                                                            <option value="" disabled="disabled">Choose your option</option>
                                                                            <?php
                                                                            $kt = new Admin();
                                                                            $show = $kt->showBooks();
                                                                            while($data = $show->fetch(PDO::FETCH_OBJ)){ ?>

                                                                            <option value='<?= $data->id_kategori;?>' <?php if($dt->id_kategori == $data->id_kategori) echo "selected='selected'"?>> <?= $data->namakategori ?></option>
                                                                            
                                                                            <?php };
                                                                            ?>
                                                                        </select>
                                                                        <label>Rak Buku</label>
                                                                    </div></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Rak Buku</td>
                                                                <td><div class="input-field col s12">
                                                                        <select name="kode_rak">
                                                                            <option value="" disabled="disabled">Choose your option</option>
                                                                            <?php
                                                                            $kt = new Admin();
                                                                            $show = $kt->showRak();
                                                                            while($data = $show->fetch(PDO::FETCH_OBJ)){?>
                                                                            
                                                                            <option value='<?=$data->kode_rak?>' <?php if($dt->kode_rak == $data->kode_rak) echo "selected='selected'"?>><?=$data->namarak?></option>
                                                                          
                                                                            <?php  }; ?>
                                                                        </select>
                                                                        <label>Rak Buku</label>
                                                                    </div></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <input
                                                                        type="submit"
                                                                        value="UPDATE"
                                                                        name="update"
                                                                        class="waves-effect waves-light  btn"></td>
                                                            </tr>
                                                        </table>
                                                    </form>
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
                    <h4 class="header">Data Barang</h4>
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
<td> <a class='blue waves-effect waves-light btn modal-trigger' href='#update$data->id_buku'>Update Buku</a>
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

<?php 
include_once('view/footer.php');
?>