<!-- Modal -->
<div class="modal fade " id="modaledit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?=form_open('suers/updateData/'.$id, ['class'=>'form'])?>
            <?=csrf_field();?>

            <div class="modal-header">
                <h5 class="modal-title">Edit Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username*</label>
                            <input name="username" id="username" type="text" class="form-control" value="<?=$username?>"
                                readonly>
                            <div class="invalid-feedback error_username"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Level User*</label>
                            <select name="level" id="level" class="form-control">
                                <option value="admin">Administrastor </option>
                                <option value="operator">Operator</option>
                                <option value="viewer">Viewer </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pejabat Pemberi Tugas*</label>
                            <select name="setkom" id="setkom" class="form-control ">
                                <option value="ketua" <?= ($setkom == 'ketua') ? 'selected' :'' ?>>Ketua</option>
                                <option value="sekretaris" <?= ($setkom == 'sekretaris') ? 'selected' :'' ?>>
                                    Sekretaris</option>
                            </select>
                            <div class="invalid-feedback error_setkom"> </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                <label>Password*</label>
                                <input name="Password" id="Password" type="text" class="form-control"
                                    value="<?=$password?>" readonly>
                                <div class="invalid-feedback error_Password"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pejabat Pemberi Tugas*</label>
                                <select name="setkom" id="setkom" class="form-control ">
                                    <option value="ketua" <?= ($setkom == 'ketua') ? 'selected' :'' ?>>Ketua</option>
                                    <option value="sekretaris" <?= ($setkom == 'sekretaris') ? 'selected' :'' ?>>
                                        Sekretaris</option>
                                </select>
                                <div class="invalid-feedback error_setkom"> </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="aktif" id="aktif" class="form-control select">
                                    <option value="1" <?=$aktif==1?'selected':''?>>Aktif</option>
                                    <option value="0" <?=$aktif==0?'selected':''?>>Non Aktif</option>
                                </select>
                                <div class="invalid-feedback error_aktif"> </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnsimpan">Update</button>
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Batal</button>
                </div>
                <?=form_close()?>
            </div>
        </div>
    </div>


    <script>
    $('.form').submit(function(e) {
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
                $('.btnsimpan').html('Update');
            },

            success: function(response) {
                if (response.error) {
                    if (response.error.username) {
                        $('#username').addClass('is-invalid');
                        $('.error_username').html(response.error.username)
                    } else {
                        $('#username').removeClass('is-invalid');
                        $('.error_username').html()
                    }


                    if (response.error.password) {
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
                    // alert(response.sukses);
                    Swal.fire({
                        icon: 'success',
                        title: response.sukses,
                        showConfirmButton: false,
                        timer: 1400
                    })

                    $('#modaledit').modal('hide');
                    datapegawai();
                }
            },

            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });

        return false;

    });

    $(document).ready(function() {
        dataKlompeg();
    });
    </script>