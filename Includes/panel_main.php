<?php
//Connecting a page, according to p
if(isset($_GET['p']) && file_exists("includes/".$_GET['p'].'.php'))
	require_once "includes/".$_GET['p'].'.php';
else//if p parameter is not defined
	require_once 'includes/scheduler.php';
?>