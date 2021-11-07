<!-- Begin Page Content --> 
<div class="container-fluid"> 

<!-- row table-->   
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <span class="fas fa-users text-primary mt-2 "> Data Transaksi</span>         
    </div>
			
    <div class="card-body">
		<div style="float: left;">		
			<!-- Button transaksi -->
			<a href="pages/cetak-data-transaksi-pengembalian.php" class="btn btn-success"><i class="fa fa-print"></i> Cetak Data transaksi</a>
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
                    <th>NO</th>
                    <th>ID Transaksi</th>
                    <th>ID Anggota</th>
                    <th>ID Buku</th>								
                    <th>Tanggal Pinjam</th>
					<th>Tanggal Kembali</th>
                    <th>Pilihan</th>				
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
				$sql = "SELECT * FROM tbtransaksi WHERE idtransaksi LIKE '%$pencarian%'
						OR idanggota LIKE '%$pencarian%'
						OR idbuku LIKE '%$pencarian%'
                        OR tglpinjam LIKE '%$pencarian%'
						OR tglkembali LIKE '%$pencarian%'";
				
				$query = $sql;
				$queryJml = $sql;	
						
			}
			else {
				$query = "SELECT * FROM tbtransaksi LIMIT $posisi, $batas";
				$queryJml = "SELECT * FROM tbtransaksi";
				$no = $posisi * 1;
			}			
		}
		else {
			$query = "SELECT * FROM tbtransaksi LIMIT $posisi, $batas";
			$queryJml = "SELECT * FROM tbtransaksi";
			$no = $posisi * 1;
		}
		
		//$sql="SELECT * FROM tbtransaksi ORDER BY idtransaksi DESC";
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
			<td><?php echo $r_tampil_transaksi['tglkembali']; ?></td>
			<td>
				<div class="btn-group-md">   
					<a target="_blank" href="pages/cetak-info-transaksi-pengembalian.php?id=<?php echo $r_tampil_transaksi['idtransaksi'];?>" class="badge badge-info"><i class="fas fa-book"></i> Cetak Info Transaksi</a><br>
					<a href="index.php?p=transaksi-edit-pengembalian&id=<?php echo $r_tampil_transaksi['idtransaksi'];?>" class="badge badge-warning"><i class="fas fa-edit"></i> Edit</a><br>
					<a href="proses/transaksi-pengembalian-hapus.php?id=<?php echo $r_tampil_transaksi['idtransaksi']; ?>" onclick = "return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
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
						echo "<li class='page-item'><a class='page-link' href=\"?p=transaksi-pengembalian&hal=$i\">$i</a></li>";
					}
					else {
						echo "<li class='page-item'><a class='page-link' href=\"?p=transaksi-pengembalian&hal=$i\">$i</a></li>";

					}
				}
				?>
  			</ul>
		</nav>			
		</div>	

		
	<?php
	}
	?>
<!-- modal tambah transaksi-->
<div class="modal fade" tabindex="-1" id="input-transaksi" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Input transaksi</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
	<form action="proses/transaksi-input-pengembalian.php" method="post" enctype="multipart/form-data">
		<div class="mb-3">
			<label class="form-label">ID transaksi</label>
			<input type="text" name="idtransaksi" class="form-control">
		</div>
		<div class="mb-3">
			<label class="form-label">ID Anggota</label>
			<input type="text" name="idanggota" class="form-control">
		</div>
        <div class="mb-3">
			<label class="form-label">ID Buku</label>
			<input type="text" name="idbuku" class="form-control">
		</div>
		<div class="mb-3">
			<label class="form-label">Tanggal Pinjam</label>
			<input type="date" name="tglpinjam" class="form-control">
		</div>
		<div class="mb-3">
			<label class="form-label">Tanggal Kembali</label>
			<input type="date" name="tglkembali" class="form-control">
		</div>
      <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
      </div>
	</form>
    </div>
  </div>
</div>
