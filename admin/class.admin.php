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
    public function tmbhRak($namarak)
        {
            try
            {
                $pk = $this->generateRandomString(10);
                $stmt = $this->db->prepare("INSERT INTO rak_buku(kode_rak,namarak) 
                                              VALUES(:uname, :kat)");					  
                $stmt->bindparam(":uname", $pk);
                $stmt->bindparam(":kat", $namarak);										  	
                $stmt->execute();	
                return $stmt;	
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }				
        }
        public function tmbhAnggota($id_mhs,$alamat_anggota,$notlp_anggota)
        {
            try
            {
                $pk = $this->generateRandomString(10);
                $stmt = $this->db->prepare("INSERT INTO anggota(id_anggota,id_mhs,alamat_anggota,notlp_anggota) 
                                              VALUES(:uname, :idmhs, :alamat, :notlp)");					  
                $stmt->bindparam(":uname", $pk);
                $stmt->bindparam(":idmhs", $id_mhs);
                $stmt->bindparam(":alamat", $alamat_anggota);										  	
                $stmt->bindparam(":notlp", $notlp_anggota);										  	
                $stmt->execute();	
                return $stmt;	
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }				
        }
        public function tmbhMhs($nama_mhs,$npm_mhs,$jurusan,$fakultas)
        {
            try
            {
                $pk = $this->generateRandomString(11);
                $stmt = $this->db->prepare("INSERT INTO mahasiswa(id_mhs,nama_mhs,npm_mhs,jurusan,fakultas) 
                                              VALUES(:uname, :nama, :npm, :jurusan, :fakultas)");					  
                $stmt->bindparam(":uname", $pk);
                $stmt->bindparam(":nama", $nama_mhs);
                $stmt->bindparam(":npm", $npm_mhs);
                $stmt->bindparam(":jurusan", $jurusan);
                $stmt->bindparam(":fakultas", $fakultas);										  	
                $stmt->execute();	
                return $stmt;	
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }				
        }
    public function tmbhBuku($id_kategori,$kode_rak,$judulbuku,$pengarang,$penerbit,$isbn,$jumlah_buku_tersedia)
    {
        try
        {
            $pk = $this->generateRandomString(10);
            $stmt = $this->db->prepare("INSERT INTO buku(id_buku,id_kategori,kode_rak,judulbuku,pengarang,penerbit,isbn,jumlah_buku_tersedia) 
                                          VALUES(:uname, :idkat, :rak, :judul, :pengarang, :penerbit, :isbn, :jumlah)");					  
            $stmt->bindparam(":uname", $pk);
            $stmt->bindparam(":idkat", $id_kategori);
            $stmt->bindparam(":rak", $kode_rak);
            $stmt->bindparam(":judul", $judulbuku);
            $stmt->bindparam(":pengarang", $pengarang);
            $stmt->bindparam(":penerbit", $penerbit);										  	
            $stmt->bindparam(":isbn", $isbn);										  	
            $stmt->bindparam(":jumlah", $jumlah_buku_tersedia);										  	

            $stmt->execute();	
            return $stmt;	
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }	

    }
    public function updateBuku($id_buku,$id_kategori,$kode_rak,$judulbuku,$pengarang,$penerbit,$isbn,$jumlah_buku_tersedia)
    {
        try
        {
            $stmt = $this->db->prepare(" UPDATE buku set id_kategori=:idkat, kode_rak=:rak, judulbuku=:judul, pengarang=:pengarang, penerbit= :penerbit, isbn=:isbn, jumlah_buku_tersedia=:jumlah 
                                          where id_buku=:uname");					  
            $stmt->bindparam(":uname", $id_buku);
            $stmt->bindparam(":idkat", $id_kategori);
            $stmt->bindparam(":rak", $kode_rak);
            $stmt->bindparam(":judul", $judulbuku);
            $stmt->bindparam(":pengarang", $pengarang);
            $stmt->bindparam(":penerbit", $penerbit);										  	
            $stmt->bindparam(":isbn", $isbn);										  	
            $stmt->bindparam(":jumlah", $jumlah_buku_tersedia);										  	

            $stmt->execute();	
            return $stmt;	
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }	

    }
    public function hpsRak($kode){
            $sql = "DELETE FROM rak_buku WHERE kode_rak='$kode'";
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
    public function getBooks(){
        $sql = "SELECT * FROM buku";
        $query = $this->db->query($sql);
        return $query;
    }
    public function showRak(){
        $sql = "SELECT * FROM rak_buku";
        $query = $this->db->query($sql);
        return $query;
    }
    public function showmember(){
        $sql = "select * from mahasiswa inner join anggota using(id_mhs)";
        $query = $this->db->query($sql);
        return $query;
    }
    public function deleteBook($kode){
        $sql = "DELETE FROM buku WHERE id_buku='$kode'";
        $query = $this->db->query($sql);
        return $query;
        }
    }
    ?>
