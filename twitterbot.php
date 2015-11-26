<?php

function twit($user, $pwd, $status) {
  if (!function_exists("curl_init")) {
    die("twitterSetStatus needs CURL module, please install CURL on your php.");
  }

  $ch         = curl_init();

  curl_setopt($ch, CURLOPT_URL, "https://mobile.twitter.com/session/new");
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_FAILONERROR, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 5);
  curl_setopt($ch, CURLOPT_COOKIEJAR, "my_cookies.txt");
  curl_setopt($ch, CURLOPT_COOKIEFILE, "my_cookies.txt");
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420+ (KHTML, like Gecko) Version/3.0 Mobile/1A543a Safari/419.3 ");
  $page       = curl_exec($ch);

  preg_match("/input name=\"authenticity_token\" type=\"hidden\" value=\"(.*?)\"/", $page, $authenticity_token);

  $strpost    = "authenticity_token=".urlencode($authenticity_token[1])."&session[username_or_email]=".urlencode($user)."&session[password]=".urlencode($pwd);
  curl_setopt($ch, CURLOPT_URL, "https://mobile.twitter.com/sessions" );
  curl_setopt($ch, CURLOPT_POSTFIELDS, $strpost);
  $page       = curl_exec($ch);

  curl_setopt($ch, CURLOPT_URL, "https://mobile.twitter.com/compose/tweet" );
  $page       = curl_exec($ch);

  preg_match("/input name=\"authenticity_token\" type=\"hidden\" value=\"(.*?)\"/", $page, $authenticity_token);

  $strpost    = "csrf_id=".urlencode($authenticity_token[1]);
  $ar         = array("m5_csrf_tkn" => $authenticity_token[1], "tweet[text]"=>$status);
  $data       = http_build_query($ar);
  curl_setopt($ch, CURLOPT_URL, "https://mobile.twitter.com/api/tweet");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  $page       = curl_exec($ch);
}

