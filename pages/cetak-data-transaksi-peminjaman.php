<?php
include "../koneksi.php";

?>
<style type="text/css">
    .table-data{
         width: 100%;
         border-collapse: collapse;
    }
    .table-data tr th,
    .table-data tr td{
         border:1px solid black;
         font-size: 11pt;
         font-family:Verdana;
         padding: 10px 10px 10px 10px;
    }
    .table-data th{
        background-color:grey;
    }
    h3{
        90
        font-family:Verdana;
    }
</style>

<div id="content">
<table>
	<tr>
		<td><h1><center>Data Transaksi</center></h1>
		</td>
	</tr>

	<tr>
		<td>
			<div class="table-data">
				<table>
					<tr>
                        <th>NO</th>
                        <th>ID Transaksi</th>
                        <th>ID Anggota</th>
                        <th>ID Buku</th>								
                        <th>Tanggal Pinjam</th>
					</tr>
					<?php		
						$nomor=1;
						$query="SELECT * FROM tbtransaksi ORDER BY idtransaksi DESC";
						$q_tampil_transaksi = mysqli_query($db, $query);
						if(mysqli_num_rows($q_tampil_transaksi)>0)
						{
						while($r_tampil_transaksi=mysqli_fetch_array($q_tampil_transaksi)){
	
					?>
						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $r_tampil_transaksi['idtransaksi']; ?></td>
							<td><?php echo $r_tampil_transaksi['idanggota']; ?></td>
							<td><?php echo $r_tampil_transaksi['idbuku']; ?></td>
							<td><?php echo $r_tampil_transaksi['tglpinjam']; ?></td>			
						</tr>		
						<?php $nomor++; } 
						}?>			
				</table>	
			</div>
		</td>
	</tr>
	
</table>
<script>
	window.print();
</script>
</div>