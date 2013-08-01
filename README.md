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

```php
 $array = array( 'mercury'=>'mercury.grayhats.org', 'main'=>'www.grayhats.org');
 $ping = new ping( $array ); 
 echo $ping->__tostring();
```

