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
                <div class="breadcrumb float-sm-right">
                    <a href="<?=site_url('surattugas/tambah')?>" type="button" class="btn btn-primary tomboltambah"><i
                            class="fa fa-plus-circle"></i> Tambah</a>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-2" id="viewdata">

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->


<!-- Page specific script -->
<script>
function datasurattugas() {
    $.ajax({
        url: "<?=site_url('surattugas/listData')?>",
        dataType: "json",
        success: function(response) {
            $('#viewdata').html(response.buka_tabel + response.isi_tabel + response.tutup_tabel);

            $("#tabeldata").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                'ordering': false,

                "buttons": ["copy", "print"]
            });

        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

function hapus(id_st) {
    Swal.fire({
        title: 'Konfirmasi Penghapusan [ID=' + id_st + ']',
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
                url: "<?=site_url('surattugas/hapusdata/')?>" + id_st,
                data: {
                    id_st: id_st
                },
                dataType: "json",

                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: response.sukses,
                            showConfirmButton: false,
                            timer: 1400
                        })
                    }
                    datasurattugas();
                },

                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },

            });
        }
    })
}

function edit(id) {
    $.ajax({
        type: "post",
        url: "<?=site_url('surattugas/edit')?>",
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

$(document).ready(function() {
    datasurattugas();
});
</script>

<?=$this->endSection()?>