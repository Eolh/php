<ul>
    <?php if($loginID&&$userLevel==999){ ?>

        <li><b><?=$loginID?></b> 님(등급 : admin )&nbsp;</li>
        <li><a href="../controller/MainCTL.php?action=12">로그아웃</a></li>
        <li><a href="../controller/MainCTL.php?action=910">회원정보</a></li>
        <li><a href="../controller/MainCTL.php?action=0">상품관리</a></li>
        <li><a href="../controller/MainCTL.php?action=0">결제관리</a></li>
        <li><a href="../controller/MainCTL.php?action=0">매출관리</a></li>
        <li><a href="../controller/MainCTL.php?action=0">배송관리</a></li>

    <?php }elseif($loginID){?>

        <li><b><?=$loginID?></b> 님(등급 : <?= $loginLevel ?>)&nbsp;</li>
        <li><a href="../controller/MainCTL.php?action=12">로그아웃</a></li>
        <li><a href="../controller/MainCTL.php?action=15">마이페이지</a></li>
        <li><a href="../controller/MainCTL.php?action=0">장바구니</a></li>
        <li><a href="../controller/MainCTL.php?action=0">주문조회</a></li>


    <?php }else{?>

        <li><a href="../controller/MainCTL.php?action=10">로그인</a></li>
        <li><a href="../controller/MainCTL.php?action=13">회원가입</a></li>
        <li><a href="../controller/MainCTL.php?action=15">마이페이지</a></li>
        <li><a href="../controller/MainCTL.php?action=0">장바구니</a></li>
        <li><a href="../controller/MainCTL.php?action=0">고객만족센터</a></li>
        <li><a href="../controller/MainCTL.php?action=0">주문조회</a></li>

    <?php }?>
</ul>
