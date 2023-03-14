<!-- Modal -->
<div class="modal fade" id="modaltambah" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?= view('Myth\Auth\Views\_message_block') ?>

            <form action="<?= url_to('register') ?>" method="post">
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username"><?=lang('Auth.username')?></label>
                                <input type="text"
                                    class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>"
                                    name="username" placeholder="<?=lang('Auth.username')?>"
                                    value="<?= old('username') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"><?=lang('Auth.email')?></label>
                                <input type="email"
                                    class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                                    name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>"
                                    value="<?= old('email') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password"><?=lang('Auth.password')?></label>
                                <input type="password" name="password"
                                    class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                                    placeholder="<?=lang('Auth.password')?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass_confirm"><?=lang('Auth.repeatPassword')?></label>
                                <input type="password" name="pass_confirm"
                                    class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
                                    placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary "><?=lang('Auth.register')?></button>
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Batal</button>
                </div>
                <?=form_close()?>
        </div>
    </div>
</div>

<script>
function dataKlompeg() {
    $('#klompeg').change(function(e) {
        if ($('#klompeg').val().length === 0) {
            $('#subbag').html('');
            $('#jabatan').html('');
        } else {
            $.ajax({
                type: "post",
                url: "<?= site_url('chaindata/ambilDataKlompeg')?>",
                data: {
                    klompeg: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    if (response.dataSubbag) {
                        $('#subbag').html(response.dataSubbag);
                        $('#subbag').select();
                    }

                    if (response.dataJabatan) {
                        $('#jabatan').html(response.dataJabatan);
                        $('#jabatan').select();
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
            });
        }

    });

}




$('.formpegawai').submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: "post",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",

        beforeSend: function() {
            $('.btnsimpan').attr('disable', 'disabled');
            $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
        },

        complete: function() {
            $('.btnsimpan').removeAttr('disable');
            $('.btnsimpan').html('Simpan');
        },

        success: function(response) {
            if (response.error) {
                if (response.error.nama) {
                    $('#nama').addClass('is-invalid');
                    $('.error_nama').html(response.error.nama)
                } else {
                    $('#nama').removeClass('is-invalid');
                    $('.error_nama').html()
                }

                if (response.error.klompeg) {
                    $('#klompeg').addClass('is-invalid');
                    $('.error_klompeg').html(response.error.klompeg)
                } else {
                    $('#klompeg').removeClass('is-invalid');
                    $('.error_klompeg').html()
                }

                if (response.error.setkom) {
                    $('#setkom').addClass('is-invalid');
                    $('.error_setkom').html(response.error.setkom)
                } else {
                    $('#setkom').removeClass('is-invalid');
                    $('.error_setkom').html()
                }

                if (response.error.subbag) {
                    $('#subbag').addClass('is-invalid');
                    $('.error_subbag').html(response.error.subbag)
                } else {
                    $('#subbag').removeClass('is-invalid');
                    $('.error_subbag').html()
                }

                if (response.error.jabatan) {
                    $('#jabatan').addClass('is-invalid');
                    $('.error_jabatan').html(response.error.jabatan)
                } else {
                    $('#jabatan').removeClass('is-invalid');
                    $('.error_jabatan').html()
                }

            } else {
                Swal.fire({
                    icon: 'success',
                    title: response.sukses,
                    showConfirmButton: false,
                    timer: 1500
                });

                $('#modaltambah').modal('hide');
                datapegawai();
            }
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },

    });

    return false;

})

$(document).ready(function() {
    dataKlompeg();
    $('.select2').select2()
});
</script>