<?php

// 페이징 표시 부분

$memberPageInfo = isset($_SESSION['memberPageInfo'])?$_SESSION['memberPageInfo']:null;

echo "<table width='300'><tr>";

// 처음페이지 이동
echo "<td width='30'>";
if($memberPageInfo['firstPage'] == 0){
    echo "△";
}else{
    echo "<a href='../controller/MainCTL.php?action=913&pageNum={$memberPageInfo['firstPage']}'>▲</a>";
}
echo "</td>";


// 이전 블럭으로 이동
echo "<td width='30'>";
if($memberPageInfo['preBlock'] == 0){
    echo "□";
}else{
    echo "<a href='../controller/MainCTL.php?action=913&pageNum={$memberPageInfo['preBlock']}'>■</a>";
}
echo "</td>";

// 이전 페이지 이동
echo "<td width='30'>";
if($memberPageInfo['firstPage'] == false){
    echo "◁";
}else{
    $prePageNum = $memberPageInfo['currentPageNum']-1;
    echo "<a href='../controller/MainCTL.php?action=913&pageNum={$prePageNum}'>◀</a>";
}
echo "</td>";

//현재 블럭의 페이지 표시
for( $cnt = 0; $cnt < $memberPageInfo['countPageInBlock']; $cnt++ ){
    echo "<td width='30'>";
    $currentBlockPageNum = $memberPageInfo['startPageNumInBlock']+$cnt;
    if( $currentBlockPageNum == $memberPageInfo['currentPageNum'])
        echo "<a href='../controller/MainCTL.php?action=913&pageNum={$currentBlockPageNum}'>[{$currentBlockPageNum}]</a>";
    else
        echo "<a href='../controller/MainCTL.php?action=913&pageNum={$currentBlockPageNum}'>{$currentBlockPageNum}</a>";
    echo "</td>";
}

// 다음 페이지 이동
echo "<td width='30'>";
if($memberPageInfo['lastPage'] == false){
    echo "▷";
}else{
    $nextPageNum = $memberPageInfo['currentPageNum']+1;
    echo "<a href='../controller/MainCTL.php?action=913&pageNum={$nextPageNum}'>▶</a>";
}
echo "</td>";

// 다음 블럭으로 이동
echo "<td width='30'>";
if($memberPageInfo['nextBlock'] == 0){
    echo "□";
}else{
    echo "<a href='../controller/MainCTL.php?action=913&pageNum={$memberPageInfo['nextBlock']}'>■</a>";
}
echo "</td>";

// 마지막 페이지 이동
echo "<td width='30'>";
if($memberPageInfo['lastPage'] == 0){
    echo "▽";
}else{
    echo "<a href='../controller/MainCTL.php?action=913&pageNum={$memberPageInfo['countWholePage']}'>▼</a>";
}
echo "</td>";

echo "</tr></table>";

//unset($_SESSION['memberPageInfo']);
