<?php
/**
 * Created by PhpStorm.
 * User: muming
 * Date: 2018/11/3
 * Time: 12:14
 */
require("../../system/dbConn.php");
function getUsersDate($pageNum, $pageSize)
{
    $p = connect();
    $sql = "select * from users limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    $sql1 = 'select count(*) as number from users';

//    if ($kw != '') {
//        $rs = 'select * from users where uname like "%' . $kw . '%" limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
//        $rs1 = 'select count(*) as number from users where uname like "%' . $kw . '%"';
//    }
    $rs = mysqli_query($p, $sql);
    $c = mysqli_query($p, $sql1);

    $res = mysqli_fetch_assoc($c);

    return array($rs, intval($res['number'] / $pageSize) + 1);
}