<?=$this->extend('themes/'.config('site')->themes.'/default')?>

<?=$this->section('content')?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?=$title_page?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="card-text " id="viewdata">

                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->


<!-- Page specific script -->
<script>
function dataDetil() {
    $.ajax({
        url: "<?=site_url('spd/listData')?>",
        dataType: "json",
        success: function(response) {
            $('#viewdata').html(response.buka_tabel + response.isi_tabel + response.tutup_tabel);

            $("#tabeldata").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                'ordering': false,
            });

        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}


function ubahSpd(id) {
    $.ajax({
        type: "post",
        url: "<?=site_url('spd/formEdit')?>",
        data: {
            id: id
        },
        dataType: "json",

        success: function(response) {
            if (response.sukses) {
                $('.viewmodal').html(response.sukses).show();
                $('#modaledit').modal('show');
            }
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },

    });
}

function hapusSpd(id) {
    Swal.fire({
        title: 'Konfirmasi Penghapusan [ID=' + id + ']',
        text: 'Data yang dihapus tidak bisa dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'

    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "<?=site_url('spd/hapus/')?>" + id,
                data: {
                    id: id
                },
                dataType: "json",

                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data telah dihapus',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                    dataDetil();
                },

                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },

            });
        }
    })
}

$(document).ready(function() {
    dataDetil();
});
</script>

<?=$this->endSection()?>