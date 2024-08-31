<div class="modal fade" id="modalTambahDelegasi" role="dialog" aria-labelledby="modalTambahDelegasiLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row bg-primer mt-0 pt-0 border-kuning">
                    <div class="col-12">
                        <h4 class="pt-3 pb-2 text-center text-white"><b>Atur Delegasi</b></h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <p class="mb-3 card-subtitle">
                            Cari berdasarkan
                            <mark>
                                <code>uniid</code>
                            </mark> atau
                            <mark>
                                <code>nama</code>
                            </mark>
                        </p>
                        <form action="/kepala/dinamis/cari_pengguna_delegasi" class="formcaridelegasi" method="post">
                            <div class="input-group">
                                <input type="text" name="key" class="form-control" placeholder="uniid / nama pengguna" aria-label="Cari uniid / nama" aria-describedby="basic-addon2">
                                <button class="btn bg-primary-subtle text-primary rounded-end btn-cari" type="submit">
                                    cari ...
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <p class="mb-3 card-subtitle">
                            Hasil pencarian
                        </p>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>UniID</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="body-table">
                                <tr>
                                    <td colspan="3"><i>Tidak ada data</i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" onclick="btnCloseModal()">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.formcaridelegasi').submit(function(e) {
        e.preventDefault();
        // alert($(this).serialize());
        // return false;
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
                $('.btn-cari').html('cari ...');
            },
            success: function(response) {
                $(".body-table").html(response.tr);
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