<?= $this->extend("/template/horizontal.php"); ?>


<?= $this->section("css"); ?>
<link rel="stylesheet" href="<?= base_url(); ?>/pro/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="<?= base_url(); ?>/pro/assets/libs/quill/dist/quill.snow.css">
<link rel="stylesheet" href="<?= base_url(); ?>/pro/assets/libs/select2/dist/css/select2.min.css">
<style>
    .select2-container--default .select2-dropdown {
        z-index: 1060;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section("konten"); ?>
<div class="card bg-info-subtle overflow-hidden shadow-none">
    <div class="card-body py-3">
        <div class="row justify-content-between align-items-center">
            <div class="col-sm-6 col-md-8">
                <h5 class="fw-semibold mb-9 fs-5">Cari agenda di UMS</h5>
                <p class="mb-9">
                    Masukkan nama agenda dan waktu pelaksanaan (sudah berlalu atau yang akan datang)
                </p>
                <form action="/umum/dinamis/load_hasil_cari_agendaums" class="formcari" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" placeholder="nama agenda ..." name="key">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group mb-3">
                                    <select class="form-select mr-sm-2" id="inlineFormCustomSelect" name="waktu">
                                        <option value="1">yang akan datang</option>
                                        <option value="2">sudah berlalu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info bg-primer btn-cari"><i class="ti ti-search"></i> <i>Search</i></button>
                </form>
            </div>
            <div class="col-sm-5 col-md-3">
                <div class="position-relative mb-n5 text-center">
                    <img src="<?= base_url(); ?>/pro/assets/images/backgrounds/track-bg.png" alt="modernize-img" class="img-fluid" width="180" height="230">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h5 class="text-primer text-center"><b>Hasil Pencarian</b></h5>
    </div>
</div>
<div class="tab-content">
    <div id="note-full-container" class="note-has-grid row hasil-cari">

    </div>
</div>

<!-- <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Agenda</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <span>Universitas Muhammadiyah Surakarta</span>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> -->
<div class="modaldetail"></div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script type="text/javascript">
    $('.formcari').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btn-cari').prop('disabled', true);
                $('.btn-cari').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btn-cari').prop('disabled', false);
                $('.btn-cari').html('<i class="ti ti-search"></i> <i>Search</i>');
            },
            success: function(response) {
                $(".hasil-cari").html(response.view);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    });
</script>
<script>
    function detailEvent(id) {
        $.ajax({
            url: "<?= site_url('kepala/dinamis/modal_view_agenda'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                id: id,
            },
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {
                $(".modaldetail").html(response.modal);
                $("#modalViewAgenda").modal("show");
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    }

    function editAgenda(idevent) {
        $(".modal").modal("hide");
        $(".modaldetail").html("Loading modal edit...");
        $.ajax({
            url: "<?= site_url('kepala/dinamis/modal_edit_agenda'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                idevent: idevent,
            },
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {
                $(".modaldetail").html(response.modal);
                $("#modalEditAgenda").modal("show");
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    }

    function hapusAgenda(idevent) {

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Ingin menghapus agenda ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // var csrfName = 'csrf_test_name'; // CSRF Token name
                // var csrfHash = $("input[name='csrf_test_name']").val(); // CSRF hash
                $.ajax({
                    url: "<?= site_url('kepala/do-hapus-agenda'); ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: idevent
                        // [csrfName]: csrfHash
                    },
                    beforeSend: function() {},
                    complete: function() {},
                    success: function(response) {
                        if (response.success == true) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: response.pesan,
                                icon: "success"
                            }).then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: "Gagal!",
                                text: response.pesan,
                                icon: "error"
                            }).then((result) => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
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