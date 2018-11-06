<?php

/**
 * Created by PhpStorm.
 * User: muming
 * Date: 2018/10/27
 * Time: 9:16
 */
class DBconnect
{
    private $host = "localhost:8889";
    private $user = "root";
    private $pwd = "root";
    private $charset = "UTF-8";
    private $con;

    function __construct()
    {
        $this->con = mysqli_connect($this->host, $this->user, $this->pwd);
        mysqli_set_charset($this->con, $this->charset);
        if (!($this->con)) {
            die('Could not connect: ' . mysqli_connect_error());
        }
    }

    function __destruct()
    {
        mysqli_close($this->con);
    }

//    $p->update("users",array("uname","password"),array("user4","12345"),"uid",17);
    function update()
    {
        $numargs = func_num_args();    //获得传入的所有参数的个数
        if ($numargs != 5) {
            die('parameter error');
        }
        $args = func_get_args();       //获得传入的所有参数的数组
        //echo var_dump($args);
        //第一个参数是表名
        mysqli_select_db($this->con, "neuvideo");
        $sql = 'update ' . $args[0] . ' ';
        //echo $sql;
        //判断参数个数和值的个数
        $parameter_cnt = count($args[1]);
        $value_cnt = count($args[2]);
        if ($parameter_cnt != $value_cnt) {
            die('parameter error');
        }
        $sql .= 'set';
        //拼接sql
        for ($x = 0; $x < $parameter_cnt; $x++) {
            $sql .= ' ' . $args[1][$x] . '=';
            $sql .= '\'' . $args[2][$x] . '\'';

            if ($x != $parameter_cnt - 1) {
                $sql .= ',';
            }
        }
        $sql .= " where " . $args[3] . "=" . $args[4];
        //echo $sql;
        if (!mysqli_query($this->con, $sql)) {
            die("Error: " . mysqli_error($this->con));
        }
    }

    /**
     * 插入，事例：insert("admins",array('adminname','password'),array('xdtcssdi','123'));
     */
    function insert()
    {
        $numargs = func_num_args();    //获得传入的所有参数的个数
        if ($numargs != 3) {
            die('parameter error');
        }
        $args = func_get_args();       //获得传入的所有参数的数组
        //echo var_dump($args);
        //第一个参数是表名
        mysqli_select_db($this->con, "neuvideo");
        $sql = 'INSERT INTO ' . $args[0] . '(';
        //echo $sql;
        //判断参数个数和值的个数
        $parameter_cnt = count($args[1]);
        $value_cnt = count($args[2]);
        if ($parameter_cnt != $value_cnt) {
            die('parameter error');
        }
        //拼接sql
        for ($x = 0; $x < $parameter_cnt; $x++) {
            $sql .= $args[1][$x];
            if ($x != $parameter_cnt - 1) {
                $sql .= ',';
            }
        }
        $sql .= ') VALUES (';
        for ($x = 0; $x < $parameter_cnt; $x++) {
            $sql .= '\'' . $args[2][$x] . '\'';
            if ($x != $parameter_cnt - 1) {
                $sql .= ',';
            }
        }
        $sql .= ')';
        //echo $sql;
        if (!mysqli_query($this->con, $sql)) {
            die("Error: " . mysqli_error($this->con));
        } else {
            return 1;
        }
    }

    /**
     * 查找指定字段所有数据,
     *
     * $res = $p->selectALL('admins');
     *
     * while ($row=mysql_fetch_array($res)){
     *     echo $row['adminname'].'<br>';
     *     echo $row['password'].'<br>';
     * }
     * $res = $p->selectALL('admins',array('adminname'));
     * echo '<br>';
     * while ($row=mysql_fetch_array($res)){
     *     echo $row['adminname'].'<br>';
     * }
     */
    function selectALL()
    {
        $args = func_get_args();       //获得传入的所有参数的数组
        //第一个参数是表名
        mysqli_select_db($this->con, "neuvideo");
        if (count($args) == 1) {
            return mysqli_query($this->con, 'select * from ' . $args[0]);
        } else {
            $sql = 'select ';
            $len = count($args[1]);
            for ($i = 0; $i < $len; ++$i) {
                $sql .= $args[1][$i];
                if ($i != $len - 1) {
                    $sql .= ',';
                }
            }
            $sql .= ' from ' . $args[0];
            echo $sql;
            return mysqli_query($this->con, $sql);
        }
    }

    function executeSql($sql)
    {

        mysqli_select_db($this->con, "neuvideo");
        return mysqli_query($this->con, $sql);
    }
}

function connect()
{
    $link = mysqli_connect(HOST, USER, PWD, DATANAME, PORT) or die('数据库连接失败<br/>ERROR' . mysqli_error($link) . ':' . mysqli_error($link));
    mysqli_set_charset($link, CHARSET);
    mysqli_select_db($link, DATANAME) or die('打开数据库是失败' . mysqli_error($link));
    return $link;

}