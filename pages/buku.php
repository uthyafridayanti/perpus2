<!-- Begin Page Content --> 
<div class="container-fluid"> 

<!-- row table-->   
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <span class="fas fa-users text-primary mt-2 "> Data Buku</span>         
    </div>
			
    <div class="card-body">
		<div style="float: left;">		
			<!-- Button tambah buku -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#input-buku">
				<i class="fas fa-plus-circle"></i> Tambah Buku Baru
			</button>
			<a href="pages/cetak-data-buku.php" class="btn btn-success"><i class="fa fa-print"></i> Cetak Data buku</a>
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
					<th>ID Buku</th>
					<th>Judul Buku</th>
					<th>Kategori</th>
					<th>Pengarang</th>
					<th>Penerbit</th>
                    <th>Status</th>
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
				$sql = "SELECT * FROM tbbuku WHERE idbuku LIKE '%$pencarian%'
						OR judulbuku LIKE '%$pencarian%'
						OR kategori LIKE '%$pencarian%'
                        OR pengarang LIKE '%$pencarian%'
                        OR penerbit LIKE '%$pencarian%'
						OR status LIKE '%$pencarian%'";
				
				$query = $sql;
				$queryJml = $sql;	
						
			}
			else {
				$query = "SELECT * FROM tbbuku LIMIT $posisi, $batas";
				$queryJml = "SELECT * FROM tbbuku";
				$no = $posisi * 1;
			}			
		}
		else {
			$query = "SELECT * FROM tbbuku LIMIT $posisi, $batas";
			$queryJml = "SELECT * FROM tbbuku";
			$no = $posisi * 1;
		}
		
		//$sql="SELECT * FROM tbbuku ORDER BY idbuku DESC";
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
			<td>
				<div class="btn-group-md">   
					<a target="_blank" href="pages/cetak_info_buku.php?id=<?php echo $r_tampil_buku['idbuku'];?>" class="badge badge-info"><i class="fas fa-book"></i> Cetak Info Buku</a><br>
					<a href="index.php?p=buku-edit&id=<?php echo $r_tampil_buku['idbuku'];?>" class="badge badge-warning"><i class="fas fa-edit"></i> Edit</a><br>
					<a href="proses/buku-hapus.php?id=<?php echo $r_tampil_buku['idbuku']; ?>" onclick = "return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
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
						echo "<li class='page-item'><a class='page-link' href=\"?p=buku&hal=$i\">$i</a></li>";
					}
					else {
						echo "<li class='page-item'><a class='page-link' href=\"?p=buku&hal=$i\">$i</a></li>";

					}
				}
				?>
  			</ul>
		</nav>			
		</div>	

		
	<?php
	}
	?>

<!-- modal tambah buku-->
<div class="modal fade" tabindex="-1" id="input-buku" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Input buku</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
	<form action="proses/buku-input-proses.php" method="post" enctype="multipart/form-data">
		<div class="mb-3">
			<label class="form-label">ID buku</label>
			<input type="text" name="id_buku" class="form-control" required>
		</div>
		<div class="mb-3">
			<label class="form-label">Judul Buku</label>
			<input type="text" name="judul_buku" class="form-control" required>
		</div>
        <div class="mb-3">
			<label class="form-label">Kategori</label>
			<input type="text" name="kategori" class="form-control" required>
		</div>
		<div class="mb-3">
			<label class="form-label">Pengarang</label>
			<input type="text" name="pengarang" class="form-control" required>
		</div>
        <div class="mb-3">
			<label class="form-label">Penerbit</label>
			<input type="text" name="penerbit" class="form-control" required>
		</div>
		<div class="mb-3">
			<label class="form-label">Status</label><br>
                <select name="status" class="form-control" required>
                    <option selected></option>
                    <option value="Dipinjam">Dipinjam</option>
					<option value="Tersedia">Tersedia</option>
				</select>
        </div>
		
      <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
      </div>
	</form>
    </div>
  </div>
</div>
