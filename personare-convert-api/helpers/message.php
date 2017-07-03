<?php 

function messageSuccess($msg, $value)
{	
	echo message(true, $msg, $value); die();
}

function messageFailure($msg)
{	
	echo message(false, $msg);die(); 
}

function message($status, $msg, $value="")
{
	$arrmsg = [
		'success' 	=> $status,
		'message'	=> $msg
	];

	if ($status)
		$arrmsg['response'] = $value; 

	echo json_encode($arrmsg);die();  
}
