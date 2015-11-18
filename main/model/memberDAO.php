<?php


include_once "./conf.php";

function loginCheck($id, $password){

    connect_db();
    $sql = "SELECT * FROM member WHERE m_id = '".strval($id)."' AND m_password = '".strval($password)."'";
    $sql2 = "SELECT * FROM member WHERE m_id = '".strval($id)."'";

    $_SESSION['sql'] = $sql;  // 디버그를 위해 추가 - 배포판에서는 제거 필요
    $_SESSION['sql2'] = $sql2; // 디버그를 위해 추가 - 배포판에서는 제거 필요

    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    if( $row['m_id'] && $row['m_id'] == $id && $row['m_password'] == $password){
        $returnArr['level'] = $row['m_level'];
        $returnArr['code'] = 1; // 로그인 성공 코드 리턴
    }
    else{
        $result = mysql_query($sql2);
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
    $_SESSION['sql'] = $sql; // 디버그를 위해 추가 - 배포판에서는 제거 필요

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
