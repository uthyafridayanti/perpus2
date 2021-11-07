<?php
    include "../koneksi.php";
	$id_transaksi=$_GET['id'];
	$q_tampil_transaksi=mysqli_query($db,"SELECT * FROM tbtransaksi WHERE idtransaksi='$id_transaksi'");
	$r_tampil_transaksi=mysqli_fetch_array($q_tampil_transaksi);
    ?>
    
<div id="label-page"><h2>Informasi Data Transaksi</h2></div>
<div id="content">
	<table border="1">
        <thead>           
			<tr>
                <th>ID Transaksi</th>
                <th>ID Anggota</th>
                <th>ID Buku</th>								
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
            </tr>        
        </thead>         
        <tbody>           
		    <tr>
            <td><?php echo $r_tampil_transaksi['idtransaksi']; ?></td>
			<td><?php echo $r_tampil_transaksi['idanggota']; ?></td>
            <td><?php echo $r_tampil_transaksi['idbuku']; ?></td>
			<td><?php echo $r_tampil_transaksi['tglpinjam']; ?></td>
            <td><?php echo $r_tampil_transaksi['tglkembali']; ?></td>
            </tr>			
	</table>
</div>
<script>
	window.print();
</script>