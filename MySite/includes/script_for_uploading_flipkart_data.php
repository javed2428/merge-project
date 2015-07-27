<?php
require_once './elastic.php';
$client = new Elasticsearch\Client();

//$jsonString = file_get_contents('flipkartdata.json');
//$documents = json_decode($jsonString , true);
//$id = 1;
//$params['index'] = 'flipzon';
//$params['type'] = 'docs';
//foreach($documents as $document){
//    $params['id'] = $id;
//    $document['least_price'] = $document['price_from_fk'];
//    $params['body']= $document;
//    $client->index($params);
//    $id++;
//
//}

$sourceFileHandle = fopen('scraped_flipkart.json','r') or die('unable to open source file');
$id =1;
$params['index'] = 'flipzon';
$params['type'] = 'docs';

while (($line = fgets($sourceFileHandle)) !== false) {
    $line = substr($line, 0, -2);
    $document = json_decode($line, true);
    $document['least_price'] = $document['price_from_fk'];

    $params['body'][] = ['index' => ['_id' => $id]];
    $params['body'][] = $document;

    if($id%100 == 0){
        $client->bulk($params);
        unset($params['body']);
    }
    $id++;


}


?>