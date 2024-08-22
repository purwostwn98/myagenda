<div class="modal fade" id="modalViewAgenda" role="dialog" aria-labelledby="modalTambahAgendaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row bg-primer mt-0 pt-0 border-kuning">
                    <div class="col-12">
                        <h4 class="pt-3 pb-2 text-center text-white"><b><i>Detail</i> Agenda</b></h4>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">Nama Agenda</span>
                    </div>
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">: <b><?= $event["title"]; ?></b></span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">Tempat</span>
                    </div>
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">: <b><?= $event["tempat_event"]; ?></b></span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">Tanggal mulai</span>
                    </div>
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">: <?= $tgl_mulai; ?></span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">Tanggal selesai</span>
                    </div>
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">: <?= $tgl_selesai; ?></span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">Unit</span>
                    </div>
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">: <b><?= $event["nama_lembaga"]; ?></b></span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">Bidang Kegiatan</span>
                    </div>
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">: <?= $event["ket_jenis"]; ?></span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">Bentuk Kegiatan</span>
                    </div>
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">: <?= $event["ket_bentuk"]; ?></span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-5">
                        <span for="perserta" class="text-primer mt-3">Peserta Agenda</span>
                    </div>
                    <div class="col-lg-5">
                        <span for="perserta" class="text-primer mt-3">:
                            <?php foreach ($jenis_peserta as $key => $v) { ?>
                                <span class="mb-1 badge text-bg-primary"><?= $v["ket_peserta"]; ?></span>
                            <?php } ?>
                        </span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">Deskripsi Agenda</span>
                    </div>
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">: </span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card" style="background-color: #FEF4CD;">
                            <div class="card-body">
                                <?= $event["deskripsi"]; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">Link Informasi Eksternal</span>
                    </div>
                    <div class="col-lg-5">
                        <i for="agendaname" class="text-primer mt-3">: <a target="_blank" href="<?= $event["link_eksternal"]; ?>"><?= $event["link_eksternal"]; ?></a></i>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">Prioritas di Unit</span>
                    </div>
                    <div class="col-lg-5">
                        <span for="agendaname" class="text-primer mt-3">:
                            <?php
                            if ($event["prioritas_event"] == 1) {
                                echo "Sangat Penting";
                            } elseif ($event["prioritas_event"] == 2) {
                                echo "Penting";
                            } else {
                                echo "Kurang Penting";
                            }
                            ?>
                        </span>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-12">
                        <span class="" style="font-size: small;">Dibuat oleh: <?= $event["nama_gelar"]; ?></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="btnCloseModal()">Close</button>
                <?php if ($idlembaga_user == $event["idlembaga"] && $jabatan == 1) { ?>
                    <button type="button" onclick="hapusAgenda('<?= $event['idevent']; ?>')" class="btn text-white btndaftar btn-danger"><i class="fas fa-eraser"></i> | Hapus</button>
                    <button type="button" onclick="editAgenda('<?= $event['idevent']; ?>')" class="btn text-white btndaftar btn-warning"><i class="fas fa-shapes"></i> | Edit Agenda</button>
                <?php  } ?>
            </div>
        </div>
    </div>
</div>