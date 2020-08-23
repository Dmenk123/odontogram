<?php
if(!$_SESSION['id_role'])
{
	redirect(base_url());
}
	echo $header;
	echo $navbar;
	echo $content;
	echo $footer;
?>
