<?php
$txindex = '4a2b214936425a2a6845b61c75d8cca7f57d0eded04d09064c986883b3fc9a7d';

function check_tx_by_index($txindex, $srcaddr){
  $url  = "http://blockchain.info/tx-index/".$txindex."?format=json";
  $data = json_decode( file_get_contents($url) );
  $confirm = (int)file_get_contents( 'https://blockchain.info/q/getblockcount' );
  $out  = array();
  $confirmed = $confirm - (int)$data->block_height;

  foreach ($data->out as $in){
    if (array_key_exists("addr", $in) && $in->addr==$srcaddr) {
      $out = array( 'value' => $in->value, 'n' => $in->n, 'bh' => $confirmed );
      return $out;
    }
  }
}

echo print_r( check_tx_by_index( $txindex,  '13vHWR3iLsHeYwT42RnuKYNBoVPrKKZgRv') );
