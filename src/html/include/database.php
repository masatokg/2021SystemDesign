<?php 
//   // PEARインクルード
//   ini_set('include_path', '.:/home/users/0/watson.jp-aso-kuga/web/lib/share/pear');
//   // MDB2 ライブラリの読み込み
// require_once("MDB2.php");
?>
<?php

/*
	// エラー発生時の処理
	PEAR::setErrorHandling( PEAR_ERROR_CALLBACK, "handleError" );
	function handleError( $error )
	{
	    die("エラーが発生しました。管理者までお問い合わせ下さい。");
	}
*/

	// データベースへの接続
	// $dsn = array(
	//     "phptype"  => "mysql",
	//     "username" => "LAA1277801",
	//     "password" => "ecsample",
	//     "hostspec" => "mysql150.phy.lolipop.lan",
	//     "database" => "LAA1277801-ec",
	// );
	// $options = array(
	// 	'debug'       => 0,
	// 	'portability' => MDB2_PORTABILITY_ALL,
	// );

	/** MDB2からPDO利用に差し替え */
	// ドライバ呼び出しを使用して MySQL データベースに接続します
	$dsn = 'mysql:dbname=LAA1277801-ec;host=mysql150.phy.lolipop.lan;charset=utf8mb4';
	$user = 'LAA1277801';
	$password = 'ecsample';

	try {
		$pdo = new PDO($dsn, $user, $password);
		// echo "接続成功\n";
	} catch (PDOException $e) {
		echo "接続失敗: " . $e->getMessage() . "\n";
		exit();
	}

// $mdb2 = MDB2::connect( $dsn, $options );
// 	if (!is_object($mdb2)) {
// 		echo "DB接続失敗";
// 		return false;
// 	}

// 	if (PEAR::isError($mdb2)) {
// 		return false;
// 	}
// 	// // 文字コードの指定
// 	$mdb2->setCharset( "utf8" );
?>