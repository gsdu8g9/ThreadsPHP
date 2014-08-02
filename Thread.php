<?php

class Thread
{
    private $name;
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function run()
    {
        $fopen = fopen('see_threads_work', 'a');
        fputs($fopen, $this->name . PHP_EOL);
        sleep(20);
    }
}
foreach (range(1,10) as $main) {
    usleep(10000);
    echo `php mainthread.php $main`;
    echo '____________________________________________________________' . PHP_EOL;
}