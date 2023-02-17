<?php $this->layout('layouts::main_template', ['title' => 'Publisher'])?>

<!-- SECTION CONTENT -->
<?php $this->start('contents') ?>

<!-- CONTENT -->
<!-- <div class="container"> -->
	<div class="row">

		<!-- Begin Page Content -->
		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">Penerbit</h1>
				<button href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModal"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</button>
				
			</div>

			<!-- Content Row -->
			<!-- <div class="row"> -->

				<!-- DataTales Example -->
				<div class="card shadow mb-4">

					<div class="card-header py-3">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6">
								<h6 class="m-0 font-weight-bold text-primary">List Data Penerbit</h6>

							</div>
							<div class="col-xl-6 col-lg-6 col-md-6">
								<form name="form-search">
									<div class="row">
										<div class="col-10">
											<input type="text" class="form-control form-control-sm" name="s_publisher_name" placeholder="Nama User">
										</div>
										<div class="col-2">
											<div class="btn-group btn-group-sm">
												<button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
												<button type="reset" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Nama Penerbit</th>
										<th>Full Name</th>
										<th>Tanggal Dibuat</th>
										<th>Action</th>
									</tr>
								</thead>
								
								<tbody>
									<?php $i=1; foreach ($publishers as $key => $value) { ?>

									<tr>
										<td><?=$value['publisher_name']?></td>
										<td><?=$value['address']?></td>
										<td><?=$value['created_at']?></td>
										<td>
											<button type="button" name="editBtn" id="editBtn" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#editModal<?=$i?>">
												<i class="fas fa-edit"></i>
											</button>

											<!-- Modal Edit -->
											<div class="modal fade" id="editModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<form method="post" action="<?=base_url('publisher')?>">
															<div class="form-group">
																<label for="publisher_name">User Name</label>
																<input type="hidden" id="id" name="id" value="<?=$value['id']?>">
																<input type="text" class="form-control" id="publisher_name" name="publisher_name" value="<?=$value['publisher_name']?>" placeholder="Masukan Nama Penerbit">
															</div>
															<div class="form-group">
																<label for="address">Full Name</label>
																<input type="text" class="form-control" id="address" name="address" value="<?=$value['address']?>" placeholder="Masukan Alamat Penerbit">
															</div>
															
														
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary" name="update">Save changes</button>
													</div>
													</form>
													</div>
												</div>
											</div>

											<button name="deleteBtn" id="deleteBtn" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#deleteModal<?=$i?>">
												<i class="fas fa-trash"></i>
											</button>

											<!-- Modal Edit -->
											<div class="modal fade" id="deleteModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Hapus Penerbit</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<form method="post" action="<?=base_url('publisher')?>">
															<div class="form-group">
																<label for="publisher_name">User Name</label>
																<input type="hidden" id="id" name="id" value="<?=$value['id']?>">
																<input type="text" readonly class="form-control" id="publisher_name" name="publisher_name" value="<?=$value['publisher_name']?>" placeholder="Masukan Nama Penerbit">
															</div>
															<div class="form-group">
																<label for="address">Full Name</label>
																<input type="text" readonly class="form-control" id="address" name="address" value="<?=$value['address']?>" placeholder="Masukan Alamat Penerbit">
															</div>
															
														
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary" name="delete">Hapus</button>
													</div>
													</form>
													</div>
												</div>
											</div>
											
										</td>
									</tr>
										
									<?php $i++; } ?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>

			

				

				
			<!-- </div> -->


		</div>
		<!-- /.container-fluid -->

	</div>

	<!-- Modal tambah -->
	<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Penerbit</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?=base_url('publisher')?>">
					<div class="form-group">
						<label for="publisher_name">Nama Penerbit</label>
						<input type="text" class="form-control" id="publisher_name" name="publisher_name" placeholder="Masukan Nama Penerbit">
					</div>
					<div class="form-group">
						<label for="address">Alamat Penerbit</label>
						<input type="text" class="form-control" id="address" name="address" placeholder="Masukan Alamat Penerbit">
					</div>
					
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" name="save">Save changes</button>
			</div>
			</form>
			</div>
		</div>
	</div>


<?php $this->stop() ?>

<!-- SECTION JS -->
<?php $this->start('js') ?>

<?php if(isset($_SESSION['error'])): ?>
<script>
   $('#modal-input').modal('show');
</script>
<?php endif; ?>

<?php if(isset($_SESSION['success'])): ?>
<script>
   
    Swal.fire({
        icon: 'success',
        title: '<h4 class="text-success">SUKSES</h4>',
        html: '<h5 class="text-success"><?=$_SESSION['success']['message']?></h5>',
        timer: 1500
    });

</script>
<?php endif; ?>

<?php if(isset($_SESSION['error']['message'])): ?>
<script>
   
    Swal.fire({
        icon: 'error',
        title: '<h4 class="text-danger">GAGAL</h4>',
        html: '<h5 class="text-danger"><?=$_SESSION['error']['message']?></h5>',
        timer: 1500
    });

</script>
<?php endif; ?>

<script src="<?=$this->e(base_url('assets/js/pages/publishers.js'))?>"></script>

<?php $this->stop() ?>
