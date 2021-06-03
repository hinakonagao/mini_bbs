<?php
session_start();

$_SESSION = array();
      //セッションの情報を削除するため、空の配列で上書きする

if(ini_set('session.use_cookies')){
      //ini_set以下、決まり文句
      //cookieの情報を削除する処理を書いていく
  $params = session_get_cookie_params();
  setcookie(session_name() . '', time() - 42000,
      //cookieの有効期限を切ることで、セッションを削除する
    $params['path'], $params['domain'], $params['secure'], $params['httponly']);
      //セッションが使ったオプションを指定し、セッションが使ったcookieを削除する
}
session_destroy();
      //セッションを完全に削除する

setcookie('email', '' , time()-3600);
      //ログアウトした際は、cookieに保存されているメールアドレスを削除して空の値を指定、有効期限も切る

header('Location: login.php');
exit();
?>
