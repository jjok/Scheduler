Switches
========

An emulation of my central heating controller.

[![Build Status](https://travis-ci.org/jjok/Switches.svg?branch=master)](https://travis-ci.org/jjok/Switches)

[![Code Climate](https://codeclimate.com/github/jjok/Switches/badges/gpa.svg)](https://codeclimate.com/github/jjok/Switches)


Start with a configuration file, maybe as YAML:

    ---

    Monday:
      - 06:00:00 - 08:00:00
      - 18:00:00 - 23:00:00

    Tuesday:
      - 06:00:00 - 08:00:00
      - 18:00:00 - 22:00:00


Convert it to an array:

```
use Symfony\Component\Yaml\Yaml;

$config = Yaml::parse(file_get_contents('schedule.yml'));
```


Load the file into a schedule:

```
use jjok\Switches\Weekly\ScheduleFactory as WeeklyScheduleFactory;

$config = array(
    'Monday' => array(
        '06:00:00 - 08:00:00',
        '18:00:00 - 23:00:00',
    ),
    'Tuesday' => array(
        '06:00:00 - 08:00:00',
        '18:00:00 - 22:00:00',
    )
);


$factory = new WeeklyScheduleFactory();
$schedule = $factory->create($config));

$monday_just_before_six = DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-17 05:59:59');
$monday_at_six = DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-17 06:00:00');

var_dump($schedule->isOnAt($monday_just_before_six)); // bool(false)
var_dump($schedule->isOnAt($monday_at_six)); // bool(true)
```

Run Tests
---------

    ./vendor/bin/phpunit
