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
        $namarak = strip_tags($_POST['namarak']);
	
	if($namarak=="")	{
		$error[] = "Rak Kosong !";	
    } 
    $kt = new Admin();
    if($kt->tmbhRak($namarak)){	
        $kt->redirect('rakbuku?sukses');
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
<!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START MAIN -->
    <div id="main">
      <!-- START WRAPPER -->
      <div class="wrapper">
      <?php 
include_once('view/menu.php');
?>

        <!-- //////////////////////////////////////////////////////////////////////////// -->
        <!-- START CONTENT -->
        <section id="content">
        <div id="breadcrumbs-wrapper">
              <!-- Search for small screen -->
              <!-- <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
                <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Search">
              </div> -->
              <div class="container">
                <div class="row">
                  <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title">Data Rak Buku</h5>
                    <ol class="breadcrumbs">
                      <li><a href="../admin">Dashboard</a></li>
                      <li class="active">Rak Buku</li>
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
            <div class="container">
              <div class="section">
                  <div class="row">
                    <div class="col s12">
                    <form method="post" action="rakbuku">
                    <table>
                        <tr>
                            <td>Nama Rak Buku</td>
                            <td><input type="text" name="namarak"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                            <input type="submit" value="SIMPAN" name="kirim" class="waves-effect waves-light  btn" ></td>
                        </tr>
                    </table>
                </form>
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
            <h4 class="header">Data Barang</h4>
                <table class="table">
                    <tr>
                        <td>Kode Rak</td>
                        <td>Nama Rak Buku</td>
                        <td></td>
                    </tr>
                    <?php
                    $kt = new Admin();
$show = $kt->showRak();
while($data = $show->fetch(PDO::FETCH_OBJ)){
echo "
<tr>
<td>$data->kode_rak</td>
<td>$data->namarak</td>
<td><a class='btn btn-danger' href='rakbuku?delete=$data->kode_rak'>Delete</a></td>
</tr>";
};
?>
                </table>
            </div>

            
            <!-- //////////////////////////////////////////////////////////////////////////// -->
          </div>
          <!--end container-->
        </section>
        <!-- END CONTENT -->

      </div>
      <!-- END WRAPPER -->
    </div>
    <!-- END MAIN -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->


        
        <?php 
include_once('view/footer.php');
?>