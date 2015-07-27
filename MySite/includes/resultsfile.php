<?php

require_once 'elastic.php';
$esObject = new ElasticSearch($index, $type, $size);
//query Elastic Search
if (isset($_POST['home_page_submit'])) {//means home.php form is submitted
    $query = $_POST['query'];
    $filter = 0;
    $cur_page = 0;
} else {  //filtered form is submitted
    $query = $_POST['home_page_query'];
    $cur_page = $_POST['cur_page'];
    $filter = [];
    if(!empty($_POST['brand'])){
        $terms_array = ["terms"=>["brand"=>$_POST['brand']]];
        $filter[] = $terms_array;
    }
    if(isset($_POST['range'])){
        $range = $_POST['range'];
        $arr = explode('-', $_POST['range']);
        $lower_bound = $arr[0];
        $upper_bound = $arr[1];
        if($lower_bound == 20000){ $upper_bound += 100000;}
        $range_array = ["range"=>["least_price"=>["lte"=>$upper_bound,"gt"=>$lower_bound]]];
        $filter[] = $range_array;
    }
    if(empty($filter)){
        $filter = 0;
    }

}



if(isset($_POST['brand'])){
    $brandFields= $_POST['brand'];
}
if(isset($_POST['range'])){
    $arr = explode('-', $_POST['range']);
    $rangeField = $arr[0];
}
$from = $cur_page*10;
$results = $esObject->Query($query, $filter , $from );
$total = $results['hits']['total'];
if($total == 0){
    header("Location: pagenotfound.html");
}



$allBrands = ElasticSearch::getAllBrands($results);
$range_to_filter = ElasticSearch::getAllRanges($results);
