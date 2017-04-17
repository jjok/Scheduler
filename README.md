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
use jjok\Scheduler\Day;
use jjok\Scheduler\Period;
use jjok\Scheduler\Time;
use jjok\Scheduler\WeeklySchedule;
use Symfony\Component\Yaml\Yaml;

require 'vendor/autoload.php';


$days = Yaml::parse(file_get_contents('test.yml'));

$week = [];
foreach ($days as $day => $period_values) {
    $periods = array_map(function($times) {
        list($start, $end) = sscanf($times, '%s - %s');

        return new Period(Time::fromString($start), Time::fromString($end));
    }, $period_values);

    $week[] = Day::$day($periods);
}

$schedule = new WeeklySchedule($week);

var_dump($schedule->isOnAt(DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-17 05:59:59'))); // bool(false)
var_dump($schedule->isOnAt(DateTime::createFromFormat('Y-m-d H:i:s', '2017-04-17 06:00:00'))); // bool(true)
```
