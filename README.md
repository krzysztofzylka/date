# Install
```bash
composer require krzysztofzylka/date
```

# Create instance
```php
$date = new \Krzysztofzylka\Date\Date();
```

# Static methods
## Create instance
```php
\Krzysztofzylka\Date\Date::create()
\Krzysztofzylka\Date\Date::create(time())
\Krzysztofzylka\Date\Date::create(date('Y-m-d H:i:s'))
\Krzysztofzylka\Date\Date::create(new DateTime())
```

# Method
## Gets
### Get time
```php
$date->getTime()
```
### Get date
```php
$date->getDate()
```
### Get day
```php
$date->getDay()
```
### Get month
```php
$date->getMonth()
```
### Get year
```php
$date->getYear()
```
### Get ISO8601 date format
```php
$date->getISO8601()
```
### Date difference
```php
$date = \Krzysztofzylka\Date\Date::create();
$date2 = \Krzysztofzylka\Date\Date::create($date)->addDay(1);
var_dump($date->getDifference($date2)); //['years' => 0, 'months' => 0, 'days' => 1, 'hours' => 0, 'minutes' => 0, 'seconds' => 0]
```
### Get weekday difference
```php
$date->getWeekdayDifference($date)
```

## Sets
### Set date
```php
$date->set(null)
$date->set(time())
$date->set(date('Y-m-d H:i:s'))
```

## Format
### Change default format (Y-m-d H:i:s)
```php
$date->format($format)
```

## Add
### Add second to date
```php
$date->addSecond($seconds)
```
### Add minute to date
```php
$date->addMinute($minutes)
```
### Add hours to date
```php
$date->addHour($hours)
```
### Add day to date
```php
$date->addDay($days)
```
### Add weeks to date
```php
$date->addWeek($weeks)
```
### Add month to date
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
### Add year to date
```php
$date->addYear($years)
```

## Subtract
### Subtract second from date
```php
$date->subSecond($seconds)
```
### Subtract minute from date
```php
$date->subMinute($minutes)
```
### Subtract hours from date
```php
$date->subHour($hours)
```
### Subtract day from date
```php
$date->subDay($days)
```
### Subtract weeks from date
```php
$date->subWeek($weeks)
```
### Subtract month from date
```php
$date->subMonth($months)
```
### Subtract year from date
```php
$date->subYear($years)
```

## Check
### Date is before
```php
$date->isBefore($date)
```
### Date is after
```php
$date->isAfter($date)
```
### Is equal
```php
$date->isEqual($date)
```
### Start of day
```php
$date->startOfDay()
```
### End of day
```php
$date->endOfDay()
```
### Is weekend
```php
$date->isWeekend()
```
### Is weekday
```php
$date->isWeekday()
```

# Utils
## Get date month difference
```php
\Krzysztofzylka\Date\DateUtils::dateMonthDifference($dateFrom, $dateTo)
```
## Get simple date
```php
\Krzysztofzylka\Date\DateUtils::getSimpleDate()
\Krzysztofzylka\Date\DateUtils::getSimpleDate(true) //with microseconds
```
## Get seconds to date
```php
\Krzysztofzylka\Date\DateUtils::getSecondsToDate($seconds)
```
## Date difference
```php
$date = \Krzysztofzylka\Date\Date::create();
$date2 = \Krzysztofzylka\Date\Date::create($date)->addDay(1);
var_dump(\Krzysztofzylka\Date\DateUtils::getDifference($date, $date2)); //['years' => 0, 'months' => 0, 'days' => 1, 'hours' => 0, 'minutes' => 0, 'seconds' => 0]
```