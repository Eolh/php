<?php
/**
 * Created by PhpStorm.
 * User: JH
 * Date: 2015-11-04
 * Time: 오후 2:38
 */

define("localhost","localhost");
define("user","root");
define("password","1234");
define("db","mydb");
function connect_db(){
    $conf=mysql_connect(localhost,user,password);
    mysql_select_db(db,$conf);

}

?>