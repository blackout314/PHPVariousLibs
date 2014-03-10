<?php

/**
 * @class
 * @name openweather
 * @desc retrieve forecast info
 * @author carlo "blackout" denaro <carlo.denaro@gmail.com>
 *
 * $citta	= 'bologna,it';
 * $forecast 	= new openweather( $citta, 'day' );
 * echo 	$forecast->__getTemp( $citta );
 */
class openweather {
	private $TEMPCORRECTION = 273.15;
	private $URL_TODAY = 'http://api.openweathermap.org/data/2.5/weather?lang=it&q=';
	private $URL_FORECAST = 'http://api.openweathermap.org/data/2.1/forecast/city?mode=daily_compact&q=';
	private $_OUTPUT;
	/**
	 * @desc constructor
	 * @param {Array|String} params array of cities or single city
	 * @param [String] type day|forecast
	 */
	public function __construct( $params, $type='day' ) {
		switch( $type ) {
			case 'day':
				$link = $this->URL_TODAY;
				break;
			case 'forecast':
				$link = $this->URL_FORECAST;
				break;
		}
		if( is_array($params) ) {
			foreach ($params as $param) {
			    $this->_OUTPUT[ $param ] = json_decode( file_get_contents( $link.$param ) );
			}
		}else{
			$this->_OUTPUT[ $params ] = json_decode( file_get_contents( $link.$params ) );
		}
	}
	/**
	 * @name __getTemp
	 * @desc return corrected temp 
	 * @param {String} city name of city 
	 * @return {String} temp temperature
	 */
	public function __getTemp( $city ) {
		return ( $this->_OUTPUT[ $city ]->main->temp - $this->TEMPCORRECTION );
	}
	/**
	 * @name __getHum
	 * @desc return hum
	 * @param {String} city name of city 
	 * @return {String} humidity
	 */
	public function __getHum( $city ) {
		return $this->_OUTPUT[ $city ]->main->humidity;
	}
	/**
	 * @name __getPress
	 * @desc return pressure 
	 * @param {String} city name of city 
	 * @return {String} pressure 
	 */
	public function __getPress( $city ) {
		return $this->_OUTPUT[ $city ]->main->pressure;
	}
}
/**
 * -- eof
 */

?>
