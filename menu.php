<div class="menucontainer" style="border:solid 0px red;">
	<b>INVOICE</b>
	<ul class="default" style="border: solid 0px red;">
	<?php
		$menu = $db->Execute("SELECT DISTINCT invoice_number_id, invoice_number FROM `view1`");
		while($data_menu = $menu->FetchRow()) {
	?>
		<li><a href="index.php?idv=<?=$data_menu['invoice_number_id'];?>"><?=$data_menu['invoice_number'];?></a></li>
	<?php
		} //EOF while($data_menu = $menu->FetchRow())
	?>
	</ul>
	<a class="printbutton default" href="print.php?idv=<?=$_GET['idv'];?>" target="_blank">&nbsp;</a>
</div>