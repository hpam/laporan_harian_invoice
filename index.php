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

	$usr = $_GET['id'];
	$rs = $db->Execute("SELECT * FROM  `lh_gaji` LEFT JOIN lh_user ON lh_gaji.id_user = lh_user.id_user WHERE lh_gaji.id_user='$usr'");
	/* Test connection
	print "<pre>";
	print_r($rs->GetRows());
	print "</pre>"; */
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
		<td align="left">LOGO</td>
		<td align="right">ALAMAT</td>
	<tr>
	<tr>
		<td colspan="2" align="center"><b>INVOICE</b></td>
	</tr>
</table>
<table width="100%" border="0">
	<tr>
		<td width="57%" rowspan="4" align="left">
			Buyer:<br />
			<b>Mr. Kenneth Choe</b><br />
			Jakarta-Indonesia
		</td>
	</tr>
	<tr>
		<td align="right">Date :</td><td align="left">July 5, 2013</td>
	</tr>
	<tr>
		<td align="right">Invoice No. :</td><td align="left">INV/ARTWORK/ARTJOG13/008</td>
	</tr>
	<tr>
		<td align="right">Due Date :</td><td align="left">July 8, 2013</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="2" cellpadding="4">
	<tr class="tablehead">
		<td class="table">Artist</td><td class="table">Image</td><td class="table">Description</td><td class="table">Cur</td><td class="table">Price</td><td class="table">Disc.</td><td class="table">Total</td>
	</tr>
<?php
	while($row = $rs->FetchRow()) {
?>
	<tr class="tablecont">
		<td class="table"><?=$row['nama']?></td><td class="table">[<?=$row['username']?>]</td><td class="table"><?=$row['status']?></td><td class="table">USD</td><td align="right" class="table"><?=$row['gaji_pokok']?></td><td class="table"><?=$row['tunjangan_proyek']?></td><td class="table">Tot</td>
	</tr>
<?php
	} //EOF while($row = $rs->FetchRow())
?>

	<tr align="center">
		<td>&nbsp;</td><td>&nbsp;</td><td>Sub total</td><td>USD</td><td align="right">&nbsp;</td><td>&nbsp;</td><td>6,000</td>
	</tr>
	<tr align="center">
		<td>&nbsp;</td><td>&nbsp;</td><td>Disc.</td><td>%</td><td align="right">&nbsp;</td><td>&nbsp;</td><td>0</td>
	</tr>
	<tr align="center">
		<td>&nbsp;</td><td>&nbsp;</td><td>Grand total</td><td>USD</td><td align="right">&nbsp;</td><td>&nbsp;</td><td>6,000</td>
	</tr>
</table>
<table width="100%" border="0">
	<tr>
		<td align="left">
		Notes:
		</td>
	<tr>
</table>
</body>
</html>