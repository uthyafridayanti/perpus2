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
		<td><h1><center>Data Anggota</center></h1>
		</td>
	</tr>

	<tr>
		<td>
			<div class="table-data">
				<table>
					<tr>
						<th>No</th>
						<th>ID Anggota</th>
						<th>Nama</th>
						<th>Foto</th>
						<th>Jenis Kelamin</th>
						<th>Alamat</th>
					</tr>
					<?php		
						$nomor=1;
						$query="SELECT * FROM tbanggota ORDER BY idanggota DESC";
						$q_tampil_anggota = mysqli_query($db, $query);
						if(mysqli_num_rows($q_tampil_anggota)>0)
						{
						while($r_tampil_anggota=mysqli_fetch_array($q_tampil_anggota)){
							if(empty($r_tampil_anggota['foto'])or($r_tampil_anggota['foto']=='-'))
								$foto = "admin-no-photo.jpg";
							else
								$foto = $r_tampil_anggota['foto'];
						?>
						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $r_tampil_anggota['idanggota']; ?></td>
							<td><?php echo $r_tampil_anggota['nama']; ?></td>
							<td><img src="../assets/images/<?php echo $foto; ?>" width=70px height=70px></td>
							<td><?php echo $r_tampil_anggota['jeniskelamin']; ?></td>
							<td><?php echo $r_tampil_anggota['alamat']; ?></td>		
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