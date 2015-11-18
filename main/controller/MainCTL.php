<?php
/**
 * Created by PhpStorm.
 * User: JH
 * Date: 2015-11-06
 * Time: 오후 2:13
 */
session_start();

$login['id']=isset($_SESSION['loginID'])?$_SESSION['loginID']:null;
$login['level']=isset($_SESSION['userLevel'])?$_SESSION['userLevel']:null;

$action = isset($_REQUEST['action'])?$_REQUEST['action']:0;
$mode = intval($action/100);

switch($mode){
    case 0:
        include_once "MemberCTL.php";
        loginController($action);
        break;
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        include_once "ProductCTL.php";
        ProductController($action);
        break;
    case 9:
        include_once "AdminCTL.php";
        adminController($action);
        break;
    default:
        header("location:../view/MainView.php?action=$action");
        break;
}

?>