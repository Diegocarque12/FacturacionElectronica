<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<table width="100%">
	<tr>
		<td>
			<img src="https://i.imgur.com/g3bijUl.png" width="20%" >
		</td>
		<td align="center"><h1>Factura Electronica</h1></td>
		<td align="right">
			<h3>Factura # <?=$documento->consecutivo?></h3>
			Fecha <?=$documento->fecha?> <br>
		 	<img src="data:image/png;base64,'<?=$qrCodigo?>'" width="110px" >
		</td>
	</tr>
</table>

<table width="100%" >
    <tr><td><u>Emisor</u></td></tr>
    <tr>
        <td><b>Cedula</b>: <?=$documento->emisor_cedula;?></td>
        <td><b>Nombre</b>: <?=$documento->emisor_nombre;?></td>
        <td><b>Telefono</b>: <?=$documento->emisor_telefono;?></td>
    </tr>
    <tr>
        <td><b>Correo</b>: <?=$documento->emisor_correo;?></td>
        <td colspan="2"><b>Dirección</b>: <?=$documento->emisor_otras_senas;?> </td>
    </tr>
    <tr><td><u>Receptor</u></td></tr>
    <tr>
        <td><b>Cedula</b>:  <?=$documento->receptor_cedula;?></td>
        <td><b>Nombre</b>: <?=$documento->receptor_nombre;?></td>
        <td><b>Telefono</b>:  <?=$documento->receptor_telefono;?></td>
    </tr>
    <tr>
        <td><b>Correo</b>: <?=$documento->receptor_correo;?></td>
        <td colspan="2"><b>Dirección</b>: <?=$documento->receptor_otras_senas;?> </td>
    </tr>
</table>
<br><br>

<table width="100%">
	<tr>
		<th colspan="10" align="center">Detalles</th>
	</tr>
	<thead>
		<tr>
			<td>#</td>
			<td>Detalle</td>
			<td>Precio</td>
			<td>Cantidad</td>
			<td>Unidad</td>
			<td>Neto</td>
			<td>Descuentos</td>
			<td>SubTotal</td>
			<td>IVA</td>
			<td>TotalLinea</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($detalles as $key => $linea): ?>
			<tr>
				<td><?=$linea->linea?></td>
				<td><?=$linea->detalle?></td>
				<td><?=number_format($linea->precio_unidad,"2",",",".")?></td>
				<td><?=number_format($linea->cantidad,"2",",",".")?></td>
				<td><?=$linea->unidad_medida?></td>
				<td><?=number_format($linea->monto_total,"2",",",".") ?></td>
				<td><?=number_format($linea->monto_descuento,"2",",",".") ?></td>
				<td><?=number_format($linea->sub_total,"2",",",".")?></td>
				<td><?=number_format($linea->impuesto_neto,"2",",",".")?></td>
				<td align="right"><?=number_format($linea->total_linea,"2",",",".")?></td>
			</tr>
		<?php endforeach ?>
		
	</tbody>
	<br>
	<tfoot>
		<tr>
			<td colspan="9" align="right">Neto</td>
			<td align="right"> ¢ <?= number_format($documento->total_venta,"2",",",".")?></td>
		</tr>
		<tr>
			<td colspan="9" align="right">Descuento</td>
			<td align="right"><?= number_format($documento->total_descuentos,"2",",",".")?></td>
		</tr>
		<tr>
			<td colspan="9" align="right">Subtotal</td>
			<td align="right"><?= number_format($documento->total_venta_neta,"2",",",".")?></td>
		</tr>
		<tr>
			<td colspan="9" align="right">IVA</td>
			<td align="right"><?= number_format($documento->total_impuestos,"2",",",".")?></td>
		</tr>
		<tr>
			<td colspan="9" align="right">Total</td>
			<td align="right"><?= number_format($documento->total_comprobante,"2",",",".")?></td>
		</tr>
	</tfoot>
</table>

<small>Clave: <?=$documento->clave;?></small><br>
<small>Moneda: <?=$documento->moneda;?></small><br>
<small>Tipo Cambio: <?=number_format($documento->tipo_cambio,2,",",".") ?></small><br>
<small>Notas: <?= $documento->notas;?></small>
<br>
<small><u>Monto a pagar en Dolares= <?=number_format(($documento->total_comprobante/$documento->tipo_cambio),2,",",".") ?></u></small>

<br>
<small>Emitida conforme lo establecido en la resolución de Facturación Electrónica, N° DGT-R-48-2016 siete de octubre de dos mil dieciséis de la Dirección General de Tributación.</small>
</body>
</html>