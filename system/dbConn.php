<?php
/**
 * Created by PhpStorm.
 * User: muming
 * Date: 2018/10/27
 * Time: 9:16
 */

define('HOST', 'localhost');
define('USER', 'root');
define('PWD', 'root');
define('CHARSET', 'UTF8');
define('DATANAME', 'neuvideo');
define('PORT', '8889');

function connect()
{
    $link = mysqli_connect(HOST, USER, PWD,DATANAME,PORT) or die('数据库连接失败<br/>ERROR' . mysqli_error($link) . ':' . mysqli_error($link));
    mysqli_set_charset($link, CHARSET);
    mysqli_select_db($link, DATANAME) or die('打开数据库是失败' . mysqli_error($link));
    return $link;

}