<?php
	session_start();

	// database.php の読み込み
	require_once("include/database.php");

	/**-----------------------------------------------------------
	 *
	 * 会員登録画面で「更新」ボタンがクリックされた時の処理。
	 * ログイン状態に応じて、UPDATE または INSERT を実行する。
	 *
	 ------------------------------------------------------------*/
	if( $_REQUEST["cmd"] == "regist_member" )
	{
		if( $_SESSION["customer_code"] != "" )
		{
			$sql  = " UPDATE m_customers SET ";
			$sql .= " customer_code = ?,";
			$sql .= " pass = ?,";
			$sql .= " name = ?,";
			$sql .= " address = ?,";
			$sql .= " tel = ?,";
			$sql .= " mail = ?";
			$sql .= " WHERE customer_code = ? ";

			$stmt = $mdb2->prepare( $sql );
			$stmt->execute( 
				array(
					$_REQUEST["customer_code"],
					$_REQUEST["pass"],
					$_REQUEST["name"],
					$_REQUEST["address"],
					$_REQUEST["tel"],
					$_REQUEST["mail"],
					$_SESSION["customer_code"]
				)
			);
			$is_success = 1;
		}
		else
		{
			$sql = "INSERT INTO m_customers( customer_code, pass, name, address, tel, mail, del_flag, reg_date ) ";
			$sql .= "VALUES( ";
			$sql .= " ?, ";
			$sql .= " ?, ";
			$sql .= " ?, ";
			$sql .= " ?, ";
			$sql .= " ?, ";
			$sql .= " ?, ";
			$sql .= " '0', ";
			$sql .= " now() ) ";
			$stmt = $mdb2->prepare( $sql );
			$stmt->execute( 
				array(
					$_REQUEST["customer_code"],
					$_REQUEST["pass"],
					$_REQUEST["name"],
					$_REQUEST["address"],
					$_REQUEST["tel"],
					$_REQUEST["mail"],
				)
			);
			$is_success = 1;
		}
	}

	// ログイン済であれば、お客様の情報をデータベースより取得。
	if( $_SESSION["customer_code"] != "" )
	{
		$sql = " SELECT * FROM m_customers ";
		$sql.= " WHERE customer_code= ? ";

		$stmt = $mdb2->prepare( $sql );
		$res = $stmt->execute( array( $_SESSION["customer_code"] ) );

		$count = 0;
		$info = $res->fetchRow( MDB2_FETCHMODE_ASSOC );
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>登録情報｜楽器の通販サイト  oh yeah !!</title>
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
            <h2>登録情報</h2>

<?php
	if( $is_success == 1 )
	{
?>
			<br><p align="center">正常に処理が完了しました。</p>
<?php
	}
?>

            <form name="member_form" action="member.php" method="post">
            <input type="hidden" name="cmd" value="regist_member"/>
            <div class="info clearfix">
            <dl>
            <dt>ID：</dt>
            <dd><input type="text" name="customer_code" <?php if( $info["customer_code"] != "" ){ print( "readonly" ); } ?> value="<?php print( htmlspecialchars( $info["customer_code"], ENT_QUOTES ) ); ?>"/></dd>
            <dt>パスワード：</dt>
            <dd><input type="password" name="pass" value="<?php print( htmlspecialchars( $info["pass"] , ENT_QUOTES) ); ?>"/></dd>
            <dt>氏名：</dt>
            <dd><input type="text" name="name" value="<?php print( htmlspecialchars( $info["name"], ENT_QUOTES ) ); ?>"/></dd>
            <dt>住所：</dt>
            <dd><input type="text" name="address" value="<?php print( htmlspecialchars( $info["address"], ENT_QUOTES ) ); ?>"/></dd>
            <dt>電話：</dt>
            <dd><input type="text" name="tel" value="<?php print( htmlspecialchars( $info["tel"], ENT_QUOTES ) ); ?>"/></dd>
            <dt>アドレス：</dt>
            <dd><input type="text" name="mail" value="<?php print( htmlspecialchars(  $info["mail"], ENT_QUOTES ) ); ?>" size="30"/>
            </dd>
            </dl>
            <input type="submit" class="update" value="登録"/>
            </div>
            </form>
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
<?php
	// left_pane.php の読み込み
	require_once("include/left_pane.php");
?>
  </div>
</div>
</body>
</html>
