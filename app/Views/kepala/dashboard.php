<?= $this->extend("/template/horizontal.php"); ?>

<?= $this->section("css"); ?>
<link rel="stylesheet" href="<?= base_url(); ?>/pro/assets/libs/quill/dist/quill.snow.css">
<link rel="stylesheet" href="<?= base_url(); ?>/pro/assets/libs/select2/dist/css/select2.min.css">
<style>
    .select2-container--default .select2-dropdown {
        z-index: 1060;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section("konten"); ?>
<?php
$ss = \Config\Services::session();
$session = $ss->get("userdata");
?>
<div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <div class="d-flex align-items-center gap-4 mb-4">
                    <div class="position-relative">
                        <div class="border border-2 border-warning rounded-circle">
                            <img src="<?= base_url(); ?>/pro/assets/images/profile/user-1.jpg" class="rounded-circle m-1" alt="user1" width="60">
                        </div>
                        <!-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-primary"> 3
                            <span class="visually-hidden">unread messages</span>
                        </span> -->
                    </div>
                    <div>
                        <h3 class="fw-semibold">Assalaamu'alaykum, <b class="text-primer"><?= $session["nama_gelar"]; ?></b>
                        </h3>
                        <span>Jabatan : <b class="text-primer"><?= $session["jabatan"] == 1 ? $session["nama_jabatan"] : '-'; ?></b> <br> Unit : <b class="text-primer"><?= $row_lembaga["nama_lembaga"]; ?></b></span>
                        <br>
                        <?php
                        $ex = explode(" ", $hari_tanggal);
                        $tanggal = $ex[0] . " " . $ex[1] . " " . $ex[2] . " " . $ex[3];
                        ?>
                        <span class="text-primer"><strong><?= $tanggal; ?></strong></span> <br>
                    </div>
                </div>
                <!-- <h4 class="fw-semibold mb-8">Assalaamu'alaykum, <b class="text-primer"><?= $session["nama_gelar"]; ?></b></h4>
                <hr>
                <span>Jabatan : <b class="text-primer"><?= $session["jabatan"] == 1 ? $session["nama_jabatan"] : '-'; ?></b> <br> Unit : <b class="text-primer"><?= $row_lembaga["nama_lembaga"]; ?></b></span> -->
                <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="#">Calendar</a>
                        </li>
                    </ol>
                </nav> -->
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                    <img src="<?= base_url(); ?>/pro/assets/images/breadcrumb/ChatBc.png" alt="modernize-img" class="img-fluid mb-n4" />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-12">
        <div class="row">
            <div class="col-lg-12">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden bg-primer">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold text-white">Filter Unit</h5>
                        <div class="row align-items-center">
                            <div class="col-12 mb-2">
                                <select class="form-select bg-primer text-white" id="jenis_unit">
                                    <option value="all">Semua Jenis Unit</option>
                                    <?php foreach ($jenis_unit as $key => $jn) { ?>
                                        <option <?= $jn["id_jenis_unit"] == $row_lembaga["type"] ? 'selected' : ''; ?> value="<?= $jn["id_jenis_unit"]; ?>"><?= $jn["ket_jenis_unit"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <select class="form-select bg-primer text-white" id="unit">
                                    <option value="all">Semua Unit</option>
                                    <?php foreach ($all_lembaga as $key => $lmbg) { ?>
                                        <option <?= $lmbg["idlembaga"] == $idlembaga_user ? 'selected' : ''; ?> value="<?= $lmbg["idlembaga"]; ?>"><?= $lmbg["nama_lembaga"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <!-- Monthly Earnings -->
                <div class="card" style="background-color: #2f3184">
                    <div class="card-body">
                        <div class="row alig n-items-start">
                            <div class="col-12">
                                <h5 class="card-title mb-9 fw-semibold text-white"> Jenis Agenda </h5>
                                <div class="col-12 mb-2">
                                    <select class="form-select text-white bg-primer" id="jenis_agenda">
                                        <option value="all" selected>Semua Jenis Agenda</option>
                                        <?php foreach ($jenis_agenda as $key => $ja) { ?>
                                            <option value="<?= $ja["idjenis"]; ?>"><?= $ja["ket_jenis"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <select class="form-select text-white bg-primer" id="prioritas_agenda">
                                        <option value="all" selected>Semua Tingkat Kepentingan</option>
                                        <option value="1">Sangat Penting</option>
                                        <option value="2">Penting</option>
                                        <option value="3">Kurang Penting</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="earning"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9 com-sm-12">
        <div class="row">
            <!-- kiri -->
            <div class="col-lg-12  align-items-strech">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Agenda UMS</h5>
                            </div>
                            <?php if ($session["jabatan"] == 1) { ?>
                                <div class="mb-3 mb-sm-0">
                                    <button class="btn btn-md btn-primary btn-tambah-agenda"><i class="fas fa-calendar-plus"></i> | Tambah Agenda</button>
                                </div>
                            <?php } ?>
                        </div>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
            <!-- kanan -->
        </div>
    </div>

</div>

<div class="modaltambah"></div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        // view modal tambah agenda
        $(".btn-tambah-agenda").click(function() {
            $.ajax({
                url: "<?= site_url('kepala/dinamis/modal_tambah_agenda'); ?>",
                type: "POST",
                dataType: "json",
                data: {
                    id: "1",
                },
                beforeSend: function() {},
                complete: function() {},
                success: function(response) {
                    $(".modaltambah").html(response.modal);
                    $("#modalTambahAgenda").modal("show");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });

        // jenis unit change function
        $('#jenis_unit').change(function() {
            var selectedValue = $(this).val();
            $.ajax({
                url: "<?= site_url('umum/dinamis/dashboard_jenis_unit_change'); ?>",
                type: "POST",
                dataType: "json",
                data: {
                    type: selectedValue,
                },
                beforeSend: function() {},
                complete: function() {},
                success: function(response) {
                    $("#unit").html(response.opt);

                    //refresh calendar
                    var type = $("#jenis_unit").val();
                    var unit = $("#unit").val();
                    var jenis_agenda = $("#jenis_agenda").val();
                    var prioritas_agenda = $("#prioritas_agenda").val();
                    Calendar(type, unit, jenis_agenda, prioritas_agenda);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });

        $('#unit').change(function() {
            //refresh calendar
            refreshCalendar();
        });

        $('#jenis_agenda').change(function() {
            //refresh calendar
            refreshCalendar();
        });

        $('#prioritas_agenda').change(function() {
            //refresh calendar
            refreshCalendar();
        });
    });

    function refreshCalendar() {
        var type = $("#jenis_unit").val();
        var unit = $("#unit").val();
        var jenis_agenda = $("#jenis_agenda").val();
        var prioritas_agenda = $("#prioritas_agenda").val();
        Calendar(type, unit, jenis_agenda, prioritas_agenda);
    }

    document.addEventListener('DOMContentLoaded', function() {
        var type = $("#jenis_unit").val();
        var unit = $("#unit").val();
        Calendar(type, unit, "all", "all");
    });
</script>

<script>
    function Calendar(type = "all", unit = "all", jenis_agenda = "all", prioritas_agenda = "all") {
        var calendarEl = document.getElementById('calendar');
        $.ajax({
            url: "<?= site_url('umum/dinamis/load_events'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                type: type,
                unit: unit,
                jenis_agenda: jenis_agenda,
                prioritas_agenda: prioritas_agenda
            },
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    eventClick: function(info) {
                        var eventObj = info.event;
                        $.ajax({
                            url: "<?= site_url('kepala/dinamis/modal_view_agenda'); ?>",
                            type: "POST",
                            dataType: "json",
                            data: {
                                id: eventObj.id,
                            },
                            beforeSend: function() {},
                            complete: function() {},
                            success: function(response) {
                                $(".modaltambah").html(response.modal);
                                $("#modalViewAgenda").modal("show");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                            }
                        });
                        return false;
                    },
                    timeZone: 'Asia/Jakarta',
                    initialView: 'dayGridYear',
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'dayGridYear,dayGridWeek,dayGridDay'
                    },
                    editable: true,
                    events: response.events
                });
                calendar.render();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    }

    function editAgenda(idevent) {
        $(".modal").modal("hide");
        $(".modaltambah").html("Loading modal edit...");
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
                $(".modaltambah").html(response.modal);
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

<!-- <?= $this->section("js_section"); ?>
<script src="<?= base_url(); ?>/pro/assets/libs/quill/dist/quill.min.js"></script>
<script src="<?= base_url(); ?>/pro/assets/js/forms/quill-init.js"></script>
<?= $this->endSection(); ?> -->