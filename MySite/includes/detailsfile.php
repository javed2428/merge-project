<?php
require_once 'elastic.php';
require_once 'redis.php';

$esObject = new ElasticSearch($index, $type, $size);
$redisHashObject = new redisHashClass($hashmap);

$doc = $redisHashObject->getDetailsById($_GET['id']);

if ($doc == NULL) {//then query ES and store document in redis as well
    $results = $esObject->getDetailsById($_GET['id']);
    $doc = $results['_source'];
   $redisHashObject->setDetailsById($_GET['id'], $doc);
}
$title = $doc['title'];
//$prod_desc = $doc['prod_desc'];
$link_from_fk = $doc['link_from_fk'];
$link_for_least_price = $link_from_fk;
$price_from_fk = $doc['price_from_fk'];
$least_price = $doc['least_price'];
if(isset($doc['price_from_am'])) {
    $price_from_am = $doc['price_from_am'];
    $img_src = $doc['image_src'];
    if($least_price == $price_from_am){
        $link_for_least_price = $doc['link_from_am'];
    }
}
?>