<table id="tabeldata" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Klompeg/Kelompok Pegawai</th>
            <th>Jabatan</th>
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
            <td><?=$row['nama_klompeg']?></td>
            <td><?=$row['nama_jabatan']?></td>
            <td align="center">
                <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?=$row['id_jabatan']?>')"><i
                        class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?=$row['id_jabatan']?>')"><i
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

function edit(id_jabatan) {
    $.ajax({
        type: "post",
        url: "<?=site_url('jabatan/formedit')?>",
        data: {
            id_jabatan: id_jabatan
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

function hapus(id_jabatan) {
    Swal.fire({
        title: 'Konfirmasi Penghapusan [ID=' + id_jabatan + ']',
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
                url: "<?=site_url('jabatan/hapusdata/')?>" + id_jabatan,
                data: {
                    id_jabatan: id_jabatan
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
                    datajabatan();
                },

                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },

            });
        }
    })
}
</script>