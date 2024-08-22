<div class="modal fade" id="modalEditAgenda" role="dialog" aria-labelledby="modalEditAgendaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="/kepala/do-edit-agenda" class="formeditagenda" method="post">
                <input type="hidden" value="<?= csrf_hash(); ?>" name="<?= csrf_token(); ?>" id="csrf">
                <div class="modal-body">
                    <div class="row bg-primer mt-0 pt-0 border-kuning">
                        <div class="col-12">
                            <h4 class="pt-3 pb-2 text-center text-white"><b><i>Edit</i> Agenda</b></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="agendaname" class="text-primer mt-3"><b>Nama Agenda:</b></label>
                                <input type="text" class="form-control" name="title" id="agendaname" value="<?= $event["title"]; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="tg_mulai" class="text-primer mt-2"><b>Tanggal Mulai:</b></label>
                                <input type="datetime-local" class="form-control" name="start" id="tg_mulai" value="<?= $event["start"]; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="tg_selesai" class="text-primer mt-2"><b>Tanggal Selesai:</b></label>
                                <input type="datetime-local" class="form-control" name="end" id="tg_selesai" value="<?= $event["end"]; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="tempat" class="text-primer mt-3"><b>Tempat:</b></label>
                                <input type="text" class="form-control" name="tempat_event" id="tempat" value="<?= $event["tempat_event"]; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="selSertif" class="text-primer mt-2"><b>Unit Penyelenggara:</b></label>
                                <select class="form-control" id="selSertif" disabled>
                                    <option value="" disabled></option>
                                    <?php foreach ($units as $key => $u) { ?>
                                        <option <?= $u["idlembaga"] == $event["idlembaga"] ? 'selected' : ''; ?> value="<?= $u["idlembaga"]; ?>"><?= $u["nama_lembaga"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jenisEvent" class="text-primer mt-2"><b>Bidang Kegiatan:</b></label>
                                <select class="form-control" name="idjenis" id="jenisEvent">
                                    <option value="" disabled></option>
                                    <?php foreach ($jenis_event as $key => $j) { ?>
                                        <option <?= $j["idjenis"] == $event["idjenis"] ? 'selected' : ''; ?> value="<?= $j["idjenis"]; ?>"><?= $j["ket_jenis"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jenisEvent" class="text-primer mt-2"><b>Bentuk Kegiatan:</b></label>
                                <select class="form-control" name="bentuk_kegiatan" id="jenisEvent">
                                    <option value="" disabled></option>
                                    <?php foreach ($bentuk_kegiatan as $key => $j) { ?>
                                        <option <?= $j["id_bentuk_kegiatan"] == $event["bentuk_kegiatan"] ? 'selected' : ''; ?> value="<?= $j["id_bentuk_kegiatan"]; ?>"><?= $j["ket_bentuk"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="editor" class="text-primer mt-2"><b>Deskripsi:</b></label>
                                <input type="hidden" name="deskripsi" id="editor-value">
                                <!-- Create the editor container -->
                                <div id="editor" name="deskripsi">
                                    <?= $event["deskripsi"]; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="link" class="text-primer mt-2"><b>Informasi dari link external:</b></label>
                                <input type="text" class="form-control" name="link_eksternal" id="link" placeholder="Contoh : https:://ums.ac.id/agenda1" value="<?= $event["link_eksternal"]; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="link" class="text-primer mt-2"><b>Peserta:</b></label>
                                <select class="select2 form-control" multiple="multiple" name="id_jnspeserta[]">
                                    <?php foreach ($jenis_peserta as $key => $j) { ?>
                                        <option <?= in_array($j["id_jnspeserta"], $peserta) ? 'selected' : ''; ?> value="<?= $j["id_jnspeserta"]; ?>"><?= $j["ket_peserta"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prioritas" class="text-primer mt-2"><b>Prioritas Agenda:</b></label>
                                <select class="form-control" name="prioritas_event" id="prioritas">
                                    <option value="" selected disabled></option>
                                    <option <?= $event["prioritas_event"] == 1 ? 'selected' : ''; ?> value="1">Sangat Penting</option>
                                    <option <?= $event["prioritas_event"] == 2 ? 'selected' : ''; ?> value="2">Penting</option>
                                    <option <?= $event["prioritas_event"] == 3 ? 'selected' : ''; ?> value="3">Kurang Penting</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idevent" id="idd" value="<?= $event["idevent"]; ?>">
                    <button type="button" class="btn btn-warning" onclick="btnCloseModal()">Close</button>
                    <button type="submit" class="btn btn-primary btndaftar">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.formeditagenda').submit(function(e) {
        e.preventDefault();
        var html = quill.root.innerHTML;
        $("#editor-value").val(html);
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btndaftar').prop('disabled', true);
                $('.btndaftar').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btndaftar').prop('disabled', false);
                $('.btndaftar').html('Simpan');
            },
            success: function(response) {
                if (response.status == true) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: response.pesan,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $(".modal").modal("hide");
                        refreshCalendar();
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal',
                        text: response.pesan,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
                $("input[name='csrf_test_name']").val(response.token);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    });
</script>

<script src="<?= base_url(); ?>/pro/assets/libs/quill/dist/quill.min.js"></script>
<script src="<?= base_url(); ?>/pro/assets/js/forms/quill-init.js"></script>
<!-- select2 -->
<script src="<?= base_url(); ?>/pro/assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/pro/assets/libs/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url(); ?>/pro/assets/js/forms/select2.init.js"></script>