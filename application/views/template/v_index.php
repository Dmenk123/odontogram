<?php
if(!$_SESSION['id_role'])
{
	redirect(base_url());
}
	echo $header;
	echo $content;
	echo $footer;
?>
