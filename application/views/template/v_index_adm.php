<?php
if(!$_SESSION['id_level_user'])
{
	redirect(base_url());
}
	echo $header;
	echo $content;
	echo $footer;
?>
