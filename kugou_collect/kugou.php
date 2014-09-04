<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 14-7-12
 * Time: 下午11:16
 */


require('kugou_singer_collection.php');

ini_set("max_execution_time", "300");  //设置脚本最大允许时间
$start_time = microtime(1);
$base_url = 'http://www.kugou.com/yy/singer/home/';
$singer = new kugou_singer_collection();

for($i = 1; $i< 5000;$i++){
    $singer->get_singer_from_remote_url("{$base_url}/{$i}.html");
}

$run_time  = microtime(1) - $start_time;
var_dump($run_time);