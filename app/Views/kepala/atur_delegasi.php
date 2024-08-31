<?= $this->extend("/template/horizontal.php"); ?>

<?= $this->section("css"); ?>
<link rel="stylesheet" href="<?= base_url(); ?>/pro/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
<?= $this->endSection(); ?>

<?= $this->section("konten"); ?>
<div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Atur Delegasi</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <span><?= $lembaga_user["nama_lembaga"]; ?> (<?= $lembaga_user["nama_singkat"]; ?>)</span>
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
            <div class="row justify-content-between">
                <div class="col-auto">
                    <p class="card-subtitle mb-3">
                        Daftar delegasi <?= $lembaga_user["nama_lembaga"]; ?> (<?= $lembaga_user["nama_singkat"]; ?>).
                    </p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-warning btn-tambah"><i class="fas fa-calendar-plus"></i> | Tambah Delegasi</button>
                </div>
            </div>

            <div class="table-responsive">
                <table id="zero_config" class="table table-sm table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th class="text-white" style="background-color: #2f3184;">#</th>
                            <th class="text-white" style="background-color: #2f3184;">Uniq Id</th>
                            <th class="text-white" style="background-color: #2f3184;">Nama</th>
                            <th class="text-white" style="background-color: #2f3184;">Lembaga</th>
                            <th class="text-white" style="background-color: #2f3184;">Tgl Didelegasikan</th>
                            <th class="text-white" style="background-color: #2f3184;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($daftar_delegasi as $key => $e) { ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $e["uniid_penjabat"]; ?></td>
                                <td><?= $e["nama_penjabat"]; ?></td>
                                <td><?= $e["nama_lembaga"]; ?></td>
                                <td><?= $e["tgl_delegasi"]; ?></td>
                                <td class="text-center"><button class="btn btn-sm btn-danger" value="<?= $e["idjabatan"]; ?>" onclick="deleteDelegasi(this.value)"><i class="fas fa-trash"></i></button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modaltambah"></div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        // view modal tambah agenda
        $(".btn-tambah").click(function() {
            $.ajax({
                url: "<?= site_url('kepala/dinamis/modal_tambah_delegasi'); ?>",
                type: "POST",
                dataType: "json",
                data: {
                    key: "1",
                },
                beforeSend: function() {},
                complete: function() {},
                success: function(response) {
                    $(".modaltambah").html(response.modal);
                    $("#modalTambahDelegasi").modal("show");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>

<script>
    function addDelegasi(uniid) {
        $.ajax({
            url: "<?= site_url('kepala/do_delegasikan'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                uniid: uniid,
            },
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {
                if (response.status == true) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: response.pesan,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal',
                        text: response.pesan,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    }

    function deleteDelegasi(idjabatan) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Ingin menghapus delegasi ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Iya, hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                // var csrfName = 'csrf_test_name'; // CSRF Token name
                // var csrfHash = $("input[name='csrf_test_name']").val(); // CSRF hash
                $.ajax({
                    url: "<?= site_url('kepala/do_hapus_delegasi'); ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        idjabatan: idjabatan
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