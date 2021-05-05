<?= $this->extend('base') ?>

<?= $this->section('header') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dash</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Dash</li>
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
                    <div class="card">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
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
                                    <td><?=$documento->consecutivo?></td>
                                    <td><?=$documento->receptor_nombre?></td>
                                    <td><?=$documento->total_comprobante?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Opciones
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="facturaPDF/<?=$documento->clave?>">Ver PDF</a>
                                                <a class="dropdown-item" href="#">Estado MH</a>
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