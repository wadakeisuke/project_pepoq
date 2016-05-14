<?php
  if ($facebook->getUser()) {
    try {
      $user = $facebook->api('/me','GET');
      print_r($user);
      exit();
    } catch(FacebookApiException $e) {
      //取得に失敗したら例外をキャッチしてエラーログに出力
      error_log($e->getType());
      error_log($e->getMessage());
    }
  }