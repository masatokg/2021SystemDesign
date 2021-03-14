<?php
	session_start();
	// database.php の読み込み
	require_once("include/database.php");
	global $is_login;
	$is_login = 0;
	/**-----------------------------------------------------------
	 *
	 * 【ログイン処理(1)】
	 * 画面左側の「ログイン」ボタンが押された時にこの if 文に入ります。
	 *
	 ------------------------------------------------------------*/
	if( isset($_REQUEST["cmd"]) && $_REQUEST["cmd"] == "do_login" 
	&& isset($_REQUEST["login_id"]) && isset($_REQUEST["login_pass"])
	)
	{
		$sql = "SELECT * FROM m_customers ";
		$sql.= "WHERE customer_code = :ccd ";
		$sql.= "AND pass= :pass";

		$statement = $pdo->prepare( $sql );

		$statement->bindValue(':ccd', $_REQUEST["login_id"]);
		$statement->bindValue(':pass', $_REQUEST["login_pass"]);

		$res = $statement->execute();

		// $res = $stmt->execute(
		// 	array(
		// 		$_REQUEST["login_id"] ,
		// 		$_REQUEST["login_pass"]
		// 	)
		// );
		$is_login = 0;
		// 検索結果が取れた場合(つまり、ログインに成功した場合)以下の if 文に入る。
		// if( $row = $res->fetchRow( MDB2_FETCHMODE_ASSOC ) ) 
		// {
		// 	$_SESSION["customer_code"] = $_REQUEST["login_id"];
		// 	$_SESSION["name"] = $row["name"];
		// 	$is_login = 1;
		// }
		if( $res ) 
		{
			$user = $statement->fetch();
			$_SESSION["customer_code"] = $user["customer_code"];
			$_SESSION["name"] = $user["name"];
			$is_login = 1;
		}
		// $res->free();
		$res = null;
	}

	/**-----------------------------------------------------------
	 *
	 * 【ログイン処理(2)】
	 * ログイン後に、画面左側の「ログアウト」ボタンが押された時に
	 * この if 文に入ります。unset 命令は変数の中身を破棄する命令です。
	 *
	 ------------------------------------------------------------*/
	if( isset($_REQUEST["cmd"]) && $_REQUEST["cmd"] == "do_logout" )
	{
		$_SESSION = array();
		if ( isset( $_COOKIE[ session_name( ) ] ) ) 
		{
		    setcookie( session_name(), '', time( ) - 42000, '/');
		}
		$is_login = 0;
		session_destroy();
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>商品一覧｜楽器の通販サイト 博多音楽堂 !!</title>
<link href="common/css/base.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="common/js/base.js"></script>
</head>
<body onload="MM_preloadImages('common/img/bt1_f2.gif','common/img/bt2_f2.gif','common/img/bt3_f2.gif','common/img/bt3_2_f2.gif','common/img/bt_login_f2.gif')">
<div id="wrap">
  <div id="contents">
    <!-- 右コンテンツ -->
    <div id="rightbox">
      <div id="main">
        <div id="main2">
        <!-- ↑↑タイトル以外共通部分↑↑ -->
        
          <!-- メイン部分 各ページごとに作成-->
          <div id="mainbox" class="clearfix">
            <h2>商品一覧</h2>
            <!-- 商品リスト -->
            <div class="list clearfix">
<?php

	$sql = "SELECT * FROM m_items WHERE del_flag = '0' ";

	if( isset($_REQUEST["item_name"]) && $_REQUEST["item_name"] != "" )
	{
		// 正しくは「%」「_」もエスケープする必要があります。
		// $sql = $sql . " AND item_name LIKE '%". $mdb2->escape( $_REQUEST["item_name"] ) . "%' ";
		$sql = $sql . " AND item_name LIKE '%". ":item_name" . "%' ";
		$statement = $pdo->prepare( $sql );
		$statement->bindValue(':item_name', $_REQUEST["item_name"]);
	}

	// もしも「管楽器」「弦楽器」「打楽器」のいずれかのチェックボックスに
	// チェックが入っていた場合、以下の if 文に入ります。
	if( (isset($_REQUEST["cat_kan"]) && $_REQUEST["cat_kan"] == "1") || 
		(isset($_REQUEST["cat_gen"]) && $_REQUEST["cat_gen"] == "1") || 
		(isset($_REQUEST["cat_da"]) && $_REQUEST["cat_da"] == "1") )
	{
		$in = "";
		if( isset($_REQUEST["cat_kan"]) && $_REQUEST["cat_kan"] == "1" )
		{
			$in = $in . "1,";
		}
		if( isset($_REQUEST["cat_gen"]) && $_REQUEST["cat_gen"] == "1" )
		{
			$in = $in . "2,";
		}
		if( isset($_REQUEST["cat_da"]) && $_REQUEST["cat_da"] == "1" )
		{
			$in = $in . "3,";
		}
		$in = preg_replace( "/,$/", "", $in );
		$sql = $sql . " AND category IN ( $in ) ";
	}
	// $res = $mdb2->query( $sql );
	$statement = $pdo->prepare( $sql );
	$res = $statement->execute();
	$items = $statement->fetchAll();
	foreach( $items as $item ) 
	{
?>
              <dl class="products">
                <dt><a href="item_detail.php?code=<?php print( $item["item_code"] ); ?>"><img src="common/img/thumb/<?php print( $item["image"] ); ?>" alt="" /><br />
                <?php print( $item["item_name"] ); ?></a></dt>
                <dd>&yen;<?php print( $item["price"] ); ?></dd>
              </dl>
<?php
	}
	// $res->free();
	// $mdb2->disconnect( );
	$res = null;
	$pdo = null;
?>
            </div>
            <!-- /商品リスト -->
          </div>
          <!-- /メイン部分 各ページごとに作成-->

          <!-- ↓↓共通部分↓↓ -->
          <!-- フッター -->
          <div id="footer">
            <p class="copy">Copyright &copy; 2008 oh yeah !! All Rights Reserved.</p>
          </div>
          <!-- /フッター -->
        </div>
        <!-- /メイン部分 -->
      </div>
    </div>
    <!-- 右コンテンツ -->
<?php
	// database.php の読み込み
	require_once("include/left_pane.php");
?>
  </div>
</div>
</body>
</html>
