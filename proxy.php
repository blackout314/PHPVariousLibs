<?php

class Proxy
{
  private static $instance;
  private $url;
  private $user_agent;
  private $timeout;
  private $proxy_host;
  private $proxy_port;
  
  public static function getInstance()
  {
    if (!isset(self::$instance))
      self::$instance = new self;
      
    return self::$instance;
  }
  
  public function setProxy($proxy_host = '127.0.0.1', $proxy_port = '9050')
  {
    $this->proxy_host = $proxy_host;
    $this->proxy_port = $proxy_port;
  }
  
  public function request($url, $timeout = 60)
  {
    $this->url = $url;
    
    $this->setUserAgent();
    
    $this->timeout = $timeout;
      
    $this->setCurl();
  }
  
  private function __construct()
  {
    $this->url = null;
    $this->user_agent = null;
  }
  
  private function setUserAgent()
  {
    $this->user_agent = 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)';
  }
  
  private function setCurl($returnTransfer = 1)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_PROXYTYPE, 7 /* SOCKS5 */);
    curl_setopt($ch, CURLOPT_PROXY, $this->proxy_host.':'.$this->proxy_port);
    curl_setopt($ch, CURLOPT_URL, $this->url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, $returnTransfer); //0
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
    //curl_exec($ch);
    $content = curl_exec( $ch );
    curl_close($ch);
    echo $this->url. ' ';
    if(!$content) {
      echo "DEAD";
    } else {
      echo "ALIVE".$content;
    }
  }
}

$instance = Proxy::getInstance();
$instance->setProxy();
$instance->request('http://domain.onion/');

?>
