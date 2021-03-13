<?php
	// MDB2 ライブラリの読み込み
	require_once("MDB2.php");

	// エラー発生時の処理
	PEAR::setErrorHandling( PEAR_ERROR_CALLBACK, "handleError" );
	function handleError( $error )
	{
	    die("エラーが発生しました。管理者までお問い合わせ下さい。");
	}

	// データベースへの接続
	$dsn = array(
	    "phptype"  => "mysql",
	    "username" => "root",
	    "password" => "",
	    "hostspec" => "localhost",
	    "database" => "ec",
	);
	$mdb2 =& MDB2::connect( $dsn, $options );

	// 文字コードの指定
	$mdb2->setCharset( "utf8" );
?>