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

## class.serverLoad.php

AVG Ping services class

```php
 $load = new serverLoad( array('label'=>'anatema','refresh'=>10) );
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([ <? echo $load->__getJson(); ?> ]);
        var options = {
          title: 'Server Load Averages: <?php echo $load->__getTitle(); ?> - Current Load: <?php echo $load->__getCurrentLoad(); ?>',
          hAxis: {title: 'Server Time', titleTextStyle: {color: 'red'}}
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
</script>
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

##simple translate

Call $URL/translate.php?words=YOUR-PHRASE and Enjoy

# Bash

## cryd

Decrypt with openssl

## crye

Encrypt and shred

