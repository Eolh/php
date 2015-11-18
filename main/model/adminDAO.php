<?php
/**
 * Created by PhpStorm.
 * User: JH
 * Date: 2015-11-06
 * Time: 오후 3:28
 */

include_once "./conf.php";

define("CLPP", 10); // Count List Per Page  페이지당 리스트 갯수 정의
define("CPPB", 10); // Count Page Per Block 블록당 표시 페이지 갯수 정의

function selectMemberByNum($num){

    connect_db();
    $sql = "SELECT * FROM member WHERE num = ".strval($num);
    $result = mysql_query($sql);

    if( $result ){
        $row = mysql_fetch_array($result);
        $member['num'] = $row['m_num'];
        $member['id'] = $row['m_id'];
        $member['password'] = $row['m_password'];
        $member['name'] = $row['m_name'];
        $member['tel'] = $row['m_tel'];
        $member['level'] = $row['m_level'];
    }else{
        $member = null;
    }
    var_dump($member);
    mysql_close();
    return $member;
}

function selectMemberListWithPageInfo($pageInfo){

    connect_db();

    $limitFirstNum = ($pageInfo['currentPageNum'] - 1) * CLPP;

    $sql = "SELECT * FROM member ORDER BY m_num DESC limit ".strval($limitFirstNum).",".strval(CLPP);
    $result = mysql_query($sql);
    var_dump($sql);
    $cnt = 0;
    while( $row = mysql_fetch_array($result)){
        $memberList[$cnt]['num'] = $row['m_num'];
        $memberList[$cnt]['id'] = $row['m_id'];
        $memberList[$cnt]['password'] = $row['m_password'];
        $memberList[$cnt]['name'] = $row['m_name'];
        $memberList[$cnt]['tel'] = $row['m_tel'];
        $memberList[$cnt]['level'] = $row['m_level'];

        $cnt++;
    }
    var_dump($memberList);
    mysql_close();
    return $memberList;
}
function updateMemberByNum( $data ){

    connect_db();
    $sql = " UPDATE member SET ";
    $sql.= " m_id = '".strval($data['id'])."',"."m_password = '".strval($data['password'])."',m_name = '".strval($data['name'])."',m_tel = '".strval($data['tel'])."',m_level = '".strval($data['level'])."'";
    $sql.= " WHERE m_num = ".strval($data['num']);

    //session_start();
    //unset($_SESSION['sql']);
    //$_SESSION['sql'] = $sql; // 디버그를 위해 추가 - 배포판에서는 제거 필요

    $result = mysql_query($sql);

    mysql_close();
    return $result;
}

function deleteMemberByNum($num){

    connect_db();
    $sql = "DELETE FROM member WHERE m_num = ".strval($num);
    $result = mysql_query($sql);
    mysql_query("alter table member auto_increment=1");
    mysql_close();
    return $result;
}

function getMemberCount(){ // member데이블 레코드 갯수 확인

    connect_db();
    $sql = " SELECT count(*) FROM member";
    $result = mysql_query($sql);
    $count = mysql_result($result, 0, 0);

    var_dump($count);
    mysql_close();
    return $count;
}

function getPageInfo($pageNum){

    $countWholeRecord = getMemberCount();   //전체 레코드 갯수
    $countWholePage = ceil($countWholeRecord/CLPP);  //전체 페이지 갯수
    $countWholeBlock = ceil($countWholePage/CPPB); // 전체 블럭 갯수

    $currentBlockNum = ceil($pageNum/CPPB); // 현재 페이지가 포함된 블럭 넘버
    $pageCountInlastBlock = $countWholePage - (($countWholeBlock -1) * CPPB); //마지막 블럭에 포함된 페이지 갯수

    $pageInfo['firstPage'] = ($pageNum == 1)?false:true; //처음 페이지 표시 여부
    $pageInfo['lastPage'] = ($pageNum == $countWholePage)?false:true; // 마지막 페이지 표시 여부
    $pageInfo['startPageNumInBlock'] = ($currentBlockNum-1) * CPPB + 1; // 현재 블럭에서 시작 페이지 번호
    $pageInfo['preBlock'] = ($pageNum <= CPPB)?0:$pageInfo['startPageNumInBlock']-CPPB; // 이전블럭 가기 표시 여부
    $pageInfo['nextBlock'] = ($currentBlockNum >= $countWholeBlock)?0:$pageInfo['startPageNumInBlock']+CPPB; // 다음블럭 가기 표시 여부
    $pageInfo['currentPageNum'] = ($pageNum <= $countWholePage)?$pageNum:$pageNum-1; // 현재 페이지 번호
    $pageInfo['countPageInBlock'] = ($currentBlockNum != $countWholeBlock)?CPPB:$pageCountInlastBlock; // 현재 블럭에 표시할 페이지 갯수

    $pageInfo['countWholeRecord'] = $countWholeRecord;
    $pageInfo['countWholePage'] = $countWholePage;
    $pageInfo['countWholeBlock'] = $countWholeBlock;

    $pageInfo['currentBlockNum'] = $currentBlockNum;
    $pageInfo['pageCountInlastBlock'] = $pageCountInlastBlock;

    return $pageInfo;
}