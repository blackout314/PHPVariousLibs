<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$words = substr($_GET['words'], 0, 100);
$words = urlencode($_GET['words']);

$cmd = 'wget -q -U Mozilla -O audio.mp3 "http://translate.google.com/translate_tts?ie=UTF-8&tl=en&q=';
system($cmd.''.$words.'"');
?>
 
<audio controls="controls" autoplay="autoplay">
  <source src="audio.mp3" type="audio/mp3" />
</audio>
