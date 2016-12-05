<?php

	header('Content-Type : text/html; charset = utf-8');
	$retArr = array(
		'succ' => '200', 
		'data' => array(), 
		'msg' => '请求成功', 
	);
	if (empty($_REQUEST['test_id'])) {
		$retArr['succ'] = '404';
		$retArr['msg'] = '请求失败';
		exit(json_encode($retArr));
	}
	$test_id = $_REQUEST['test_id'];
	$mysqli = new mysqli('localhost', 'root', 'qq641711559', 'test');
	if ($mysqli->connect_errno) {
    	echo "Connect failed: ". $mysqli->connect_error;
    	exit;
	}
	$sql = "select * from test_table where test_id=".$test_id;
	if ($mysqli->query($sql) == TRUE) {
		$result = $mysqli->query($sql);
		$data = array();
		if ($result->num_rows==1) {
			foreach ($result->fetch_assoc() as $key => $value) {
				$data[$key] = $value;
			}
			$retArr['data'] = $data;
			echo (json_encode($retArr));
		} elseif ($result->num_rows>1) {
			foreach ($result as $key => $value) {
				$data[$key] = $value;
			}
			$retArr['data'] = $data;
			echo (json_encode($retArr));
		} else {
			echo (json_encode($retArr));
		}
				
   		$result->close();
	}
	$mysqli->close();
?>