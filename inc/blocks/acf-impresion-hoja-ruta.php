<?php

/**
 * Version de impresion de la hoja de ruta
 */

// get entry form from gravity form
$entry_id = isset($_GET['key']) ? $_GET['key'] : 0;
$entry = GFAPI::get_entry($entry_id);
if ( is_wp_error($entry) || !$entry || 5 !== intval($entry['form_id']) ) {
	echo "Hoja de ruta no encontrada. Por favor comuniquese con el administrador desde el formulario de contacto.";
	return;
}
if (!is_admin() && !current_user_can('edit_user') && intval($entry['created_by']) !== get_current_user_id()) {
	echo "No tiene permisos para ver esta hoja de ruta. Por favor comuniquese con el administrador desde el formulario de contacto.";
	return;
}
$current_user = wp_get_current_user();


// Codigo usado para la agenciadeviajes
$codigo_destino = $entry[35];
$hoy = date('d/m/y');
// 7 días a partir de la fecha de ingreso
$vencimiento = $entry[48] ? $entry[48] : date('d/m/y', strtotime('+7 days'));
$agencia_legajo = $entry[37] ? $entry[37] : $current_user->get('user_login');
$agencia_organizadora = $entry[38] ? $entry[38] : $current_user->get('display_name');
$agencia_cuit = $entry[39] ? $entry[39] : get_user_meta($current_user->ID, 'agencia_cuit', true);
$agencia_domicilio = $entry[40] ? $entry[40] : get_user_meta($current_user->ID, 'agencia_domicilio', true);
$agencia_ciudad = $entry[41] ? $entry[41] : get_user_meta($current_user->ID, 'agencia_ciudad', true);
$agencia_provincia = $entry[42] ? $entry[42] : get_user_meta($current_user->ID, 'agencia_provincia', true);

$hoja_numero = str_pad(intval($entry[33]), 7, '0', STR_PAD_LEFT);
$codigo_destino        = str_pad(intval($codigo_destino), 2, '0', STR_PAD_LEFT);
$agencia_legajo      = str_pad(intval($agencia_legajo), 6, '0', STR_PAD_LEFT);
$dia = substr($vencimiento, 0, 2);
$mes = substr($vencimiento, 3, 2);
$anio = substr($vencimiento, 6, 2);
$patente =  !empty( $entry[14] ) ? intval(str_replace(' ', '', $entry[14])) : '';

$codigo = $hoja_numero . $codigo_destino . $dia . $mes . $anio . $agencia_legajo . $patente;
?>
<style type="text/css">
	<!--
	BODY {
		background: rgb(230, 230, 230);
		color: #000 !important;
		margin-bottom: 60px;
	}

	H1 {
		Font-Family: Arial;
		Font-Size: 16px !important;
	}

	H4 {
		Font-Family: Arial;
		Font-Size: 11px !important;
		font-Weight: 800;
		width: 600px;
	}

	H5 {
		Font-Family: Arial;
		Font-Size: 8px;
		font-Weight: Normal;
		width: 620;
		margin-bottom: 2px;
		margin-top: 2px;
	}

	p {
		color: #000  !important;
		margin-bottom: 0 !important;
	}

	h9 {
		Font-Family: Arial;
		Font-Size: 8px;
		PAGE-BREAK-AFTER: Always;
	}

	.HOJA {
		margin-bottom: 9px;
		/* PAGE-BREAK-AFTER: Always; */
		vertical-align: top;
		padding: 60px;
		width: 620;
		font-family: Arial;
		background-color: white;
		/* border-top: 1px solid black;
		border-bottom: 1px solid black;
		border-right: 1px solid black; */
	}

	.HOJA a {
		font-size: 11px;
		color: #000 !important;
	}

	.HOJA3 {
		vertical-align: top;
		width: 620;
		font-family: Arial;
		background-color: white;
		border-top: 1px solid black;
		border-left: 1px solid black;
		border-bottom: 2px solid black;
		border-right: 2px solid black;
	}

	.SUBTITULO {
		Height: 22;
		Color: White;
		Font-Size: 12px;
		Font-Weight: Bold;
		align: center;
	}

	.SUBTITULO2 {
		Font-Size: 16px;
		Font-Weight: Bold;
		vertical-align: top;
	}

	.CABECERA {
		Width: 630;
		Height: 45;
		Font-Family: Arial;
		font-size: 11px;
	}

	.ITEM {
		font-size: 11px;
		Font-Weight: Bold;
		height: 20;
	}

	.TABLATITULO {
		Font-Size: 11px;
		Font-Weight: Bold;
	}

	.FIRMA {
		Font-Size: 11px;
		Font-Weight: Bold;
		border: 1px solid gray;
	}

	.CONTENIDO {
		Font-Size: 11px;
		border-bottom: 1px dashed gray;
		height: 20px;
	}

	.PAISES {
		Font-Size: 10px;
		Font-Family: Arial;
	}

	.GRUPO {
		margin-bottom: 5px;
	}

	INPUT {
		text-decoration: none;
		font-size: 14px;
		font-weight: 700;
		text-transform: none;
		padding: 0 30px;
		border: 0;
		height: 65px;
		border-radius: 4px;
		background-color: #253745;
		color: #fff;
	}

	.noimprimir {
		Top: 5px;
		Left: 5px;
		Cursor: pointer;
	}
	.titulo-seccion {
		text-align: center;
		text-transform: uppercase;
		font-size: 12px;
		background-color: #ccc;
		color: #000;
		padding: 5px 0;
		margin: 4px 0;
		print-color-adjust:exact;
        -webkit-print-color-adjust:exact;
	}

