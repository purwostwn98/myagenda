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
            <h4 class="card-title">Agenda yang akan datang</h4>
            <!-- <p class="card-subtitle mb-3">
                Tabel ini berisi daftar agenda dalam 30 hari yang akan datang.
            </p> -->
            <div class="form-group mb-4">
                <label class="mr-sm-2" for="inlineFormCustomSelect">Pilih range waktu:</label>
                <select class="form-select mr-sm-2" id="inlineFormCustomSelect">
                    <option value="7">1 minggu yang akan datang</option>
                    <option value="14">2 minggu yang akan datang</option>
                    <option selected value="30">1 bulan yang akan datang</option>
                    <option value="90">3 bulan yang akan datang</option>
                    <option value="180">6 bulan yang akan datang</option>
                    <option value="365">1 tahun yang akan datang</option>
                </select>
            </div>
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
                    <tbody class="trkonten">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        loadTable();

        $('#inlineFormCustomSelect').change(function() {
            loadTable();
        });
    });
</script>
<script>
    function loadTable() {
        var range = $("#inlineFormCustomSelect").val();
        $.ajax({
            url: "<?= site_url('umum/dinamis/tr_agenda_unit'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                range: range,
            },
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {
                $(".trkonten").html(response.tr);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    }
</script>
<?= $this->endSection(); ?>
<?= $this->section("js_section"); ?>
<script src="<?= base_url(); ?>/pro/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/pro/assets/js/datatable/datatable-basic.init.js"></script>
<?= $this->endSection(); ?>