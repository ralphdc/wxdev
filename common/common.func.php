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


function prepare_wx_data($msg_obj , $db , $logger , &$id)
{
	if($msg_type = $msg_obj->MsgType)
	{
		switch ($msg_type) {
			case 'text':
				# code...
				$sql = "insert into wx_history(tousername, fromusername, createtime, msgtype, msgid, content) values (".$msg_obj->ToUserName.",".$msg_obj->FromUserName.",".$msg_obj->createtime.",".$msg_obj->MsgType.",".$msg_obj->MsgId.",".$msg_obj->Content.")";
				break;
			case 'image':
				# code...
				break;
			case 'voice':
				# code...
				break;		
			case 'video':
				# code...
				break;	
			case 'shortvideo':
				# code...
				break;	
			case 'location':
				# code...
				break;	
			case 'link':
				# code...
				break;			
			default:
				# code...
				break;
		}

		try{
			$affect = $db->exec($sql);
		}catch(Exception $e)
		{
			$logger->addError(print_r($e->getMessage(), true));
			return false;
		} 
		
		$logger->addInfo("PDO exec sql: [ ".$sql." ]");
		$logger->addInfo("PDO exec sql affected number : [ ".$affect." ]");
		if($affect) $id = $db->lastInsertId();

		return $affect ?  $affect : false;
	}
	return false;
}