<?php
/**
 * Created by PhpStorm.
 * User: JH
 * Date: 2015-11-06
 * Time: 오후 2:13
 */
include_once 'conf.php';
function insertProduct(){
    connect_db();
    mysql_close();
}
function getAllProductCnt(){
    connect_db();
    $sql = "select count(*) from product";
    $result = mysql_query($sql);
    $count = mysql_result($result,0,0);
    mysql_close();
    return $count;
}
function getSelectProductCnt($category){
    connect_db();
    $sql = "select count(*) from product where category like $category";
    $result = mysql_query($sql);
    $count = mysql_result($result,0,0);
    mysql_close();
    return $count;
}
function selectProductListWithPageInfo($PageInfo){
    connect_db();
    $CLPP = isset($pageInfo['CLPP'])?$pageInfo['CLPP']:10;
    $limitStart=($PageInfo['currentPageNum']-1)*$CLPP;

    $sql = "SELECT * FROM product ORDER BY p_num DESC limit ".strval($limitStart).",".strval($CLPP);
    $result = mysql_query($sql);

    $cnt = 0;
    while( $row = mysql_fetch_array($result)){
        $productList[$cnt]['p_num'] = $row['p_num'];
        $productList[$cnt]['p_category'] = $row['p_category'];
        $productList[$cnt]['p_code'] = $row['p_code'];
        $productList[$cnt]['p_name'] = $row['p_name'];
        $productList[$cnt]['p_content'] = $row['p_content'];
        $productList[$cnt]['p_stock'] = $row['p_stock'];
        $productList[$cnt]['p_price'] = $row['p_price'];
        $productList[$cnt]['p_fimage'] = $row['p_fimage'];
        $productList[$cnt]['p_simage'] = $row['p_simage'];

        $cnt++;
    }

    mysql_close();
    return $productList;
}
function deleteProduct($p_num){
    connect_db();
    $sql = "delete from product where p_num = $p_num";
    mysql_query($sql);
    mysql_close();
}
function selectProductbyNum($pnum){
    connect_db();
    $sql = "SELECT * FROM product WHERE p_num = ".strval($pnum);
    $result = mysql_query($sql);

    if( $result ){
        $row = mysql_fetch_array($result);
        $product['p_num'] = $row['p_num'];
        $product['p_category'] = $row['p_category'];
        $product['p_content'] = $row['p_content'];
        $product['p_name'] = $row['p_name'];
        $product['p_stock'] = $row['p_stock'];
        $product['p_price'] = $row['p_price'];
        $product['p_fimage'] = $row['p_fimage'];
        $product['p_simage'] = $row['p_simage'];
    }else{
        $product = null;
    }

    mysql_close();
    return $product;
}
function updateProductByNum($data){
    connect_db();
    $sql = "Update product set p_category={$data['p_category']}, p_name={$data['p_name']}, p_stock={$data['p_stock']}, p_price={$data['p_price']}, p_fimage={$data['p_fimage']}";
    $result=mysql_query($sql);
    mysql_close();
    return $result;
}
?>