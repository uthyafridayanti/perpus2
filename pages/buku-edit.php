<!-- Begin Page Content --> 
<div class="container-fluid"> 

<!-- row table-->   
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <span class="fas fa-users text-primary mt-2 "> Form Ubah Data Buku</span>         
    </div>
			
<div class="content-wrapper">
	<div class="card-body">
	<form action="proses/buku-edit-proses.php" method="post" enctype="multipart/form-data">
	<?php
	$id_buku=$_GET['id'];
	$q_tampil_buku=mysqli_query($db,"SELECT * FROM tbbuku WHERE idbuku='$id_buku'");
	$r_tampil_buku=mysqli_fetch_array($q_tampil_buku);
	$status= array('Dipinjam', 'Tersedia');
    ?>
				<div class="mb-3">
					<label class="form-label">ID buku</label>
					<input type="text" readonly="readonly"class="form-control" id="id_buku" name="id_buku"  value="<?php echo $r_tampil_buku['idbuku']; ?>">
				</div>
				<div class="mb-3">
					<label class="form-label">Judul Buku</label>
					<input type="text" class="form-control" id="judul_buku" name="judul_buku"  value="<?php echo $r_tampil_buku['judulbuku']; ?>">
				</div>
				<div class="mb-3">
					<label class="form-label">Kategori</label>
					<input type="text" class="form-control" id="kategori" name="kategori"  value="<?php echo $r_tampil_buku['kategori']; ?>">
				</div>
                <div class="mb-3">
					<label class="form-label">Pengarang</label>
					<input type="text" class="form-control" id="pengarang" name="pengarang"  value="<?php echo $r_tampil_buku['pengarang']; ?>">
				</div>
                <div class="mb-3">
					<label class="form-label">Penerbit</label>
					<input type="text" class="form-control" id="penerbit" name="penerbit"  value="<?php echo $r_tampil_buku['penerbit']; ?>">
				</div>
				<div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <?php
                                foreach ($status as $s){
                                    echo "<option value='$s' ";
                                    echo $r_tampil_buku['status']==$s?'selected="seleceted"':'';
                                    echo ">$s</option>";
                                }
                                ?>
                            </select>
                        </div>
				<div class="modal-footer">
					<a href="index.php?p=buku" class="btn btn-secondary">Kembali</a>
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary" id="tombol-simpan">
				</div>
				</form>

	</div>
</div>