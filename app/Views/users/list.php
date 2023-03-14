<table id="tabeldata" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
            <th>Grup Level</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
    $nomor=1;
    foreach($result as $row):
    ?>
        <tr>
            <td><?=$nomor++;?></td>
            <td><?=$row['username']?></td>
            <td><?=$row['email']?></td>
            <td><?=$row['active']==1?'Aktif':'Non Aktif'?></td>
            <td><?=$row['group_description']?></td>
            <td align="center">
                <button type="button" class="btn btn-success btn-sm" onclick="view('<?=$row['id']?>')"><i
                        class="fa fa-eye"></i></button>
                <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?=$row['id']?>')"><i
                        class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm" onclick="del('<?=$row['id']?>')"><i
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
</script>