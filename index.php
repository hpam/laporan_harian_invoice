<?php
	include('adodb/adodb.inc.php');
	$dbdriver = 'mysql';
	$server = 'localhost';
	$user = 'root';
	$password = '123456';
	$database = 'artjog_harian';
	
	$db = ADONewConnection($dbdriver); # eg 'mysql' or 'postgres'
	$db->debug = false;
	$db->Connect($server, $user, $password, $database);
	
	/* Test connection 
	$rs = $db->Execute("SELECT * FROM  `view1`");
	print "<pre>";
	print_r($rs->GetRows());
	print "</pre>";
	*/
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
?>
		<td align="left" class="default"><img class="logo" src="../laporan_harian/uploads/<?=$head['logo_invoice'];?>"></td>
		<td align="right" class="default"><?=$head['header_invoice'];?></td>
<?php
	} //EOF while($template->FetchRow())
?>
	<tr>
	<tr>
		<td colspan="2" align="center"><b>INVOICE</b></td>
	</tr>
</table>
<table width="100%" border="0">
	<tr>
		<td width="57%" rowspan="4" align="left" class="default">
			Buyer:<br />
			<b>Mr. Kenneth Choe</b><br />
			Jakarta-Indonesia
		</td>
	</tr>
	<tr>
		<td align="right" class="default">Date :</td><td align="left" class="default">July 5, 2013</td>
	</tr>
	<tr>
		<td align="right" class="default">Invoice No. :</td><td align="left" class="default">INV/ARTWORK/ARTJOG13/008</td>
	</tr>
	<tr>
		<td align="right" class="default">Due Date :</td><td align="left" class="default">July 8, 2013</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="2" cellpadding="4">
	<tr class="tablehead">
		<td class="table">Artist</td><td class="table">Image</td><td class="table">Description</td><td class="table">Cur</td><td class="table">Price</td><td class="table">Disc. (%)</td><td class="table">Total</td>
	</tr>
<?php
	//$usr = $_GET['id'];
	//$rs = $db->Execute("SELECT * FROM  `lh_gaji` LEFT JOIN lh_user ON lh_gaji.id_user = lh_user.id_user WHERE lh_gaji.id_user='$usr'");
	$rs = $db->Execute("SELECT * FROM  `view1`");
	while($row = $rs->FetchRow()) {
?>
	<tr class="tablecont">
		<td class="table"><?=$row['artist'];?></td><td class="table"><img class="imgkarya" src="../laporan_harian/uploads/<?=$row['image'];?>"></td><td class="table"><?=$row['description'];?></td><td class="table">Rp</td><td align="right" class="table"><?=$row['price'];?></td><td class="table"><?=$row['discount'];?></td><td align="right" class="table"><?=$row['total'];?></td>
	</tr>
<?php
	} //EOF while($row = $rs->FetchRow())
?>

	<tr align="center">
		<td class="tablecont">&nbsp;</td><td class="tablecont">&nbsp;</td><td class="tablecont">Sub total</td><td>USD</td><td align="right" class="tablecont">&nbsp;</td><td class="tablecont">&nbsp;</td><td class="tablecont">6,000</td>
	</tr>
	<tr align="center">
		<td class="tablecont">&nbsp;</td><td class="tablecont">&nbsp;</td><td class="tablecont">Disc.</td><td class="tablecont">%</td><td align="right" class="tablecont">&nbsp;</td><td class="tablecont">&nbsp;</td><td class="tablecont">0</td>
	</tr>
	<tr align="center">
		<td class="tablecont">&nbsp;</td><td class="tablecont">&nbsp;</td><td class="tablecont">Grand total</td><td class="tablecont">USD</td><td align="right" class="tablecont">&nbsp;</td><td class="tablecont">&nbsp;</td><td class="tablecont">6,000</td>
	</tr>
</table>
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