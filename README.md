# Install
```bash
composer require krzysztofzylka/date
```

# Create instance
```php
$date = new \Krzysztofzylka\Date\Date();
```

# Static methods
## Get simple date
```php
\Krzysztofzylka\Date\Date::getSimpleDate()
\Krzysztofzylka\Date\Date::getSimpleDate(true) //with microseconds
```
## Get seconds to date
```php
\Krzysztofzylka\Date\Date::getSecondsToDate($seconds)
```
## Create instance
```php
\Krzysztofzylka\Date\Date::create(null)
\Krzysztofzylka\Date\Date::create(time())
\Krzysztofzylka\Date\Date::create(date('Y-m-d H:i:s'))
```

# Method
## Get time
```php
$date->getTime()
```
## Get date
```php
$date->getDate()
```
## Set date
```php
$date->set(null)
$date->set(time())
$date->set(date('Y-m-d H:i:s'))
```
## Change default format (Y-m-d H:i:s)
```php
$date->format($format)
```
## Add second to date
```php
$date->addSecond($seconds)
```
## Add minute to date
```php
$date->addMinute($minutes)
```
## Add hours to date
```php
$date->addHour($hours)
```
## Add day to date
```php
$date->addDay($days)
```
## Add month to date
```php
$date->addMonth($months, $fixCalculate)
```
### Example
```php
$date = new \Krzysztofzylka\Date\Date('2024-03-31');
$date->addMonth(1);
echo $date->getDate('Y-m-d'); //2024-04-30

$date = new \Krzysztofzylka\Date\Date('2024-03-31', false);
$date->addMonth(1);
echo $date->getDate('Y-m-d'); //2024-05-01
```
## Add year to date
```php
$date->addYear($years)
```
## Subtract second from date
```php
$date->subSecond($seconds)
```
## Subtract minute from date
```php
$date->subMinute($minutes)
```
## Subtract hours from date
```php
$date->subHour($hours)
```
## Subtract day from date
```php
$date->subDay($days)
```
## Subtract month from date
```php
$date->subMonth($months)
```
## Subtract year from date
```php
$date->subYear($years)
```

# Utils
## Get date month difference
```php
\Krzysztofzylka\Date\DateUtils::dateMonthDifference($dateFrom, $dateTo)
```