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
        $namakategori = strip_tags($_POST['namakategori']);
	
	if($namakategori=="")	{
		$error[] = "Kategori Kosong !";	
    } 
    $kt = new Admin();
    if($kt->tmbhkategori($namakategori)){	
        $kt->redirect('kategori?sukses');
    }
       /* $Lib = new Library();
        $add = $Lib->addBook($kode, $judul, $pengarang, $penerbit);
        if($add == "Success"){
        header('Location: List.php');
        }
        }*/} else if(isset($_GET['delete'])){
            $kt = new Admin();
if($kt->hpsKategori($_GET['delete'])){	
    $kt->redirect('kategori?hapus');
}
}
?>
<?php 
include_once('view/header.php');
?>
        <div class="clearfix"></div>
        <div class="container-fluid" style="margin-top:80px;">
            <div class="container">
                <label class="h5">welcome :
                    <?php print($userRow['user_name']); ?><br>Silahkan masukkan data kategori</label>
                <hr>
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
                <form method="post" action="kategori">
                <table style="margin:20px auto;">
                        <tr>
                            <td>Kategori Buku</td>
                            <td><input type="text" name="namakategori"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="SIMPAN" name="kirim"></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="container">
                <h2>List Kategori Buku</h2>
                <table class="table">
                    <tr>
                        <td>Kode Kategori</td>
                        <td>Nama Kategori</td>
                        <td></td>
                    </tr>
                    <?php
                    $kt = new Admin();
$show = $kt->showBooks();
while($data = $show->fetch(PDO::FETCH_OBJ)){
echo "
<tr>
<td>$data->id_kategori</td>
<td>$data->namakategori</td>
<td><a class='btn btn-danger' href='kategori?delete=$data->id_kategori'>Delete</a></td>
</tr>";
};
?>
                </table>
            </div>
        </div>
        <?php 
include_once('view/footer.php');
?>