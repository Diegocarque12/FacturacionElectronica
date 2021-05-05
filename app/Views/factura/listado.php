<?= $this->extend('base') ?>

<?= $this->section('header') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Listado</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Documentos</a></li>
                    <li class="breadcrumb-item active">Listado</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<?= $this->endSection() ?>

<?= $this->section('body') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Documentos</h5>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="tabla">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Consecutivo</th>
                                    <th>Cliehte</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($documentos as $key => $documento):?>
                                <tr>
                                    <td><?=$documento->fecha?></td>
                                    <td><?=$documento->clave?></td>
                                    <td><?=$documento->receptor_nombre?></td>
                                    <td>¢ <?=number_format($documento->total_comprobante,"2",",",".") ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Opciones
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="facturaPDF/<?=$documento->clave?>">Ver
                                                    PDF</a>
                                                <button class="dropdown-item" id="estadoMH"
                                                    value="<?=$documento->clave?>">Estado MH</button>
                                                <a class="dropdown-item" href="#">Nota de credito</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
    //Validar el estado de un documento
    $("#estadoMH").on('click', function() {
        $.ajax({
            "url": "<?=base_url('/factura/validar')?>",
            "method": "post",
            "data":{'clave': this.value},
            "dataType": "json",
        }).done(function(response) {
            alert(response);
            //mensaje('mensaje', response, 'warning');
            /*if (response == 'Apr') {
                mensaje("Alerta", "Libro agregado correctamente");

                $(".inp").val("");
            } //Fin del if
            else {
                mensaje('Error', 'El libro ya se encuentra agregado')
            } //Fin del else*/
        });
    });
});
</script>
<?= $this->endSection() ?>