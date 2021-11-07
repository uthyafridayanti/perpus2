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
		<td><h1><center>Data Buku</center></h1>
		</td>
	</tr>

	<tr>
		<td>
			<div class="table-data">
				<table>
					<tr>
                        <th>No</td>
                        <th>ID Buku</th>
                        <th>Judul Buku</th>
                        <th>Kategori</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Status</th>
					</tr>
					<?php		
					$nomor=1;
					$query="SELECT * FROM tbbuku ORDER BY idbuku DESC";
					$q_tampil_buku = mysqli_query($db, $query);
						if(mysqli_num_rows($q_tampil_buku)>0)
						{
						while($r_tampil_buku=mysqli_fetch_array($q_tampil_buku)){
					?>
						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $r_tampil_buku['idbuku']; ?></td>
							<td><?php echo $r_tampil_buku['judulbuku']; ?></td>
							<td><?php echo $r_tampil_buku['kategori']; ?></td>
							<td><?php echo $r_tampil_buku['pengarang']; ?></td>
                            <td><?php echo $r_tampil_buku['penerbit']; ?></td>
                            <td><?php echo $r_tampil_buku['status']; ?></td>		
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