<?php
require_once 'includes.php';
$client = new Elasticsearch\Client();

$jsonString = file_get_contents('amazondata.json');
$documents = json_decode($jsonString, true);
$params['index'] = 'flipzon';
$params['type'] = 'docs';
$count=0;

foreach ($documents as $document) {
    $params['body']['query']['filtered']['query']['bool']['must'] = [['match' => ['title' => $document['title']]], ['match' => ['color' => $document['color']]]];
    $params['body']['query']['filtered']['filter']['range']['internal']['gte'] = $document['internal'];
    $results = $client->search($params);
    if ($results['hits']['total'] != 0) { //update the document
        $count++;
        $id = $results['hits']['hits'][0]['_id'];
        $price_from_fk = $results['hits']['hits'][0]['_source']['price_from_fk'];
        unset($params['body']);
        $params['id'] = $id;
        $params['body']['doc'] = $document;
        $client->update($params);
        unset($params['body']);
        unset($params['id']);

    }
}
echo $count;

?>