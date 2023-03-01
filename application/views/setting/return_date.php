<?php $this->layout('setting::index', ['title' => 'Pengaturan']) ?>


<?php $this->start('setting_pages') ?>
<div class="row justify-content-center mt-4">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="text-white font-weight-bold text-shadow">Jatuh Tempo Pengembalian</h4>
            </div>
            <form class="card-body">
                <div class="form-row">
                    <div class="col-4">
                        <label class="form-label mb-0">Nilai</label>
                        <select name="value" class="form-control">
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="col-1 d-flex flex-nowrap justify-content-center align-items-center"><span class="mt-4">-</span></div>
                    <div class="col-7">
                        <label class="form-label mb-0">Unit</label>
                        <select name="unit" class="form-control">
                            <option value="week">Minggu</option>
                        </select>
                    </div>
                </div>    
            </form>
        </div>

    </div>
</div>
<?php $this->stop() ?>