<?php
/**
 * Created by PhpStorm.
 * User: muming
 * Date: 2018/11/3
 * Time: 12:14
 */
require("../../system/dbConn.php");
function getUsersDate($pageNum, $pageSize) //$kw
{
    $p = connect();
    $sql = "select * from users order by `uid` desc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    $sql1 = 'select count(*) as number from users';

//    if ($kw != '') {
//        $sql = 'select * from users where uname like "%' . $kw . '%" limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
//        sql1 = 'select count(*) as number from users where uname like "%' . $kw . '%"';
//    }
    $rs = mysqli_query($p, $sql);
    $c = mysqli_query($p, $sql1);

    $res = mysqli_fetch_assoc($c);

    return array($rs, intval($res['number'] / $pageSize) + 1);
}

function getRolesDate($pageNum, $pageSize)
{
    $p = connect();
    $sql = "select * from admins order by `adminid` desc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    $sql1 = 'select count(*) as number from admins';

//    if ($kw != '') {
//        $rs = 'select * from users where uname like "%' . $kw . '%" limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
//        $rs1 = 'select count(*) as number from users where uname like "%' . $kw . '%"';
//    }
    $rs = mysqli_query($p, $sql);
    $c = mysqli_query($p, $sql1);

    $res = mysqli_fetch_assoc($c);

    return array($rs, intval($res['number'] / $pageSize) + 1);
}

function getVideoDate($pageNum, $pageSize)
{
    $p = connect();
    $sql = "select * from videos order by `vid` desc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    $sql1 = 'select count(*) as number from videos';

    $rs = mysqli_query($p, $sql);
    $c = mysqli_query($p, $sql1);

    $res = mysqli_fetch_assoc($c);
    return array($rs, intval($res['number'] / $pageSize) + 1);
}

function getCommentDate($pageNum, $pageSize)
{
    $p = connect();
    $rs = "SELECT comments.cid as cid, comments.vid as vid,comments.uid as uid,comments.content as content ,videos.videoname as videoname,users.uname as uname ,comments.cdate as cdate FROM videos JOIN comments ON videos.vid = comments.vid  JOIN users ON comments.uid = users.uid order by `cid` desc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;

    $rs1 = 'select count(*) as number from comments';
//    if ($kw != '') {
//        $rs = 'SELECT comments.cid as cid,comments.vid as vid,comments.uid as uid,comments.content as content ,videos.videoname as videoname,users.uname as uname ,comments.cdate as cdate FROM videos JOIN comments ON videos.vid = comments.vid  JOIN users ON comments.uid = users.uid where content like "%' . $kw . '%" limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
//        $rs1 = 'SELECT count(*) as number FROM videos JOIN comments ON videos.vid = comments.vid  JOIN users ON comments.uid = users.uid where content like "%' . $kw . '%"';
//    }
    $sql = "select * from comments order by `cid` desc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    $sql1 = 'select count(*) as number from comments';

    $rse = mysqli_query($p, $rs);
    $c = mysqli_query($p, $rs1);

    $res = mysqli_fetch_assoc($c);
    return array($rse, intval($res['number'] / $pageSize) + 1);
}

function getVideotypeDate($pageNum, $pageSize)
{
    $p = connect();
    $sql = "select * from videotype order by `tid` desc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    $sql1 = 'select count(*) as number from videotype';

//    if ($kw != '') {
//        $rs = 'select * from videotype where typename like "%' . $kw . '%" limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
//        $rs1 = 'select count(*) as number from videotype where typename like "%' . $kw . '%"';
//    }
    $rs = mysqli_query($p, $sql);
    $c = mysqli_query($p, $sql1);

    $res = mysqli_fetch_assoc($c);
    return array($rs, intval($res['number'] / $pageSize) + 1);

}

