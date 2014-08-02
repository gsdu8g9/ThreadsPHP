<?php
error_reporting(E_ALL);
file_put_contents('see_threads_work', '');
$_SESSION['main_thread'] = __FILE__;
$threadLine = '';
$str = __DIR__ . DIRECTORY_SEPARATOR;
$fileRun = 'runThread.php';
$process = 'start /B php ' . $fileRun . ' thread_main' ;
$processes = [];
foreach (range(1,5) as $threadName) {
    $process .= " & start /B php $fileRun thread_$threadName";
}
echo `$process`;
//exit();
unlink('check');
//unlink('see_threads_work');
$var = isset($argv[1]) ? $argv[1] : '';
file_put_contents('see_threads_work', 'MAIN THREAD ' . $var .' FINISHED' . PHP_EOL, FILE_APPEND);
echo file_get_contents('see_threads_work');