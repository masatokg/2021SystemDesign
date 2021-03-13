<?php
	session_start();
	// database.php の読み込み
	require_once("include/database.php");

	/**-----------------------------------------------------------
	 *
	 * 【ログイン処理(1)】
	 * 画面左側の「ログイン」ボタンが押された時にこの if 文に入ります。
	 *
	 ------------------------------------------------------------*/
	if( $_REQUEST["cmd"] == "do_login" )
	{
		$sql = "SELECT * FROM m_customers ";
		$sql.= "WHERE customer_code = ? ";
		$sql.= "AND pass=? ";

		$stmt = $mdb2->prepare( $sql );
		$res = $stmt->execute(
			array(
				$_REQUEST["login_id"] ,
				$_REQUEST["login_pass"]
			)
		);
		$is_login = 0;
		// 検索結果が取れた場合(つまり、ログインに成功した場合)以下の if 文に入る。
		if( $row = $res->fetchRow( MDB2_FETCHMODE_ASSOC ) ) 
		{
			$_SESSION["customer_code"] = $_REQUEST["login_id"];
			$_SESSION["name"] = $row["name"];
			$is_login = 1;
		}
		$res->free();
	}

	/**-----------------------------------------------------------
	 *
	 * 【ログイン処理(2)】
	 * ログイン後に、画面左側の「ログアウト」ボタンが押された時に
	 * この if 文に入ります。
	 *
	 ------------------------------------------------------------*/
	if( $_REQUEST["cmd"] == "do_logout" )
	{
		$_SESSION = array();
		if ( isset( $_COOKIE[ session_name( ) ] ) ) 
		{
		    setcookie( session_name(), "", time( ) - 42000, "/");
		}
		session_destroy();
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>商品一覧｜楽器の通販サイト  oh yeah !!</title>
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

	if( $_REQUEST["item_name"] != "" )
	{
		// 正しくは「%」「_」もエスケープする必要があります。
		$sql = $sql . " AND item_name LIKE '%". $mdb2->escape( $_REQUEST["item_name"] ) . "%' ";
	}

	// もしも「管楽器」「弦楽器」「打楽器」のいずれかのチェックボックスに
	// チェックが入っていた場合、以下の if 文に入ります。
	if( $_REQUEST["cat_kan"] == "1" || 
		$_REQUEST["cat_gen"] == "1" || 
		$_REQUEST["cat_da"] == "1" )
	{
		$in = "";
		if( $_REQUEST["cat_kan"] == "1" )
		{
			$in = $in . "1,";
		}
		if( $_REQUEST["cat_gen"] == "1" )
		{
			$in = $in . "2,";
		}
		if( $_REQUEST["cat_da"] == "1" )
		{
			$in = $in . "3,";
		}
		$in = preg_replace( "/,$/", "", $in );
		$sql = $sql . " AND category IN ( $in ) ";
	}
	$res = $mdb2->query( $sql );
	while( $item = $res->fetchRow( MDB2_FETCHMODE_ASSOC ) ) 
	{
?>
              <dl class="products">
                <dt><a href="item_detail.php?code=<?php print( htmlspecialchars( $item["item_code"] ) ); ?>"><img src="img/thumb/<?php print( htmlspecialchars( $item["image"], ENT_QUOTES ) ); ?>" alt="" /><br />
                <?php print( htmlspecialchars( $item["item_name"], ENT_QUOTES ) ); ?></a></dt>
                <dd>&yen;<?php print( htmlspecialchars( $item["price"], ENT_QUOTES ) ); ?></dd>
              </dl>
<?php
	}
	$res->free();
	$mdb2->disconnect( );
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
