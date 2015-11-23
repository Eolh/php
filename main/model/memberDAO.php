<?php


include_once "conf.php";

define("CLPP", 10); // Count List Per Page  페이지당 리스트 갯수 정의
define("CPPB", 10); // Count Page Per Block 블록당 표시 페이지 갯수 정의


function loginCheck($id, $password){

    connect_db();
    $sql = "SELECT * FROM member WHERE m_id = '".strval($id)."' AND m_password = '".strval($password)."'";
    $sql2 = "SELECT * FROM member WHERE m_id = '".strval($id)."'";


    $result = mysql_query($sql);
    var_dump($result);
    $row = mysql_fetch_array($result);
    if( $row['m_id'] && $row['m_id'] == $id && $row['m_password'] == $password){
        $returnArr['level'] = $row['m_level'];
        $returnArr['code'] = 1; // 로그인 성공 코드 리턴
    }
    else{
        $row = mysql_fetch_array($result);
        if( $row['m_id'] && $row['m_id'] == $id ) $returnArr['code'] = -1; // 비밀번호 입력 오류 코드 리턴
        else $returnArr['code'] = -2; // 아이디 입력 오류 코드 리턴
    }
    mysql_close();
    return $returnArr;
}


function insertMember($data){

    connect_db();
    $sql = " INSERT INTO member(m_id,m_password,m_name,m_tel) ";
    $sql.=" VALUES('";
    $sql.=strval($data['id'])."','".strval($data['password'])."','".strval($data['name'])."','".strval($data['tel'])."')";

    //session_start();

    $result = mysql_query($sql);

    mysql_close();
    return $result;
}

function updateMember( $data ){

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

function deleteMember($num){

    connect_db();
    $sql = "DELETE FROM member WHERE m_num = ".strval($num);
    $result = mysql_query($sql);

    mysql_close();
    return $result;
}
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
        $memberList[$cnt]['m_num'] = $row['m_num'];
        $memberList[$cnt]['m_id'] = $row['m_id'];
        $memberList[$cnt]['m_password'] = $row['m_password'];
        $memberList[$cnt]['m_name'] = $row['m_name'];
        $memberList[$cnt]['m_tel'] = $row['m_tel'];
        $memberList[$cnt]['m_level'] = $row['m_level'];

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
