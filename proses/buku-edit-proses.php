<?php
include'../koneksi.php';

$id_buku=$_POST['id_buku'];
$judulbuku=$_POST['judul_buku'];
$kategori=$_POST['kategori'];
$pengarang=$_POST['pengarang'];
$penerbit=$_POST['penerbit'];
$status=$_POST['status'];

If(isset($_POST['simpan'])){
	
		extract($_POST);
	
	mysqli_query($db,
		"UPDATE tbbuku
		SET judulbuku='$judulbuku',kategori='$kategori',pengarang='$pengarang',penerbit='$penerbit', status='$status'
		WHERE idbuku='$id_buku'"
	);
	header("location:../index.php?p=buku");
}
?>
