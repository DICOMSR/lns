<?php
class Dispatcher{
	public function dispatch(){
		// URLを分解
		$sParameter	= $_SERVER['REQUEST_URI'];
		$aParameter	= [];
		
		if( $sParameter != '' ){
			$aParameter	= explode('/',$sParameter);
		} else {
			// TODO エラー処理
		}
		
		// クラスの存在確認
		$sController	= $aParameter[1] . "Controller";
		
		if( !file_exists(PATH_CONTROLLER . $sController . ".php") ){
			// 存在しなければTopに飛ばす
			header('Location: /index.html');
			exit;
		}
		
		
		require_once( PATH_CONTROLLER . $sController . ".php" );
		
		if( class_exists( $sController ) ){
			$oController	= new $sController();
			
			$sAction	= $aParameter[2];
			
			// 処理実行
			$oController->$sAction();
			
		}else{
			// TODO エラー処理
		}
	}
}