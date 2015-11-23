<?php
/**
 * Created by PhpStorm.
 * User: JH
 * Date: 2015-11-06
 * Time: 오후 3:27
 */
include_once "../model/memberDAO.php";
include_once "../model/productDAO.php";
function adminController($action){

    switch( $action ){

        case  910:

            $pageNum = isset($_REQUEST['mpageNum'])?$_REQUEST['mpageNum']:1;
            $cnt=getMemberCount();
            $memberPageInfo = getPageInfo($pageNum,$cnt,10,10);
            $memberList = selectMemberListWithPageInfo($memberPageInfo);

            $_SESSION['memberPageInfo'] = $memberPageInfo;
            $_SESSION['memberList'] = $memberList;
            header("location:../view/MainView.php?action=$action");
            break;

        case 914: // 회원데이터 수정 처리
            $data['m_num'] = isset($_REQUEST['m_num'])?$_REQUEST['m_num']:null;
            $data['m_id'] = isset($_REQUEST['m_id'])?$_REQUEST['m_id']:null;
            $data['m_password'] = isset($_REQUEST['m_password'])?$_REQUEST['m_password']:null;
            $data['m_name'] = isset($_REQUEST['m_name'])?$_REQUEST['m_name']:null;
            $data['m_tel'] = isset($_REQUEST['m_tel'])?$_REQUEST['m_tel']:null;
            $data['m_level'] = isset($_REQUEST['m_level'])?$_REQUEST['m_level']:null;


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

        case 920:
            header("location:../view/MainView.php?action=$action");
            break;

        case 930:  //상품 리스트보기

            $productPageInfo = $_SESSION['productPageInfo'];

            if( !$productPageInfo){
                $pageNum=1;
            }else{
                $pageNum =isset($_REQUEST['ppageNum'])?$_REQUEST['ppageNum']:1;
            }

            $CLPP=10;
            $CPPB=10;

            $count=getAllProductCnt();
            $productPageInfo = getPageInfo($pageNum, $count, $CLPP, $CPPB);
            $productList = selectProductListWithPageInfo($productPageInfo);
            $_SESSION['cnt'] = $count;
            $_SESSION['productPageInfo'] = $productPageInfo;
            $_SESSION['productList'] = $productList;
            header("location:../view/MainView.php?action=$action");

            break;

        case 932:
            $pnum=$_REQUEST['num'];
            $product = selectProductbyNum($pnum);
            if( ! $product ){
                $action = 919;
            }else {
                $_SESSION['productData'] = $product;
                $action = 933;  //수정처리 뷰로 리다이렉트
            }
            header("location:../view/MainView.php?action=$action");
            break;

        case 934:
            $data['p_num'] = isset($_REQUEST['p_num'])?$_REQUEST['p_num']:null;
            $data['p_category'] = isset($_REQUEST['p_category'])?$_REQUEST['p_category']:null;
            $data['p_name'] = isset($_REQUEST['p_name'])?$_REQUEST['p_name']:null;
            $data['p_stock'] = isset($_REQUEST['p_stock'])?$_REQUEST['p_stock']:null;
            $data['p_price'] = isset($_REQUEST['p_price'])?$_REQUEST['p_price']:null;
            $data['p_fimage'] = isset($_REQUEST['p_fimage'])?$_REQUEST['p_fimage']:null;


            $result = updateProductByNum($data);
            if( ! $result ){
                $action = 919;
            }
            $action = 923;
            $productPageInfo = $_SESSION['productPageInfo'];
            $ppageNum = $productPageInfo['currentPageNum'];
            header("location:./MainCTL.php?action=$action&ppageNum=$ppageNum");  //콘트롤러 재호출

            break;

        case 935:
            $pnum=$_REQUEST['num'];
            deleteProduct($pnum);
            $action=930;
            header("location:./MainCTL.php?action=$action&ppageNum={$_REQUEST['ppageNum']}");  //콘트롤러 재호출
            break;

        case 940:
            header("location:../view/MainView.php?action=$action");
            break;

        case 950:
            header("location:../view/MainView.php?action=$action");
            break;

        case 960:
            header("location:../view/MainView.php?action=$action");
            break;

        default:
            header("location:../view/MainView.php?action=$action");
            break;
    }

}