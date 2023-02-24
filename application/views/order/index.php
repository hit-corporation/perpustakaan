<?php $this->layout('layouts::main_template', ['title' => 'Book Order'])?>

<!-- CSS SECTION -->
<?php $this->start('css') ?>
<link rel="stylesheet" href="<?=$this->e(base_url('assets/node_modules/@selectize/selectize/dist/css/selectize.bootstrap4.css'))?>">
<link rel="stylesheet" href="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.min.css'))?>">
<link rel="stylesheet" href="<?=$this->e(base_url('assets/css/main.min.css'))?>">

<style>

    @media (min-width: 992px) {
        .d-lg-table-head {
            display: table-header-group !important;
        }
    }

</style>

<?php $this->stop() ?>

<!-- CONTENT SECTION -->
<?php $this->start('contents') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="d-sm-flex align-items-center justify-content-between mb-4 px-2">
                <h1 class="h3 mb-0 text-gray-800"><?=$this->e('Formulir Peminjaman Buku')?></h1>
            </div>

            <div class="card">
                <form class="card-body">
                    <fieldset class="form-row">
                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                            <label for="" class="form-label">Anggota</label>
                            <select class="form-control" name="member"></select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                            <label for="" class="form-label">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" name="start-date">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                            <label for="" class="form-label">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" name="end-date" value="">
                        </div>
                    </fieldset>
                   <fieldset class="w-100 mt-4 ">
                        <div class="d-flex flex-nowrap w-100">
                            <h4>Buku</h4>
                            <button id="btn-add" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-auto">
                                <i class="fas fa-plus fa-sm text-white-50"></i> 
                                Tambah
                            </button>
                        </div>
                        <table id="book-form" class="table table-sm w-100">
                            <thead class="bg-primary text-white d-none d-lg-table-head">
                                <tr>
                                    <th style="width: 40%">Judul</th>
                                    <th>Jumlah</th>
                                    <th>Tgl Kembali</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" name="book[0][title]"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                   </fieldset>
                </form>
            </div>

        </div>
    </div>
</div>



<?php $this->stop() ?>

<!-- JS SECTION -->
<?php $this->start('js') ?>
<script src="<?=$this->e(base_url('assets/vendor/jstree/dist/jstree.min.js'))?>"></script>
<script src="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js'))?>"></script>
<script src="<?=$this->e(base_url('assets/pages/bookOrder.js'))?>"></script>

<?php $this->stop() ?>