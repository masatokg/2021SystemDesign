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

	// データベースに接続する処理。
	// 環境に応じて以下の変数を書き換えます。
	$host = "localhost";	// 接続先ホスト名
	$user = "root";			// 接続ユーザ名
	$pass = "";				// 接続パスワード
	$dbname = "ec";			// データベース名
	if( !$conn = mysql_connect( $host, $user, $pass ) ) 
	{
		die("MySQL 接続エラー");
	}
	mysql_select_db( $dbname );
	mysql_set_charset('utf8');		// 文字コードを指定します。

	$sql = "SELECT * FROM m_items WHERE del_flag = '0' ";

// -- 以下、商品名で絞込み検索を行うために、SQL 文に条件を追加しましょう。


	// もしも「管楽器」「弦楽器」「打楽器」のいずれかのチェックボックスに
	// チェックが入っていた場合、以下の if 文に入ります。
	if( $_REQUEST['cat_kan'] == "1" || 
		$_REQUEST['cat_gen'] == "1" || 
		$_REQUEST['cat_da'] == "1" )
	{
		$in = "";
		if( $_REQUEST['cat_kan'] == "1" )
		{
			$in = $in . "1,";
		}
		if( $_REQUEST['cat_gen'] == "1" )
		{
			$in = $in . "2,";
		}
		if( $_REQUEST['cat_da'] == "1" )
		{
			$in = $in . "3,";
		}
		$in = preg_replace( "/,$/", "", $in );
		$sql = $sql . " AND category IN ( $in ) ";
	}
	$res = mysql_query( $sql );
	while( $item = mysql_fetch_array( $res ) ) {
?>
              <dl class="products">
                <dt><a href="item_detail.php"><img src="img/thumb/<?php print( $item["image"] ); ?>" alt="" /><br />
                <?php print( $item["item_name"] ); ?></a></dt>
                <dd>&yen;<?php print( $item["price"] ); ?></dd>
              </dl>
<?php
	}
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

    <!-- 左メニュー -->
    <div id="leftbox">
      <h1><img src="common/img/title.gif" alt="oh yeah!!" /></h1>
      <div id="menu">
        <!-- ログインフォーム（非ログイン時） -->
        <div class="box">
          <div class="top"><img src="common/img/t1.gif" alt="ログイン" /></div>
          <dl class="clearfix">
            <dt><img src="common/img/t4.gif" alt="ID" /></dt>
            <dd>
              <input name="id2" type="text" class="text" />
            </dd>
            <dt><img src="common/img/t5.gif" alt="PASS" /></dt>
            <dd>
              <input name="id" type="password" class="text" />
            </dd>
          </dl>
          <div class="bottom">
            <input name="id3" type="submit" value="ログイン" />
            <!--
        <input name="id3" type="image" class="bt" value="ログイン" src="common/img/bt_login.gif" alt="ログイン" />
-->
          </div>
        </div>
        <!-- /ログインフォーム -->
        <!-- ウェルカム（ログイン時） -->
        <!--
        <div class="box">
          <div class="top">ようこそ<span class="person">大家</span>さん！</div>
          <div class="bottom">
            <input name="id3" type="submit" value="ログアウト" />
            <!-- 
            <input name="id3" type="image" class="bt" src="common/img/bt_logout.gif" alt="ログアウト" />
          </div>
        </div>
-->
        <!-- /ウェルカム -->
        <!-- 商品検索 -->
        <form name="login_form" action="item_list.php" method="post">
        <div class="box" id="search">
          <div class="top"><img src="common/img/t2.gif" alt="商品検索" /></div>
          <dl class="clearfix">
            <dt><img src="common/img/t6.gif" alt="商品名" width="32" height="18" /></dt>
            <dd>
              <input type="text" name="item_name" class="text" value="<?php print($_REQUEST["item_name"])?>"/>
            </dd>
          </dl>
          <dl class="clearfix cat">
            <dt><img src="common/img/t7.gif" alt="カテゴリ" /></dt>
            <dd>
              <input type="checkbox" name="cat_kan" value="1" <?php if( $_REQUEST["cat_kan"] == "1" ){ print("checked"); } ?>/>
              管楽器<br />
              <input type="checkbox" name="cat_gen" value="1" <?php if( $_REQUEST["cat_gen"] == "1" ){ print("checked"); } ?>/>
              弦楽器<br />
              <input type="checkbox" name="cat_da" value="1" <?php if( $_REQUEST["cat_da"] == "1" ){ print("checked"); } ?>/>
              打楽器 </dd>
          </dl>
          <div class="bottom">
            <input name="id3" type="submit" value="検索" />
          </div>
        </div>
        </form>
        <!-- 商品検索 -->
        
        <!-- 共通メニュー -->
        <ul class="menu">
          <li><a href="item_list.php"><img src="common/img/bt1.gif" alt="商品一覧" name="Image1" width="172" height="38" id="Image1" onmouseover="MM_swapImage('Image1','','common/img/bt1_f2.gif',1)" onmouseout="MM_swapImgRestore()" /></a></li>
          <li><a href="cart.php"><img src="common/img/bt2.gif" alt="カートの中" name="Image2" width="172" height="38" id="Image2" onmouseover="MM_swapImage('Image2','','common/img/bt2_f2.gif',1)" onmouseout="MM_swapImgRestore()" /></a></li>
          <!-- ログイン時 -->
          <!--
          <li><a href="member.php"><img src="common/img/bt3.gif" alt="会員情報" name="Image3" width="172" height="38" id="Image3" onmouseover="MM_swapImage('Image3','','common/img/bt3_f2.gif',1)" onmouseout="MM_swapImgRestore()" /></a></li>
-->
          <!-- 非ログイン時 -->
          <li><a href="member.php"><img src="common/img/bt3_2.gif" alt="会員情報" name="Image4" width="172" height="38" id="Image4" onmouseover="MM_swapImage('Image4','','common/img/bt3_2_f2.gif',1)" onmouseout="MM_swapImgRestore()" /></a></li>
        </ul>
        <!-- /共通メニュー -->
      </div>
    </div>
    <!-- /左メニュー -->
   
  </div>
</div>
</body>
</html>
