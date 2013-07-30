<?php
	include ("config.php");
	$inv = $_GET['idv'];
?>
<html>
<head>
<title>Invoice</title>
<style type="text/css" media="all">
	@import "css/style.css";
</style>

</head>
<body>
<table width="100%" border="0">
	<tr>
<?php
	$template = $db->Execute("SELECT * FROM  `lh_devider`");
	while($head = $template->FetchRow()) {
		$kurs = $head['kurs_dollar'];
?>
		<td align="left" class="default"><img class="logo" src="../laporan_harian/uploads/<?=$head['logo_invoice'];?>"></td>
		<td align="right" class="default"><?=$head['header_invoice'];?></td>
<?php
	} //EOF while($head = $template->FetchRow())
?>
	<tr>
	<tr>
		<td colspan="2" align="center"><b>INVOICE</b></td>
	</tr>
</table>
<?php
	$pemesan = $db->Execute("SELECT DISTINCT nama, alamat, tanggal_pesan, invoice_number, due_date FROM  `view1` WHERE invoice_number_id =  '$inv'");
	while($data = $pemesan->FetchRow()) {
?>
<table width="100%" border="0">
	<tr>
		<td width="57%" rowspan="4" align="left" class="default">
			Buyer:<br />
			<b><?=$data['nama'];?></b><br />
			<?=$data['alamat'];?>
		</td>
	</tr>
	<tr>
		<td align="right" class="default">Date :</td><td align="left" class="default"><?=$data['tanggal_pesan'];?></td>
	</tr>
	<tr>
		<td align="right" class="default">Invoice No. :</td><td align="left" class="default"><?=$data['invoice_number'];?></td>
	</tr>
	<tr>
		<td align="right" class="default">Due Date :</td><td align="left" class="default"><?=$data['due_date'];?></td>
	</tr>
</table>
<?php
	} //EOF while($template->FetchRow())
?>
<table width="100%" border="0" cellspacing="2" cellpadding="4">
	<tr class="tablehead">
		<td class="table">Artist</td><td class="table">Image</td><td class="table">Description</td><td class="table">Cur</td><td class="table">Price</td><td class="table">Disc. (%)</td><td class="table">Total</td>
	</tr>
<?php
	//$usr = $_GET['id'];
	$rs = $db->Execute("SELECT * FROM `view1` WHERE invoice_number_id =  '$inv'");
	while($row = $rs->FetchRow()) {
?>
	<tr class="tablecont">
		<td class="table"><?=$row['artist'];?></td><td class="table"><img class="imgkarya" src="../laporan_harian/uploads/<?=$row['image'];?>"></td><td class="table"><?=$row['description'];?></td><td class="table">Rp</td><td align="right" class="table"><?=number_format($row['price'], 2, ',', '.');?></td><td class="table"><?=number_format($row['discount'], 2, ',', '.');?></td><td align="right" class="table"><?=number_format($row['total'], 2, ',', '.');?></td>
	</tr>
<?php
	} //EOF while($row = $rs->FetchRow())
?>
<?php
	$total = $db->Execute("SELECT SUM( total ) FROM view1 WHERE invoice_number_id = '$inv'");
	while($data_total = $total->FetchRow()) {
		$rp = $data_total[0];
		$us = $rp / $kurs;
		$rp_format = number_format($rp, 2, ',', '.');
		$us_format = number_format($us, 2, '.', ',');
?>
	<tr class="tablecont">
		<td class="tablecont">&nbsp;</td><td class="tablecont">&nbsp;</td><td class="tablecont">Total</td><td class="tablecont">in Rp</td><td align="right" class="tablecont">&nbsp;</td><td class="tablecont">&nbsp;</td><td align="right" class="table"><b><?=$rp_format;?></b></td>
	</tr>
	<!--
	<tr align="center">
		<td class="tablecont">&nbsp;</td><td class="tablecont">&nbsp;</td><td class="tablecont">Disc.</td><td class="tablecont">%</td><td align="right" class="tablecont">&nbsp;</td><td class="tablecont">&nbsp;</td><td class="tablecont">0</td>
	</tr>
	-->
	<tr class="tablecont">
		<td class="tablecont">&nbsp;</td><td class="tablecont">&nbsp;</td><td class="tablecont">Total</td><td class="tablecont">in USD</td><td align="right" class="tablecont">&nbsp;</td><td class="tablecont">&nbsp;</td><td align="right" class="table"><b><?=$us_format;?></b></td>
	</tr>
</table>
<?php
	} //while($data_total = $total->FetchRow())
?>
<table width="100%" border="0">
	<tr>
		<td class="default">
<?php
	$template = $db->Execute("SELECT * FROM  `lh_devider`");
	while($head = $template->FetchRow()) {
		echo $head['footer_invoice'];
	}
?>
		</td>
	<tr>
</table>
</body>
</html>