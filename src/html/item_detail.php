<?php
	session_start(); 
	// database.php の読み込み
	require_once("include/database.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>商品詳細｜楽器の通販サイト  oh yeah !!</title>
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
<?php

	// 以下の $sql 変数に適切な SELECT 文を記述し、
	// 一覧画面から画面遷移できるようにして下さい。
	// $sql = "select * from m_items where item_code = ? ";
	// $stmt = $mdb2->prepare( $sql );
	// $res = $stmt->execute(
	// 	array( $_REQUEST["code"] )
	// );
	$sql = "select * from m_items where item_code = :item_code ";
  $statement = $pdo->prepare( $sql );
  // echo($sql);
  // print($_REQUEST["code"]);
  $statement->bindValue(':item_code', $_REQUEST["code"]);
  // $statement->bindValue(':item_code', 1001);
	
  $statement->execute();
  while( $item = $statement->fetch( ) )
	// if( $item = $res->fetchRow( MDB2_FETCHMODE_ASSOC ) ) 
	{
?>
          <form name="detail_form" action="cart.php" method="get">
          <input type="hidden" name="cmd" value="add_cart"/>
          <input type="hidden" name="code" value="<?php print( htmlspecialchars( $item["item_code"] ) ); ?>"/>
          <!-- メイン部分 各ページごとに作成-->
          <div id="mainbox" class="clearfix">
            <h2>商品詳細</h2>
            <div class="list clearfix">
              <h3><?php print( htmlspecialchars( $item["item_name"] ) ); ?></h3>
              <p class="photo"><img src="common/img/<?php print( htmlspecialchars( $item["image"] ) ); ?>" width="400" height="400"/></p>
                <p class="text"><?php print( htmlspecialchars( $item["detail"] ) ); ?></p>
              <div class="buy">
                <p class="price">価格：<strong>&yen;<?php print( htmlspecialchars( $item["price"] ) ); ?></strong></p>
                個数：
                <select name="num">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
                <input type="submit" value="カートにいれる"/>
                <input type="button" value="前の画面へ戻る" onclick="history.back()"/>
              </div>
            </div>
          </div>
          </form>
          <!-- /メイン部分 各ページごとに作成-->
<?php
	}
	// $res->free();
	$res = null;
?>
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
	require_once("include/left_pane.php");
?>
  </div>
</div>
</body>
</html>
