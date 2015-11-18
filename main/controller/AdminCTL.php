<?php
/**
 * Created by PhpStorm.
 * User: JH
 * Date: 2015-11-06
 * Time: 오후 3:27
 */
include_once "../model/adminDAO.php";
function adminController($action){

    switch( $action ){

        case  910:

            $pageNum = isset($_REQUEST['pageNum'])?$_REQUEST['pageNum']:1;
            $memberPageInfo = getPageInfo($pageNum);
            $memberList = selectMemberListWithPageInfo($memberPageInfo);

            $_SESSION['memberPageInfo'] = $memberPageInfo;
            $_SESSION['memberList'] = $memberList;
            header("location:../view/MainView.php?action=$action");
            break;

        case 914: // 데이터 수정 처리
            $data['num'] = isset($_REQUEST['num'])?$_REQUEST['num']:a;
            $data['id'] = isset($_REQUEST['id'])?$_REQUEST['id']:null;
            $data['password'] = isset($_REQUEST['password'])?$_REQUEST['password']:null;
            $data['name'] = isset($_REQUEST['name'])?$_REQUEST['name']:null;
            $data['tel'] = isset($_REQUEST['tel'])?$_REQUEST['tel']:null;
            $data['level'] = isset($_REQUEST['level'])?$_REQUEST['level']:null;


            $result = updateMemberByNum($data);
            if( ! $result ){
                $action = 919;
            }
            $action = 910;
            $memberPageInfo = $_SESSION['memberPageInfo'];
            $pageNum = $memberPageInfo['currentPageNum'];
            header("location:./MainCTL.php?action=$action&pageNum=$pageNum");  //콘트롤러 재호출
            break;

        case 916: //수정요구 처리
            $num = $_REQUEST['num'];
            $member = selectMemberByNum($num);
            if( ! $member ){
                $action = 919;
            }else {
                $_SESSION['member'] = $member;
                $action = 911;  //수정처리 뷰로 리다이렉트
            }
            header("location:../view/MainView.php?action=$action");
            break;

        case 917: // 삭제요구 처리
            $num = $_REQUEST['num'];
            $result = deleteMemberByNum($num);
            if(! $result){
                $action = 919;
            }else{
                $action = 910;
            }
            header("location:./MainCTL.php?action=$action&pageNum={$_REQUEST['pageNum']}");  //콘트롤러 재호출
            break;

        case 920:  // 상품관리 처리 액션
            header("location:../view/MainView.php?action=$action");
            break;

        case 930:  // 결제관리 처리 액션
            header("location:../view/MainView.php?action=$action");
            break;

        case 940: // 배송관리 처리 액션
            header("location:../view/MainView.php?action=$action");
            break;

        case 950: // 매출관리 처리 액션
            header("location:../view/MainView.php?action=$action");
            break;

        case 960: // 게시판관리 처리 액션
            header("location:../view/MainView.php?action=$action");
            break;

        default:
            header("location:../view/MainView.php?action=$action");
            break;
    }

}