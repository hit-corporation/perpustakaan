<?php $this->layout('layouts::main_template', ['title' => 'Kategori'])?>

<!-- SECTION CSS -->
<?php $this->start('css') ?>

<link rel="stylesheet" href="<?=$this->e(base_url('assets/css/main.min.css'))?>">

<style>

</style>
<?php $this->stop() ?>

<!-- SECTION CONTENT -->
<?php $this->start('contents') ?>

<div class="row">
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Laporan Buku</h1>
		</div>

        <div class="card">
			<div class="card-header py-3">
				<div class="row">
					
					<div class="col-xl-2 col-lg-4 col-md-4 mb-2">
						<form name="form-search">
							<div class="row">
								<div class="col-12">
									<input class="rounded-lg w-100"  style="border-color: rgba(0, 0, 255, 0.3); height: calc(1.5em + 0.5rem + 2px); font-size: 12px;
    color: currentcolor; padding-left: inherit;" type="text" name="daterange" 
										value="<?php 
										if(isset($start)){ 
											echo date('m/d/Y', strtotime($start));
										} else { 
											echo date('m', time()).'//1//'.date('Y', time()); 
										}?> - <?php 
										if(isset($end)){ 
											echo date('m/d/Y', strtotime($end)); 
										}else{ 
											echo date('m/d/Y', time()); 
										}?>" />
								</div>
							</div>
						</form>
					</div>

					<div class="col-xl-10 col-lg-8 col-md-8">
						<form name="form-search-name">
							<div class="row">
								<div class="col-4">
									<select class="form-control form-control-sm" name="stok" id="stok">
										<option value="">Stok - Semua</option>
										<option value="unavailable">Habis</option>
										<option value="available">Tersedia</option>
									</select>
								</div>
								
								<div class="col-6">
									<input type="text" class="form-control form-control-sm" name="s_book_name" placeholder="Nama Buku">
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
                <div class="table-reponsive" style="overflow: auto;">
					<table id="table-main" class="table table-sm table-striped w-100">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Gambar</th>
                                <th>Nama</th>
								<th>Stok</th>
								<th>Stok Dipinjam</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>isbn</th>
                                <th>Year</th>
                                <th>Kategori</th>
                                <th>Tanggal Input</th>
                                <th>No Rak</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>



<?php $this->stop() ?>

<!-- SECTION JS -->
<?php $this->start('js') ?>

	<script src="<?=$this->e(base_url('assets/js/pages/bookReports.js'))?>"></script>

<?php $this->stop() ?>
