PHPVariousLibs
==============

Librerie utili PHP

## class.openweather.php

Use openweather for retrieve forecast info

```php
$citta = 'bologna,it';
$forecast = new openweather( $citta, 'day' );
echo $forecast->__getTemp( $citta );
```

## class.ping.php

AVG Ping services class

```php
 $array = array( 'mercury'=>'mercury.grayhats.org', 'main'=>'www.grayhats.org');
 $ping = new ping( $array ); 
 echo $ping->__tostring();
```

##class.mining.php

Retrieve workers info (BTC mining)

```php
 $btc = new mining( 'YOUR-API-KEY', 'slush' );
 echo $btc->__getReward();
```

##class.who.php

Retrieve logged users' info

```php
 $who = new who();
 print_r( $who->__stats() );	// show stats
 print_r( $who->__get()   );	// show total users
 print_r( $who->__last()   );	// show last logins
```
