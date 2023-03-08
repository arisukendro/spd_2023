<table id="tabeldata" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Klompeg</th>
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
            <td align="center">
                <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?=$row['id_klompeg']?>')"><i
                        class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?=$row['id_klompeg']?>')"><i
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

function edit(id_klompeg) {
    $.ajax({
        type: "post",
        url: "<?=site_url('klompeg/formedit')?>",
        data: {
            id_klompeg: id_klompeg
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

function hapus(id_klompeg) {
    Swal.fire({
        title: 'Konfirmasi Penghapusan [ID=' + id_klompeg + ']',
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
                url: "<?=site_url('klompeg/hapusdata/')?>" + id_klompeg,
                data: {
                    id_klompeg: id_klompeg
                },
                dataType: "json",

                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data telah dihapus',
                        })
                    }
                    dataklompeg();
                },

                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },

            });
        }
    })
}
</script>