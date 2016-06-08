<?php

$bot_token    = '';
$channelname  = '';
$before_text  = '';
$title        = '';
$url          = '';
$category     = '';
$date         = '';
$text         = '';
$after_text   = '';

$ch = curl_init(); 
curl_setopt( 
  $ch, 
  CURLOPT_URL, 
  "https://api.telegram.org/bot" . $bot_token . "/sendMessage?chat_id=" . $channelname . "&parse_mode=Markdown&disable_web_page_preview=false&text=" . urlencode( $before_text . "\n" . "[" . $title . "](" . $url . ")\n*" . $category . "* | _" . $date . "_\n" . $text . "\n" . $after_text ) 
); 
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 ); 
$output = curl_exec( $ch ); 
curl_close( $ch ); 

echo $output;
