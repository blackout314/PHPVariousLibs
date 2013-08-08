<?php
/**
 * @class
 * @name who 
 * @desc show the online users 
 * @author carlo "blackout" denaro <carlo.denaro@gmail.com>
 *
 * $who = new who();
 * print_r( $who->__stats() );
 * print_r( $who->__get()   );
 * print_r( $who->__last()   );
 */
class who{
	private $_users;
	private $_account;
	/**
	 * @desc constructor
	 */
	public function __construct(){
		$lastli = exec( 'who', $return );
		foreach( $return as $user ){
			$array  = sscanf( $user, '%s %s %s %s %s' );
			$this->_users[ $array[0] ][ $array[1] ] = date_format( date_create( date('Y'). '-' . $array[2] . '-' . $array[3]. ' ' .$array[4].':00'), 'd-m-Y H:i' );
			$this->_account ++;
		}
	}
	/**
	 * @desc return users online 
	 * @return Array return users
	 */
	public function __get( $argv = NULL ){
		return $this->_users;
	}
	/**
	 * @desc return stat of users online 
	 * @return Array return stat of users online
	 */
	public function __stats(){
		return array( 'users' => count($this->_users), 'account' => $this->_account );
	}
	/**
	 * @desc show last logins 
	 * @param [number] show last logins
	 * @return Array return last logins 
	 */
	public function __last( $number=10 ){
		$lastli = exec( 'last', $return );
		$c = 1;
		foreach( $return as $login ){
			$array  = sscanf( $login, '%s %s %s %s %s %s %s %s %s %s' );
			$date = @date_format( date_create( date('Y'). '-' . $array[4] . '-' .$array[5]. ' ' .$array[6]), 'd-m-Y H:i' );
			if( $date != '' ){
				$buffer[] = array( 'user'=> $array[0], 'date' => $date );
				$c++;
			}
			if( $c==$number ) break;
		}
		return $buffer;
	}
}

?>
