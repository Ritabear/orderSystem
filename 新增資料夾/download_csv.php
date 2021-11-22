<?php

$filename = $_GET['filename'];
$filepath = "csv/$filename.csv";
header('Content-type:application/force-download'); //告訴瀏覽器 為下載
header('Content-Transfer-Encoding: Binary'); //編碼方式
header('Content-Disposition:attachment;filename=orders.csv'); //輸出的檔名
readfile($filepath);
