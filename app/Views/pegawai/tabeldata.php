<table id="tabeldata" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Klompeg/Kelompok</th>
            <th>Subbag/Divisi</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
    $nomor=0;
    foreach($tampildata as $row):
        $nomor++;
    ?>
        <tr>
            <td><?=$nomor;?></td>
            <td>
                <?=$row['nama']?> <br>
                <?=$row['aktif']==1?'<span class="badge badge-success">Aktif</span>':'<span class="badge badge-danger">Non-Aktif</span>'?>
            </td>
            <td><?=$row['nama_klompeg']?></td>
            <td><?=$row['nama_subbag']?></td>
            <td align="center">
                <button type="button" class="btn btn-success btn-sm" onclick="view('<?=$row['id_pegawai']?>')"><i
                        class="fa fa-eye"></i></button>
                <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?=$row['id_pegawai']?>')"><i
                        class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?=$row['id_pegawai']?>')"><i
                        class="fa fa-trash"></i></button>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<!-- Page specific script -->


<script>
$(document).ready(function() {

    $("#tabeldata").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "print"]
    }).buttons().container().appendTo('#tabeldata_wrapper .col-md-6:eq(0)');
});

function view(id_pegawai) {
    $.ajax({
        type: "post",
        url: "<?=site_url('pegawai/viewdetil')?>",
        data: {
            id_pegawai: id_pegawai
        },
        dataType: "json",

        success: function(response) {
            if (response.sukses) {
                $('.viewmodal').html(response.sukses).show();
                $('#modalview').modal('show');
            }
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },

    });
}


function edit(id_pegawai) {
    $.ajax({
        type: "post",
        url: "<?=site_url('pegawai/formedit')?>",
        data: {
            id_pegawai: id_pegawai
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

function hapus(id_pegawai) {
    Swal.fire({
        title: 'Konfirmasi Penghapusan [ID=' + id_pegawai + ']',
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
                url: "<?=site_url('pegawai/hapusdata/')?>" + id_pegawai,
                data: {
                    id_pegawai: id_pegawai
                },
                dataType: "json",

                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data telah dihapus',
                            showConfirmButton: false,
                        })
                    }
                    datapegawai();
                },

                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },

            });
        }
    })
}
</script>