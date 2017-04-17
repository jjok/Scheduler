Scheduler
=========

An emulation of my central heating controller.

Start with a configuration file:

    ---

    Monday:
      - 06:00:00 - 08:00:00
      - 18:00:00 - 23:00:00

    Tuesday:
      - 06:00:00 - 08:00:00
      - 18:00:00 - 22:00:00

Load the file into a schedule:

```
use jjok\Scheduler\Weekly\ScheduleFactory as WeeklyScheduleFactory;
use Symfony\Component\Yaml\Yaml;


$factory = new WeeklyScheduleFactory();
$schedule = $factory->create(
    Yaml::parse(file_get_contents('test.yml'))
);

var_dump($schedule->isOnAt(DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-17 05:59:59'))); // bool(false)
var_dump($schedule->isOnAt(DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-17 06:00:00'))); // bool(true)

```

Run Tests
---------

    ./vendor/bin/phpunit
