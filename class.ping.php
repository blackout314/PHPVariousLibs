<?php

/**
 * @class
 * @name ping 
 * @desc ping average 
 * @author carlo "blackout" denaro <carlo.denaro@gmail.com>
 *
 * $array = array( 'mercury'=>'mercury.grayhats.org', 'main'=>'www.grayhats.org');
 * $ping = new ping( $array ); 
 * echo $ping->__tostring();
 */
class ping {
	private $BUFFER;
	/**
	 * @desc constructor
	 * @param {Array} array descr:host 
	 */
	public function __construct( $array ) {
		foreach( $array as $descr => $host ) {
			$cmd = "ping -c 1 " . $host . " | tail -1| awk -F '/' '{print $5}'";
			$this->BUFFER .= ' {"'.$descr . '":"' . exec( $cmd ) . '"},';
		}
	}
	/**
	 * @name __tostring
	 * @desc return processed avg ping 
	 * @return {String} all pings in json
	 */
	public function __tostring() {
		return '{ "ping":[' . substr($this->BUFFER,0,-1) . ']}';
	}
}
?>
