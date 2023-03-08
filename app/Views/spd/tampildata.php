<?=$this->extend('themes/'.$themes.'/default')?>

<?=$this->section('content')?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0"><?=$title_page?></h2>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="breadcrumb float-sm-right">

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
            <div class="card-body">
                <div class="card-text viewdata">
                    <!-- load content below -->

                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<script>
function datapenandatangan() {
    $.ajax({
        url: "<?=site_url('penandatangan/ambildata')?>",
        dataType: "json",
        success: function(response) {
            $('.viewdata').html(response.data)
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

$(document).ready(function() {
    datapenandatangan();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
});
</script>

<?=$this->endSection()?>