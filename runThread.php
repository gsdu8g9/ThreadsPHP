<?php
$code = $argv[1];
$checkCode = checkCode();
$isNeedSleep = $checkCode != getOrder($code) ? 'true' : 'false';
//echo microtime(1) . ' | START PROCESS ' . $code . PHP_EOL;
//exit();
print_r('STARTING PROCESS ' . $code . '   |  ' . microtime(1) . PHP_EOL);
print_r('code = ' . $code . PHP_EOL);
print_r('checkCode = ' . checkCode() . PHP_EOL);
print_r('order = ' .  getOrder($code) . PHP_EOL);
print_r('isNeedSleep = ' . $isNeedSleep . PHP_EOL);
print_r('------------------------------------------------------------------------' . PHP_EOL);
$countSleep = 0;
$canSleepTime = 100;
while( checkCode()!== getOrder($code) && $countSleep < $canSleepTime) {
    usleep(1000);
    $mt = microtime(1);
    echo "Process $code is sleeping | microtime $mt | $countSleep" . PHP_EOL;

    $countSleep++;
}
if ($countSleep >= $canSleepTime){
    exit("Process $code can't wait no more" . PHP_EOL . '******************************' . PHP_EOL);
}
writeCode($code);
function writeCode($code) {
    $sleepBeforeWrite = 10000;
    echo "Process $code will write after $sleepBeforeWrite micros | " . microtime(1) .PHP_EOL;
    //usleep($sleepBeforeWrite);
    file_put_contents('check', $code);
    echo "Process $code wrote code | " .microtime(1) .PHP_EOL;
    file_put_contents('see_threads_work', $code .PHP_EOL, FILE_APPEND);
    echo strtoupper("Process $code finished" . '   |  ' . microtime(1) . PHP_EOL . '*************'. PHP_EOL);
}
function checkCode(){
    $check = 'check';

    if (file_exists($check)) {
        return file_get_contents($check);
    }
    return $check;
}

function getOrder($code){
    $orders = [
        'thread_5' => 'check',
        'thread_4' => 'thread_5',
        'thread_3' => 'thread_4',
        'thread_2' => 'thread_3',
        'thread_1' => 'thread_2',
        'thread_main' => 'thread_1'
    ];
    if (isset($orders[$code])){
        return $orders[$code];
    }
    return null;
}
