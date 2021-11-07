<!-- Begin Page Content --> 
<div class="container-fluid"> 

<!-- row table-->   
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <span class="fas fa-users text-primary mt-2 "> Data Anggota</span>         
    </div>
			
    <div class="card-body">
		<div style="float: left;">		
			<!-- Button tambah anggota -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#input-anggota">
				<i class="fas fa-plus-circle"></i> Tambah Anggota Baru
			</button>
			<a href="pages/cetak-data-anggota.php" class="btn btn-success"><i class="fa fa-print"></i> Cetak Data Anggota</a>
		</div>	
		

		<div style="float: right;">	
			<FORM CLASS="form-inline" METHOD="POST">	
				<form method=post>
				<div class="input-group mb-3">
					<input type="text" class="form-control" name="pencarian">
					<div class="input-group-append">
						<input class="btn btn-outline-secondary" type="submit" name="search" value="search" class="tombol">
					</div>
				</div>
				</form>
			</FORM>
		</div>
	
    <div class="table-responsive mt-3">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">              
        	<thead>           
				<tr>
					<th>No</td>
					<th>ID Anggota</th>
					<th>Nama</th>
					<th>Foto</th>
					<th>Jenis Kelamin</th>
					<th>Alamat</th>
					<th id="label-opsi">Opsi</th>
				</tr>        
            </thead>         
            <tbody>           
			<?php
		$batas = 5;
		extract($_GET);
		if(empty($hal)){
			$posisi = 0;
			$hal = 1;
			$nomor = 1;
		}
		else {
			$posisi = ($hal - 1) * $batas;
			$nomor = $posisi+1;
		}	
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian']));
			if($pencarian != ""){
				$sql = "SELECT * FROM tbanggota WHERE nama LIKE '%$pencarian%'
						OR idanggota LIKE '%$pencarian%'
						OR jeniskelamin LIKE '%$pencarian%'
						OR alamat LIKE '%$pencarian%'";
				
				$query = $sql;
				$queryJml = $sql;	
						
			}
			else {
				$query = "SELECT * FROM tbanggota LIMIT $posisi, $batas";
				$queryJml = "SELECT * FROM tbanggota";
				$no = $posisi * 1;
			}			
		}
		else {
			$query = "SELECT * FROM tbanggota LIMIT $posisi, $batas";
			$queryJml = "SELECT * FROM tbanggota";
			$no = $posisi * 1;
		}
		
		//$sql="SELECT * FROM tbanggota ORDER BY idanggota DESC";
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
			<td><img src="./assets/images/<?php echo $foto; ?>" width=70px height=70px></td>
			<td><?php echo $r_tampil_anggota['jeniskelamin']; ?></td>
			<td><?php echo $r_tampil_anggota['alamat']; ?></td>
			<td>
				<div class="btn-group-md">   
					<a target="_blank" href="pages/cetak_kartu.php?id=<?php echo $r_tampil_anggota['idanggota'];?>" class="badge badge-info"><i class="fas fa-book"></i> Cetak Kartu</a><br>
					<a href="index.php?p=anggota-edit&id=<?php echo $r_tampil_anggota['idanggota'];?>" class="badge badge-warning"><i class="fas fa-edit"></i> Edit</a><br>
					<a href="proses/anggota-hapus.php?id=<?php echo $r_tampil_anggota['idanggota']; ?>" onclick = "return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
				</div>
			</td>			
		</tr>		
		<?php $nomor++; } 
		}
		else {
			echo "<tr><td colspan=6>Data Tidak Ditemukan</td></tr>";
		}?>		
	</table>
	<?php
	if(isset($_POST['pencarian'])){
	if($_POST['pencarian']!=''){
		echo "<div style=\"float:left;\">";
		$jml = mysqli_num_rows(mysqli_query($db, $queryJml));
		echo "Data Hasil Pencarian: <b>$jml</b>";
		echo "</div>";
	}
	}
	else{ ?>
		<div style="float: left;">		
		<?php
			$jml = mysqli_num_rows(mysqli_query($db, $queryJml));
			echo "Jumlah Data : <b>$jml</b>";
		?>			
		</div>	

		<div style="float: right;">		
		<nav aria-label="Page navigation example">
  			<ul class="pagination">
  			<?php
			$jml_hal = ceil($jml/$batas);
				for($i=1; $i<=$jml_hal; $i++){
					if($i != $hal){
						echo "<li class='page-item'><a class='page-link' href=\"?p=anggota&hal=$i\">$i</a></li>";
					}
					else {
						echo "<li class='page-item'><a class='page-link' href=\"?p=anggota&hal=$i\">$i</a></li>";

					}
				}
				?>
  			</ul>
		</nav>			
		</div>	

		
	<?php
	}
	?>

<!-- modal tambah anggota-->
<div class="modal fade" tabindex="-1" id="input-anggota" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Input Anggota</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
	<form action="proses/anggota-input-proses.php" method="post" enctype="multipart/form-data">
		<div class="mb-3">
			<label class="form-label">ID Anggota</label>
			<input type="text" name="id_anggota" class="form-control" required>
		</div>
		<div class="mb-3">
			<label class="form-label">Nama</label>
			<input type="text" name="nama" class="form-control" required>
		</div>
		<div class="mb-3">
			<label class="form-label">Jenis Kelamin</label>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="jenis_kelamin"  value="pria" required>
				<label class="form-check-label">
					Pria
				</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="jenis_kelamin"  value="wanita" required>
				<label class="form-check-label">
					Wanita
				</label>
			</div>
		</div>
		<div class="mb-3">
			<label class="form-label">Alamat</label>
			<textarea rows="2" cols="40" name="alamat" class="form-control"  required></textarea>
		</div>
		<div class="mb-3">
			<label class="form-label">Foto</label>
			<input type="file" name="foto" class="form-control"  required>
		</div>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
      </div>
	</form>
    </div>
  </div>
</div>
