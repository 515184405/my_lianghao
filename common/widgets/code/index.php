<?php

	$dirPath ='../../runtime/log';
	if(isset($_GET['dir']))$dirPath = $_GET['dir'];
	$action = null;

	//引入文件
	require "onlineEditor.php";

	//获得onlineEditor对象
	$onlineEditor = new onlineEditor($dirPath);
	$fileMes = $onlineEditor->main();

	//处理文件路径
	function subFilePath($dirPath,$filename){
		// echo $dirPath . $filename;
		return $dirPath . $filename;
	}

	//初始化
	if(array_key_exists('action', $_GET)){
		switch ($_GET['action']) {
			case 'open':
				$action = 'open';
				break;
            case 'look':
                $action = 'look';
                break;
            case 'updata':
                $action = 'updata';
                break;
            case 'create':
                $action = 'create';
                $onlineEditor->createFile(subFilePath($dirPath,$_GET['filename']));
                echo "<script>history.go(-1);</script>";
                break;
			case 'del':
                $action = 'del';
                $onlineEditor->delFile(subFilePath($dirPath,$_GET['filename']));
//				echo subFilePath($dirPath,$_GET['filename']);
                echo "<script>history.go(-1);</script>";
				break;
		}
	} else{
		$action = null;
	}

	if(array_key_exists('action', $_POST)){
		switch ($_POST['action']) {
			case 'create':
				$onlineEditor->createFile(subFilePath($dirPath,$_POST['filename']));
				echo "<script>location.href = 'index.php';</script>";
				break;
		}
	}

	//获取文件内容
	if(array_key_exists('filename', $_GET) && ($_GET['action'] == 'updata'||$_GET['action'] == 'look')){
	    $root = subFilePath(rtrim($dirPath,'/').'/',$_GET['filename']);
		$fileContent = $onlineEditor -> getContent($root);
		//echo "<pre style='font-size: 16px'>$fileContent</pre>";die();
	} else
		$fileContent = "坚持就是胜利";
	if (array_key_exists('filecontent', $_POST)) {
		// var_dump($_POST);
        $fileContent = str_replace('textarea_replace','textarea',$_POST['filecontent']);
		$onlineEditor->putContent(subFilePath($dirPath,$_POST['filename']),$fileContent);
		echo "<script>history.go(-2);</script>";
	}	


	//引入界面
	require "viewEditor.html";

	// print_r($fileMes);

?>