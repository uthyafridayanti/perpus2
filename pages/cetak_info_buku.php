<?php
    include "../koneksi.php";
	$id_buku=$_GET['id'];
	$q_tampil_buku=mysqli_query($db,"SELECT * FROM tbbuku WHERE idbuku='$id_buku'");
	$r_tampil_buku=mysqli_fetch_array($q_tampil_buku);
	$status= array('Dipinjam', 'Tersedia');
    ?>
    
<div id="label-page"><h2>Informasi Data Buku</h2></div>
<div id="content">
	<table border="1">
        <thead>           
			<tr>
                <th>ID Buku</th>
                <th>Judul Buku</th>
                <th>Kategori</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Status</th>
            </tr>        
        </thead>         
        <tbody>           
		    <tr>
                <td><?php echo $r_tampil_buku['idbuku']; ?></td>
                <td><?php echo $r_tampil_buku['judulbuku']; ?></td>
                <td><?php echo $r_tampil_buku['kategori']; ?></td>
                <td><?php echo $r_tampil_buku['pengarang']; ?></td>
                <td><?php echo $r_tampil_buku['penerbit']; ?></td>
                <td><?php echo $r_tampil_buku['status']; ?></td>	
            </tr>			
	</table>
</div>
<script>
	window.print();
</script>