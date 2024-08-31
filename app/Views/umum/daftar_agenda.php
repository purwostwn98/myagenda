<?= $this->extend("/template/horizontal.php"); ?>

<?= $this->section("css"); ?>
<link rel="stylesheet" href="<?= base_url(); ?>/pro/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
<?= $this->endSection(); ?>

<?= $this->section("konten"); ?>
<div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Daftar Agenda</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <span><?= $lembaga_user["nama_lembaga"]; ?></span>
                    </ol>
                </nav>
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                    <img src="<?= base_url(); ?>/pro/assets/images/breadcrumb/ChatBc.png" alt="modernize-img" class="img-fluid mb-n4" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="datatables">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Agenda dalam 30 hari yang akan datang</h4>
            <p class="card-subtitle mb-3">
                Tabel ini berisi daftar agenda dalam 30 hari yang akan datang.
            </p>
            <div class="table-responsive">
                <table id="zero_config" class="table table-sm table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th class="text-white" style="background-color: #2f3184;">#</th>
                            <th class="text-white" style="background-color: #2f3184;">Mulai</th>
                            <th class="text-white" style="background-color: #2f3184;">Selesai</th>
                            <th class="text-white" style="background-color: #2f3184;">Nama Agenda</th>
                            <th class="text-white" style="background-color: #2f3184;">Tempat</th>
                            <th class="text-white" style="background-color: #2f3184;">Bidang Kegiatan</th>
                            <th class="text-white" style="background-color: #2f3184;">Bentuk Kegiatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($event as $key => $e) { ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $e["start"]; ?></td>
                                <td><?= $e["end"]; ?></td>
                                <td><?= $e["title"]; ?></td>
                                <td><?= $e["tempat_event"]; ?></td>
                                <td><?= $e["ket_jenis"]; ?></td>
                                <td><?= $e["ket_bentuk"]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<?= $this->endSection(); ?>
<?= $this->section("js_section"); ?>
<script src="<?= base_url(); ?>/pro/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/pro/assets/js/datatable/datatable-basic.init.js"></script>
<?= $this->endSection(); ?>