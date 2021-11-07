<!-- Begin Page Content --> 
<div class="container-fluid"> 

<!-- row table-->   
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <span class="fas fa-users text-primary mt-2 "> Form Ubah Data Anggota</span>         
    </div>
			
    

<div class="content-wrapper">
	<div class="card-body">
	<form action="proses/anggota-edit-proses.php" method="post" enctype="multipart/form-data">
	<?php
	$id_anggota=$_GET['id'];
	$q_tampil_anggota=mysqli_query($db,"SELECT * FROM tbanggota WHERE idanggota='$id_anggota'");
	$r_tampil_anggota=mysqli_fetch_array($q_tampil_anggota);
		if(empty($r_tampil_anggota['foto'])or($r_tampil_anggota['foto']=='-'))
			$foto = "admin-no-photo.jpg";
		else
			$foto = $r_tampil_anggota['foto'];
?>
				<div class="mb-3">
					<label class="form-label">ID Anggota</label>
					<input type="text" readonly="readonly"class="form-control" id="id_anggota" name="id_anggota"  value="<?php echo $r_tampil_anggota['idanggota']; ?>">
				</div>
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" class="form-control" id="nama" name="nama"  value="<?php echo $r_tampil_anggota['nama']; ?>">
				</div>
				<div class="mb-3">
					<label class="form-label">Jenis Kelamin</label>
					<input type="hidden" name="jenis_kelamin" value="<?php echo $r_tampil_anggota['jeniskelamin']; ?>">
					<?php
						if($r_tampil_anggota['jeniskelamin']=="Pria")
						{
							echo "<div class='form-check'>
							<input type='radio' name='jenis_kelamin' value='Pria' checked>  Pria</label>
							<input type='radio' name='jenis_kelamin' value='Wanita'>Wanita</label>
							</div>";
						}
						else
						{
							echo "<div class='form-check'>
							<input type='radio' name='jenis_kelamin' value='Pria'>  Pria</label>
							<input type='radio' name='jenis_kelamin' value='Wanita'checked> Wanita</label>
							
							</div>";
						}
					?>
				</div>	
				<div class="mb-3">
					<label class="form-label">Alamat</label>
					<input type="text" class="form-control" id="alamat" name="alamat"  value="<?php echo $r_tampil_anggota['alamat']; ?>">
				</div>
				<div class="form-group row">
                	<div class="col-sm-2">Foto</div>
                		<div class="col-sm-10">
                    		<div class="row">
                        		<div class="col-sm-3">
                            	<img src="assets/images/<?php echo $foto; ?>" class="img-thumbnail" alt="">
                        		</div>
                        		<div class="col-sm-9">
                            		<div class="custom-file">
									<input type="file" name="foto" class="form-control">
                            		</div>
                        		</div>
                    		</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a href="index.php?p=anggota" class="btn btn-secondary">Kembali</a>
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary" id="tombol-simpan">
				</div>
				</form>

	</div>
</div>