</style>
<style type="text/css" media="print">
	@page {
		margin: 0cm;
	}
  	body {
		margin: 0cm;
		color: #000 !important;
		display:block;
      	page-break-before:always;
	}
   .noimprimir {
		display: none;
	}

</STYLE>

<!----Librerias jquery para generacion de codigo de barras----->
<script type="text/javascript" src="<?php echo esc_url(site_url('/wp-content/themes/agencias-chubut-patagonia/dist/js/lib/jquery-barcode.min.js')) ?>"></script>

<?php for ( $hojan = 1; $hojan <= 2; $hojan++) : ?>
<table class="HOJA" width="600" style="margin-block-start: 0; padding-top: 10px;">
	<tr>
		<td valign="top">
			<table class="CABECERA">
				<tr>
					<td width="200" valign="top" style="font-size: 8px;">
						<img src="<?php echo esc_url(site_url('/wp-content/themes/agencias-chubut-patagonia/dist/images/logo_ministerio.jpeg')) ?>" width="75px" height="43px"><br>Ministerio de Turismo - AANPPV
					</td>
					<td width="200" valign="top" class="SUBTITULO2">
						HOJA DE RUTA<br>Prov. CHUBUT
					</td>

					<td width="200" valign="top">
						<p align="left">

							<?php
							if ($hojan == 1) {
								echo "Original";
							}
							if ($hojan == 2) {
								echo "Duplicado";
							}
							?>

							<br>Nro <b>
								<?php echo esc_html($entry[46] . "-" .  $hoja_numero); ?></b><br>
							V&aacute;lida hasta:<b><?php echo esc_html($vencimiento) ?></b><br>


							</b>
						</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr class="SUBTITULO">
		<td>
			<h4 class="titulo-seccion">Servicio de Transporte Automotor de Pasajeros para el Turismo</h4>
		</td>
	</tr>
	<tr>
		<td>
			<table width="600" cellpadding="0" cellspacing="0">
				<tr>
					<td width="140" class="ITEM" valign="bottom">Agencia&nbsp;Organizadora:</td>
					<td width="300" class="CONTENIDO" valign="bottom">
						<?php echo esc_html($agencia_organizadora); ?>
					</td>
					<td width="60" class="ITEM" valign="bottom">&nbsp;Cuit:</td>
					<td width="100" class="CONTENIDO" valign="bottom">
						<?php echo esc_html($agencia_cuit); ?>
					</td>
				</tr>
			</table>

			<table width="600" cellpadding="0" cellspacing="0">
				<tr>
					<td width="70" class="ITEM" valign="bottom">Domicilio:</td>
					<td width="370" class="CONTENIDO" valign="bottom"><?php echo esc_html($agencia_domicilio); ?></td>
					<td width="60" class="ITEM" valign="bottom">&nbsp;Legajo:</td>
					<td width="100" class="CONTENIDO" valign="bottom"><?php echo esc_html($agencia_legajo); ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="600" cellpadding="0" cellspacing="0" style="margin-top: 0;">
				<tr>
					<td width="100" class="ITEM" valign="bottom">Lugar&nbsp;de&nbsp;partida:</td>
					<td width="165" class="CONTENIDO" valign="bottom"><?php echo esc_html($entry[3]); ?></td>
					<td width="70" class="ITEM" valign="bottom">Destino:</td>
					<td width="115" class="CONTENIDO" valign="bottom"><?php echo esc_html($entry[1]); ?></td>
					<td width="70" class="ITEM" valign="bottom">Hora:</td>
					<td width="100" class="CONTENIDO" valign="bottom">
						<p align="left"><?php echo esc_html($entry[4]); ?></p>
					</td>
				</tr>
			</table>

			<table width="600" cellpadding="0" cellspacing="0">
				<tr>
					<td width="60" class="ITEM" valign="bottom">Clase(1):</td>
					<td width="390" class="CONTENIDO" valign="bottom"><?php echo esc_html($entry[5]); ?></td>
					<td width="70" class="ITEM" valign="bottom">Km:</td>
					<td width="100" class="CONTENIDO" valign="bottom">
						<p align="left"><?php echo esc_html(isset($entry[47])?$entry[47]:''); ?></p>
					</td>
				</tr>
			</table>

			<table width="600" cellpadding="0" cellspacing="0" class="GRUPO">
				<tr>
					<td width="100" class="ITEM" valign="bottom">Fecha&nbsp;de&nbsp;inicio:</td>
					<td width="350" class="CONTENIDO" valign="bottom">
						<?php
						// if you don't have access to the $field object but you do have the $form get the field first
						$field = GFFormsModel::get_field( $entry['form_id'], 6 );
						if ( ! $field || ( class_exists( 'GF_Field' ) && ! $field instanceof GF_Field ) ) {
							$value = $entry[6];
						} else {
							$value = $field->get_value_entry_detail( $entry[6] );
						}

						echo esc_html($value);
						?>
					</td>
					<td width="70" class="ITEM" valign="bottom">Fecha&nbsp;Fin:</td>
					<td width="100" class="CONTENIDO" valign="bottom">
						<p align="left">
						<?php
						// if you don't have access to the $field object but you do have the $form get the field first
						$field = GFFormsModel::get_field( $entry['form_id'], 7 );
						if ( ! $field || ( class_exists( 'GF_Field' ) && ! $field instanceof GF_Field ) ) {
							$value = $entry[7];
						} else {
							$value = $field->get_value_entry_detail( $entry[7] );
						}
						echo esc_html($value);
						?>
						</p>
					</td>
				</tr>
			</table>

			<table width="600" cellpadding="0" cellspacing="0">
				<tr>
					<td width="150" class="ITEM" valign="bottom">Empresa&nbsp;de&nbsp;Transporte:</td>
					<td width="300" class="CONTENIDO" valign="bottom"><?php echo esc_html($entry[9]); ?></td>
					<td width="45" class="ITEM" valign="bottom">
						<p align="left">CUIT:</p>
					</td>
					<td width="125" class="CONTENIDO" valign="bottom">
						<p align="left"><?php echo esc_html($entry[10]); ?></p>
					</td>
				</tr>
			</table>

			<table width="600" cellpadding="0" cellspacing="0" class="GRUPO">
				<tr>
					<td width="70" class="ITEM" valign="bottom">Domicilio:</td>
					<td width="280" class="CONTENIDO" valign="bottom"><?php echo esc_html($entry[11]); ?></td>
					<td width="145" class="ITEM" valign="bottom">
						<p align="left">Inscripci&oacute;n&nbsp;Reg.&nbsp;Nac.:</p>
					</td>
					<td width="125" class="CONTENIDO" valign="bottom">
						<p align="left"><?php echo esc_html($entry[12]); ?></p>
					</td>
				</tr>
			</table>

			<table width="600" cellpadding="0" cellspacing="0">
				<tr>
					<td width="150" class="ITEM" valign="bottom">Dominio&nbsp;del&nbsp;veh&iacute;culo:</td>
					<td width="290" class="CONTENIDO" valign="bottom"><?php echo esc_html($entry[14]); ?></td>
					<td width="55" class="ITEM" valign="bottom">
						<p align="left">Marca:</p>
					</td>
					<td width="125" class="CONTENIDO" valign="bottom">
						<p align="left"><?php echo esc_html($entry[15]); ?></p>
					</td>
				</tr>
			</table>

			<table width="600" cellpadding="0" cellspacing="0">
				<tr>
					<td width="150" class="ITEM" valign="bottom">Modelo&nbsp;del&nbsp;veh&iacute;culo:</td>
					<td width="180" class="CONTENIDO" valign="bottom"><?php echo esc_html($entry[16]); ?></td>
					<td width="165" class="ITEM" valign="bottom">
						<p align="left">Cantidad de Pasajeros:</p>
					</td>
					<td width="125" class="CONTENIDO" valign="bottom">
						<p align="left"><?php echo esc_html($entry[17]); ?></p>
					</td>
				</tr>
			</table>

			<table width="600" cellpadding="0" cellspacing="0">
				<tr>
					<td width="150" class="ITEM" valign="bottom">Conductor&nbsp;del&nbsp;veh&iacute;culo:</td>
					<td width="290" class="CONTENIDO" valign="bottom"><?php echo esc_html($entry[19]); ?></td>
					<td width="55" class="ITEM" valign="bottom">
						<p align="left">DNI:</p>
					</td>
					<td width="125" class="CONTENIDO" valign="bottom">
						<p align="left"><?php echo esc_html($entry[20]); ?></p>
					</td>
				</tr>
			</table>

			<table width="600" cellpadding="0" cellspacing="0" class="GRUPO">
				<tr>
					<td width="150" class="ITEM" valign="bottom">2do Conductor&nbsp;del&nbsp;veh&iacute;culo:</td>
					<td width="290" class="CONTENIDO" valign="bottom"><?php echo esc_html($entry[21]); ?></td>
					<td width="55" class="ITEM" valign="bottom">
						<p align="left">DNI:</p>
					</td>
					<td width="125" class="CONTENIDO" valign="bottom">
						<p align="left"><?php echo esc_html($entry[22]); ?></p>
					</td>
				</tr>
			</table>

			<table width="600" cellpadding="0" cellspacing="0">
				<tr>
					<td width="180" class="ITEM" valign="bottom">Gu&iacute;a de Turismo Provincial:</td>
					<td width="255" class="CONTENIDO" valign="bottom"><?php echo esc_html($entry[24]); ?></td>
					<td width="60" class="ITEM" valign="bottom">
						<p align="left">Registro&nbsp;N:</p>
					</td>
					<td width="125" class="CONTENIDO" valign="bottom">
						<p align="left"><?php echo esc_html($entry[26]); ?></p>
					</td>
				</tr>
			</table>
			<table width="600" cellpadding="0" cellspacing="0" class="GRUPO">
				<tr>
					<td width="100" class="ITEM" valign="bottom">Coordinador:</td>
					<td width="340" class="CONTENIDO" valign="bottom"><?php echo esc_html($entry[28]); ?></td>
					<td width="55" class="ITEM" valign="bottom">
						<p align="left">DNI:</p>
					</td>
					<td width="125" class="CONTENIDO" valign="bottom">
						<p align="left"><?php echo esc_html($entry[29]); ?></p>
					</td>
				</tr>
			</table>

			<table class="PAISES" cellpadding="0" cellspacing="0" border="1">
				<tr>
					<td width="305" colspan="6" class="TABLATITULO">
						<p align="center"><b>PASAJEROS NACIONALES (Cantidad)</b>
					</td>
					<td width="265" colspan="6" class="TABLATITULO">
						<p align="center"><b>PASAJEROS EXTRANJEROS (Cantidad)</b>
					</td>
				</tr>

				<tr>
					<td width="80">&nbsp;Buenos Aires</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;Formosa</td>
					<td width="28">&nbsp;</td>
					<td width="90">&nbsp;Salta</td>
					<td width="28">&nbsp;</td>
					<td width="50">&nbsp;Alemania</td>
					<td width="28">&nbsp;</td>
					<td width="80">&nbsp;Espa&ntilde;a</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;M&eacute;xico</td>
					<td width="28">&nbsp;</td>
				</tr>

				<tr>
					<td width="80">&nbsp;Capital Federal</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;Jujuy</td>
					<td width="28">&nbsp;</td>
					<td width="90">&nbsp;San Juan</td>
					<td width="28">&nbsp;</td>
					<td width="50">&nbsp;Australia</td>
					<td width="28">&nbsp;</td>
					<td width="80">&nbsp;Estados Unidos</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;Rusia</td>
					<td width="28">&nbsp;</td>
				</tr>

				<tr>
					<td width="80">&nbsp;Catamarca</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;La Pampa</td>
					<td width="28">&nbsp;</td>
					<td width="90">&nbsp;San Luis</td>
					<td width="28">&nbsp;</td>
					<td width="50">&nbsp;Austria</td>
					<td width="28">&nbsp;</td>
					<td width="80">&nbsp;Francia</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;Suiza</td>
					<td width="28">&nbsp;</td>
				</tr>

				<tr>
					<td width="80">&nbsp;Chaco</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;La Rioja</td>
					<td width="28">&nbsp;</td>
					<td width="90">&nbsp;Santa Cruz</td>
					<td width="28">&nbsp;</td>
					<td width="50">&nbsp;B&eacute;lgica</td>
					<td width="28">&nbsp;</td>
					<td width="80">&nbsp;Holanda</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;Uruguay</td>
					<td width="28">&nbsp;</td>
				</tr>

				<tr>
					<td width="80">&nbsp;Chubut</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;Mendoza</td>
					<td width="28">&nbsp;</td>
					<td width="90">&nbsp;Santa F&eacute;</td>
					<td width="28">&nbsp;</td>
					<td width="50">&nbsp;Brasil</td>
					<td width="28">&nbsp;</td>
					<td width="80">&nbsp;Inglaterra</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;Venezuela</td>
					<td width="28">&nbsp;</td>
				</tr>

				<tr>
					<td width="80">&nbsp;C&oacute;rdoba</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;Misiones</td>
					<td width="28">&nbsp;</td>
					<td width="90">&nbsp;Sgo. del Estero</td>
					<td width="28">&nbsp;</td>
					<td width="50">&nbsp;Canada</td>
					<td width="28">&nbsp;</td>
					<td width="80">&nbsp;Italia</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;</td>
					<td width="28">&nbsp;</td>
				</tr>

				<tr>
					<td width="80">&nbsp;Corrientes</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;Neuqu&eacute;n</td>
					<td width="28">&nbsp;</td>
					<td width="90">&nbsp;Tierra del Fuego</td>
					<td width="28">&nbsp;</td>
					<td width="50">&nbsp;Chile</td>
					<td width="28">&nbsp;</td>
					<td width="80">&nbsp;Israel</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;</td>
					<td width="28">&nbsp;</td>
				</tr>

				<tr>
					<td width="80">&nbsp;Entre R&iacute;os</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;R&iacute;o Negro</td>
					<td width="28">&nbsp;</td>
					<td width="90">&nbsp;Tucum&aacute;n</td>
					<td width="28">&nbsp;</td>
					<td width="50">&nbsp;Colombia</td>
					<td width="28">&nbsp;</td>
					<td width="80">&nbsp;Jap&oacute;n</td>
					<td width="28">&nbsp;</td>
					<td width="60">&nbsp;</td>
					<td width="28">&nbsp;</td>
				</tr>
			</table>
			<br>
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="450" class="TABLATITULO" style="font-size: 11px;">
					El que suscribe Don <?php echo esc_html($entry[31]); ?>
					</td>
					<td width="150" colspan="6" class="TABLATITULO" style="font-size: 11px;">
					DNI <?php echo esc_html($entry[32]); ?>
					</td>
				</tr>
				<tr>
				<td colspan="2">
					<p style="font-size: 10px;">
					en su car&aacute;cter de TITULAR / PRESIDENTE / GERENTE / APODERADO / ENCARGADO de la Agencia Organizadora afirma que los datos consignados en este formulario son correctos y completos y que se ha confeccionado esta declaraci&oacute;n jurada sin omitir ni falsear dato alguno siendo fiel extensi&oacute;n de la verdad.
					</p>
				</td>
				</tr>
			</table>

		</td>
	</tr>
	<tr>
		<td>
			<table width="600">
				<tr>
					<td width="300">
						<table width="300" cellpadding="0" cellspacing="0">
							<tr>
								<td width="60" class="Item" style="font-size: 11px;">LUGAR:&nbsp;</td>
								<td width="240" class="CONTENIDO"></td>
							</tr>
							<tr>
								<td width="60" class="Item" style="font-size: 11px;">FECHA:&nbsp;</td>
								<td width="240" class="CONTENIDO"></td>
							</tr>
						</table>
					</td>
					<td width="300" Class="FIRMA" valign="top">&nbsp;Firma y Sello:</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td>
			<h4 class="titulo-seccion">Intervención Puesto de Control</h4>
			<table width="600" cellpadding="0" cellspacing="0">
				<tr>
					<td width="70" class="ITEM" valign="bottom">PUESTO:&nbsp;</td>
					<td width="530" class="CONTENIDO" valign="bottom"></td>
				</tr>
				<tr>
					<td width="70" class="ITEM" valign="bottom">
						FECHA:&nbsp;</td>
					<td width="530" class="CONTENIDO" valign="bottom">&nbsp;</td>
				</tr>
			</table>
			<table width="600" cellpadding="0" cellspacing="0" style="margin-bottom: 4px;">
				<tr>
					<td width="70" class="ITEM" valign="bottom">
						Firma:&nbsp;</td>
					<td width="200" class="CONTENIDO" valign="bottom"></td>
					<td width="80" class="ITEM" valign="bottom">Aclaracion:&nbsp;</td>
					<td width="250" class="CONTENIDO" valign="bottom"></td>
				</tr>
			</table>

			<h4  class="titulo-seccion">Observaciones</h4>
			<p style="font-size: 8px; font-weight: bold;">
				<i>
					Se encuentra vigente la Ley I N&deg; 140 y la Disposici&oacute;n N&deg; 31/16-DAT, las cuales regulan y definen el Servicio de Transporte Tur&iacute;stico, en la provincia del Chubut. Que de acuerdo a lo establecido en el Art.1&deg; de la Disposici&oacute;n N&deg; 149/08-DAT,se encuentra PROHIBIDA la circulaci&oacute;n de los &oacute;mnibus que sean de doble Piso por caminos y rutas provinciales no pavimentadas, que est&aacute;n ubicadas dentro de la Pcia de Chubut y que comuniquen &aacute;reas naturales protegidas.
					<br>
					Referencias: (1) Receptivo, Excursi&oacute;n, Gran Turismo, Exclusivo. ///
					Deber&aacute; consignarse en doble ejemplar - Deber&aacute; completarse a m&aacute;quina o en letra tipo imprenta - No debe tener enmiendas, claros ni raspaduras - El original se dejar&aacute; en el ingreso al Area - El duplicado se portar&aacute; en el veh&iacute;culo y se conservar&aacute; en la empresa de transporte por un lapso de 2 (dos) a&ntilde;os a contar desde la fecha de realizaci&oacute;n del viaje
				</i>
			</p>



			<div style="text-align: center;">
			<?php
				if ($hojan == 1) {
					echo '<div id="bcBarras1" style = "margin:8px auto;"></div>';
				}

				if ($hojan == 2) {
					echo '<div id="bcBarras2" style = "margin:8px auto;"></div>';
				}
			?>
			</div>

		</td>
	</tr>
