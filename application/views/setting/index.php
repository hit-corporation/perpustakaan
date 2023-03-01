<?php $this->layout('layouts::main_template', ['title' => 'Pengaturan']) ?>

<?php $this->start('css') ?>

<style>
    .vh-75 {
        height: 75vh;
    }
</style>
<?php $this->stop() ?>

<?php $this->start('contents') ?>

<div class="container-fluid vh-75">
    <nav class="nav">
        <a class="nav-link" href="<?=base_url('setting/return_date')?>"><i class="fas fa-calendar-times"></i> Jatuh Tempo</a>
        <a class="nav-link" href="<?=base_url('setting/penalty')?>"><i class="fas fa-calendar-times"></i> Denda</a>
    </nav>
    <?=$this->section('setting_pages')?>
</div>

<?php $this->stop() ?>

<?php $this->start('js') ?>
<?php $this->stop() ?>