<?php

function validate($request)
{
	$params    = $request->getQueryParams();
	
	$echostr   = $params['echostr'];
	$signature = $params["signature"];
        $timestamp = $params["timestamp"];
        $nonce     = $params["nonce"];
	$token     = TOKEN;

	$validate_array = [$token , $timestamp , $nonce];
	sort($validate_array);
	$validate_string = implode($validate_array);
	$sha1_string = sha1($validate_string);

	return $sha1_string == $signature ? $echostr : 0;
}


function wx_create_obj($msg_type)
{
	swith $msg_type:
	default:
	$handle_obj = new TextHandler();
}