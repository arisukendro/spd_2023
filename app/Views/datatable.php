<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datatables Plugins</title>
    <!-- css -->
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <form action="<?=site_url('home/get')?>" method="post">
        <div class="container">
            <table id="tabel_personil" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                                    for($i=1;$i<40;$i++):

                                    ?>
                    <tr>
                        <td><input class="minimal" type="checkbox" id="personil" name="personil[]" value=<?=$i?></td>
                        <td>Nama <?=$i?></td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                    <?php endfor ?>
                </tbody>

            </table>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
            </div>
        </div>
    </form>

    <!-- script -->
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.3/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#tabel_personil').DataTable({
            "paging": true,
            "serverside": false,
            "filter": true,
            "info": true,
            "select": true,
            "scrollX": true,
        })

    });
    </script>

</body>

</html>