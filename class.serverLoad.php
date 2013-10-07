<?php

/**
 * @class
 * @name serverLoad 
 * @desc retrieve server load info with <atsar>
 * @author carlo "blackout" denaro <carlo.denaro@gmail.com>
 *
 * $load = new serverLoad( array('label'=>'anatema','refresh'=>10) );
 */
class serverLoad {
	private $_label;
	private $_refresh;
	private $_currentLoad;
	/**
	 * @desc constructor
	 * @param {Array} options
	 * @param {Array} options['refresh'] refresh time in minuts
	 * @param {Array} options['label'] preferred label
	 */
	public function __construct( $options = array() ) {
		$this->_refresh = ( $options['refresh'] ) ? $options['refresh'] : 10;
		$this->_label	= ( $options['label'] ) ? $options['label'] : null;
	}
	/**
	 * @desc return json stats
	 * @return JSON stats
	 */
	public function __getJson() {
		$loadResults	= '';
		$nowLoadAvg	= sys_getloadavg();
		$titles 	= "['Time', 'Load'],";
		$nowLoad	= "['Now',".$nowLoadAvg[0]."]";

		@exec("sar -P 2>&1", $loadstats );
		$this->_label 	= ( $this->_label === null ) ? $loadstats[1] : $this->_label;
		$this->_currentLoad = $nowLoadAvg[0];
		foreach($loadstats as $k => $v ) {
			$loadstats[ $k ] = explode(" ",preg_replace('/(\s)+/', ' ', $v ));
			if ( ($k > 3) && ($k < count($loadstats)-1) ) {
				$loadResults .= "['" . substr($loadstats[ $k ][ 0 ], 0, -3) . "'," . $loadstats[ $k ][ 4 ] . "],";
			}
		}
		return $titles.$loadResults.$nowLoad;
	}
	/**
	 * @desc return title
	 * @return String server name
	 */
	public function __getTitle() {
		return ( $this->_label );		
	}
	/**
	 * @desc return current server load
	 * @return Float server load
	 */
	public function __getCurrentLoad() {
		return ( $this->_currentLoad );		
	}
	/**
	 * @desc return refresh time in seconds
	 * @return Int refresh time in seconds
	 */
	public function __getRefresh() {
		return ( $this->_refresh * 60 );
	}
}

?>
