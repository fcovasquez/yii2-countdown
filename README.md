This is a modified version of russ666/yii2-countdown.

Includes additional config parameters for widget initialization.

Installation
================

download
-----------------------
Download [latest version](https://github.com/fcovasquez/yii2-countdown/releases/latest)

composer
-----------------------
add this line to your composer.json
`"fcovasquez/yii2-countdown": "*"`

Usage
================

```php
echo \fcovasquez\widgets\Countdown::widget([
    'datetime' => date('Y-m-d H:i:s', time() + 1000),
    'config' => ['elapse' => true, 'precision' => , 'defer' => false,],
    'format' => '%M:%S',
    'events' => [
        'finish' => 'function(){location.reload()}',
    ],
])
```

Params
================

datetime
-----------------------
Datetime string to countdown. Must be added with timezone, to prevent client-server timezone difference issue.

config
-----------------------
Configuration object for widget (http://hilios.github.io/jQuery.countdown/documentation.html#introduction)

events
-----------------------
Widget events (http://hilios.github.io/jQuery.countdown/documentation.html#events)

Plugin pages
================
Homepage - http://hilios.github.io/jQuery.countdown

GitHub - https://github.com/hilios/jQuery.countdown
