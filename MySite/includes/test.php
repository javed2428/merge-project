<?php
require_once('includes.php');

$query = "tablet";
$field = "title";
$brnds_arr = ['Asus', 'iBall'];
$lte = 10000;
$gt = 0;
$results_arr = $esObject->brandRangeFilteredQuery($query, $field, $brnds_arr,$gt, $lte);
print_r(var_dump($results_arr['hits']['hits']));
?>