<?php
require_once('../config/dbconfig.php');
class Admin{
    private $db;
    public function __construct(){
        $database = new Database();
		$db = $database->dbConnection();
		$this->db = $db;
    }
    function generateRandomString($length) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
    public function redirect($url)
	{
		header("Location: $url");
	}
    public function runQuery($sql)
	{
		$stmt = $this->db->prepare($sql);
		return $stmt;
    }
    public function tmbhkategori($namakategori)
	{
		try
		{
			$pk = $this->generateRandomString(10);
			$stmt = $this->db->prepare("INSERT INTO kategori(id_kategori,namakategori) 
		                                  VALUES(:uname, :kat)");					  
			$stmt->bindparam(":uname", $pk);
			$stmt->bindparam(":kat", $namakategori);										  	
			$stmt->execute();	
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
    }
    public function hpsKategori($kode){
        $sql = "DELETE FROM kategori WHERE id_kategori='$kode'";
        $query = $this->db->query($sql);
        return $query;
        }
    public function addBook($kode, $judul, $pengarang, $penerbit){
        $sql = "INSERT INTO books (kodeBuku, judulBuku, pengarang, penerbit) VALUES('$kode', '$judul', '$pengarang', '$penerbit')";
        $query = $this->db->query($sql);
        if(!$query){
            return "Failed";
        }
        else{
            return "Success";
        }
    }
    public function editBook($kode){
        $sql = "SELECT * FROM books WHERE kodeBuku='$kode'";
        $query = $this->db->query($sql);
        return $query;
    }
    public function updateBook($kode, $judul, $pengarang, $penerbit){
        $sql = "UPDATE books SET judulBuku='$judul', pengarang='$pengarang', penerbit='$penerbit' WHERE kodeBuku='$kode'";
        $query = $this->db->query($sql);
        if(!$query){
            return "Failed";
        }
        else{
            return "Success";
        }
    }
     
    public function showBooks(){
        $sql = "SELECT * FROM kategori";
        $query = $this->db->query($sql);
        return $query;
    }
    public function deleteBook($kode){
        $sql = "DELETE FROM books WHERE kodeBuku='$kode'";
        $query = $this->db->query($sql);
        }
    }
    ?>
