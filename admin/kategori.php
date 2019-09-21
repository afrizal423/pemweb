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

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge"><link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link
            href="../bootstrap/css/bootstrap-theme.min.css"
            rel="stylesheet"
            media="screen">
        <script type="text/javascript" src="../jquery-1.11.3-jquery.min.js"></script>
        <title>welcome -
            <?php print($userRow['user_email']); ?></title>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button
                        type="button"
                        class="navbar-toggle collapsed"
                        data-toggle="collapse"
                        data-target="#navbar"
                        aria-expanded="false"
                        aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="../admin">Dashboard</a>
                        </li>
                        <li class="dropdown">
                            <a
                                href="#"
                                class="dropdown-toggle"
                                data-toggle="dropdown"
                                role="button"
                                aria-haspopup="true"
                                aria-expanded="false">
                                Data Master<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            <li>
                                <a href="kategori">Kategori Buku</a>
                                </li>
                                <li>
                                <a href="rakbuku">Rak Buku</a>
                                </li>
                            </ul>
                        </li>
                       
                        
                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">
                            <a
                                href="#"
                                class="dropdown-toggle"
                                data-toggle="dropdown"
                                role="button"
                                aria-haspopup="true"
                                aria-expanded="false">
                                <span class="glyphicon glyphicon-user"></span>&nbsp;Hi'
                                <?php echo $userRow['user_email']; ?>&nbsp;<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="profile.php">
                                        <span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a>
                                </li>
                                <li>
                                    <a href="../logout.php?logout=true">
                                        <span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

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
                    <table>
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

        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>