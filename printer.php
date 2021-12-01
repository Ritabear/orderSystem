<?php

$cht_string = '我要用中文';
$cht_string = iconv(mb_detect_encoding($cht_string), 'UTF-8', $cht_string);
$cht_big5 = iconv(mb_detect_encoding($cht_string), 'BIG-5', $cht_string);

// 192.168.1.14:80 網路印表機 IP
$host = '192.168.1.14';
$port = 80; //default listening port for printer
$message = ' Hello, world'.$cht_string.$cht_big5.' ';

// create socket
// 0, IP
// SOL_TCP = specify protocol of TCP, UDP, FTP ...

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if (!$socket) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    socket_close($socket);
    die("Could not create socket: [$errorcode] $errormsg\n");
}
// connect to server
$result = socket_connect($socket, $host, $port);
if (!$result) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    socket_close($socket);
    die("Could not connect to server: [$errorcode] $errormsg\n");
}
// send string to server
$socket_wrt = socket_write($socket, $message, strlen($message));
if (!$socket_wrt) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    socket_close($socket);
    die("Could not send data to server: [$errorcode] $errormsg\n");
}
echo 'Reply From Server:'.$result;
// close socket
socket_close($socket);
