<ul>
<?php
	$menu = $db->Execute("SELECT DISTINCT invoice_number FROM `view1`");
	while($data_menu = $menu->FetchRow()) {
?>
	<li><a href="index.php?idv=<?=$data_menu['invoice_number'];?>"><?=$data_menu['invoice_number'];?></a></li>
<?php
	} //EOF while($data_menu = $menu->FetchRow())
?>
</ul>
<a href="print.php?idv=<?=$_GET['idv'];?>" target="_blank">Print View</a>