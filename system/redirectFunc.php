<?php
/**
 * Created by PhpStorm.
 * User: muming
 * Date: 2018/10/27
 * Time: 9:22
 */

function redirect($url, $msg)
{
   // echo $msg.'<a href = "'.$url.'">如果没有跳转，请点击这里跳转</a>';
    header("refresh:3;url = $url");
}