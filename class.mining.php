<?php

/**
 * @class
 * @name mining 
 * @desc retrieve btc mining info
 * @author carlo "blackout" denaro <carlo.denaro@gmail.com>
 *
 * $btc = new mining( 'YOUR-API-KEY', 'slush' );
 * echo $btc->__getReward();
 */
class mining {
	private $api;
	private $service;
	private $output;
	/**
	 * @desc constructor
	 * @param {String} api api key 
	 * @param {String} service service type [slush]
	 */
	public function __construct( $api, $service ) {
		$this->api 	= $api;
		$this->service 	= $service;
		$this->__process();
	}
	private function __process() {
		switch( $this->service ) {
			case 'slush':
				$data = json_decode( file_get_contents( 'https://mining.bitcoin.cz/accounts/profile/json/' . $this->api ) );
				$this->output = array();
				$this->output['earn'] = $data->confirmed_reward + $data->unconfirmed_reward;
				$this->output['hash'] = $data->hashrate;
				foreach( $data->workers as $k=>$v ) {
					$this->output['w'][ $k ] = array(
						'hash' => $v->hashrate,
						'alive'=> $v->alive
					);
				}
			break;
		}
	}
	/**
	 * @desc return reward
	 * @return String total earn
	 */
	public function __getReward() {
		return $this->output['earn'];
	}
	/**
	 * @desc return current hashrate
	 * @return String current hashrate
	 */
	public function __getHashrate() {
		return $this->output['hash'];
	}
	/**
	 * @desc return all workers
	 * @return Array all workers with hashrate and alive(bool)
	 */
	public function __getWorkers() {
		return $this->output['w'];
	}
}

?>
