<?php
	session_start();
	require_once 'class.user.php';
	$session = new USER();

	// pemeriksaan session, jika tidak terdapat session maka langsung diarahkan ke halaman index
	if(!$session->is_loggedin())
	{
		$session->redirect('index.php');
	}