</table>
<?php endfor; ?>
<div class="noimprimir " style="text-align: center; width: 100%;">
	<div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex is-content-justification-center" style="justify-content: center;">
		<div class="wp-block-button is-style-btn_secondary">
			<a class="noimprimir wp-block-button__link wp-element-button" href="#"  rel="noreferrer noopener" onClick="javascript:window.print();">Imprimir</a>
		</div>
		<div class="wp-block-button is-style-btn_secondary">
			<a class="noimprimir wp-block-button__link wp-element-button" href="/"  rel="noreferrer noopener">Volver al Inicio</a>
		</div>
	</div>
</div>


<!---------------------------------------------------------------------------------------------------------->
<!---------------------------------- GENERACION DE CODIGO DE BARRAS ---------------------------------------->
<!---------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
	jQuery(document).ready(function() {

		var codigoBarra = "<?php echo $codigo; ?>";
		jQuery("#bcBarras1").barcode(codigoBarra, "code128");
		jQuery("#bcBarras2").barcode(codigoBarra, "code128");


		let beforePrint = function() {
			console.log('Ventana de impresión abierta.');
		};

		let afterPrint = function() {
			console.log('Ventana de impresión cerrada.');

			// Solicitando al usuario una decisión después de cerrar la ventana de impresión
			let userDecision = confirm("ATENCION: ¿Deseas continuar en esta página? Si quieres seguir en la página de impresión de la hoja de ruta has clic en 'ACEPTAR', si ya imprimiste tu hoja de ruta y no necesitas imprimirla de nuevo, has clic en 'CANCELAR' para ser redirigido a la página de inicio.");

			if (!userDecision) {
				// Redirigir al usuario a la página de inicio si seleccionó 'Cancelar'
				window.location.href = "/"; // Asegúrate de usar la URL correcta para tu página de inicio
			}
		};

		if (window.matchMedia) {
			let mediaQueryList = window.matchMedia('print');
			mediaQueryList.addListener(function(mql) {
				if (mql.matches) {
					beforePrint();
				} else {
					afterPrint();
				}
			});
		}
	});
</script>
<!---------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------->
