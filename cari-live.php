<?php
    require_once("../admin/class.admin.php");
	
	
	$kt = new Admin();
	if(isset($_POST["search"])){
		//echo "<b>".$_POST["search"]."</b>";
		$query =  $kt->runQuery("select * from buku
		where judulbuku like '%".$_POST['search']."%' ");
		$query->execute();
	  //  $query->debugDumpParams();
		//$data3 = $query->fetchObject(); //ambil data
	
								 $show = $kt->getBooks();
								 while($data = $query->fetchObject()){
								 $hasil = "
								 <h4><b>Buku yang dicari dengan keyword ".$_POST['search']."
								 <table class='table'>
								 <tr>
									 <td>Judul</td>
									 <td>Pengarang</td>
									 <td></td>
									 <td></td>
								 </tr>
								 <tr>
								 <td>$data->judulbuku</td>
								 <td>$data->pengarang</td>
								 <td> <a class='waves-effect waves-light btn modal-trigger' href='#$data->id_buku'>Detail Buku</a></td>
								 <td><!-- <a class='blue waves-effect waves-light btn modal-trigger' href='#update$data->id_buku'>Update Buku</a>-->
								 <a class='blue btn btn-danger' href='cari?buku=$data->id_buku&simpan'>Pilih</a></td>
								 
								 <!--<td><a class='btn btn-danger' href='buku?delete=$data->id_buku'>Delete</a></td>-->
								 </tr></table>
								 ";
								 };
								 echo $hasil;
	// 	// $iddetil = htmlentities($_GET['iddetil']);
	
	// 	// if($judulbuku=="")	{
	// 	// 	$error[] = "Kosong !";	
	// 	// } 
	   
	   
	// 	//echo $data2;
		
		
	   
	}else{echo 'Data Not Found';}
                            
?>