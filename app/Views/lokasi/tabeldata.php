<table id="tabeldata" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Lokasi</th>
            <th>Alamat</th>
            <th>Kota</th>
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
            <td><?=$row['nama_lokasi']?></td>
            <td><?=$row['alamat']?></td>
            <td><?=$row['kota_lokasi']?></td>
            <td align="center">
                <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?=$row['id_lokasi']?>')"><i
                        class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?=$row['id_lokasi']?>')"><i
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
    });

});

function edit(id_lokasi) {
    $.ajax({
        type: "post",
        url: "<?=site_url('lokasi/formedit')?>",
        data: {
            id_lokasi: id_lokasi
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

function hapus(id_lokasi) {
    Swal.fire({
        title: 'Konfirmasi Penghapusan [ID=' + id_lokasi + ']',
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
                url: "<?=site_url('lokasi/hapusdata/')?>" + id_lokasi,
                data: {
                    id_lokasi: id_lokasi
                },
                dataType: "json",

                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data telah dihapus',
                            showConfirmButton: false,
                            timer: 1400
                        })
                    }
                    datalokasi();
                },

                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },

            });
        }
    })
}
</script>