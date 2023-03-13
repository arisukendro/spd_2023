<table id="tabeldata" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Active</th>
            <th>Grup Level</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
    $nomor=1;
    foreach($result as $row):
        $nomor++;
    ?>
        <tr>
            <td><?=$nomor++;?></td>
            <td><?=$row['username']?></td>
            <td><?=$row['email']?></td>
            <td><?=$row['active']?></td>
            <td><?=$row['group_description']?></td>
            <td align="center">
                <button type="button" class="btn btn-success btn-sm" onclick="view('<?=$row['id']?>')"><i
                        class="fa fa-eye"></i></button>
                <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?=$row['id']?>')"><i
                        class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?=$row['id']?>')"><i
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
    });
});

function view(id) {
    $.ajax({
        type: "post",
        url: "<?=site_url('users/viewdetil')?>",
        data: {
            id_pegawai: id
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


function edit(id) {
    $.ajax({
        type: "post",
        url: "<?=site_url('users/formedit')?>",
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

function hapus(id) {
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
                url: "<?=site_url('users/delete/')?>" + id_pegawai,
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