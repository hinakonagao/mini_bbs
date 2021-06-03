<?php
session_start();
require('dbconnect.php');

if(isset($_SESSION['id'])){
       //ログインしている人のidが記録されているか確認
  $id = $_REQUEST['id'];

  $messages = $db->prepare('SELECT * FROM posts WHERE id=?');
  $messages->execute(array($id));
  $message = $messages->fetch();
       //ログインしている人の書いたメッセージであるか確認する為、
       //まずはデータベースよりそのメッセージを取得する

  if($message['member_id'] == $_SESSION['id']){
       //データベースから取得したメンバーidとログインしているidが一致していれば、削除する
    $del = $db->prepare('DELETE FROM posts WHERE id=?');
    $del->execute(array($id));
  }
}

header('Location: index.php');
exit();
       //一致していなければindex.phpに移動し、このページを終了する
?>
