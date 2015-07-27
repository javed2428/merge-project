<?php
define('ROOT','/var/www/html/firstproject/MySite');
define('DS','/');
//initialize ES
require ROOT.DS.'..'.DS.'vendor/autoload.php';
//Initialize Predis
require ROOT.DS.'..'.DS."predis/autoload.php";
Predis\Autoloader::register();


$index = 'temp';
$type = 'docs';
$size = '10';
class ElasticSearch {
    public $index;
    public $type;
    public $size;
    public $params;
    public $results;
    public $client;

    public function __construct($ind, $typ, $siz) {
        $this->index = $ind;
        $this->type = $typ;
        $this->size = $siz;
        $this->client = new Elasticsearch\Client();
        $this->params['index'] = $this->index;
        $this->params['type'] = $this->type;
        $this->params['size'] = $this->size;
    }

    public function Query($query, $filter) {
        unset($this->params['body']);//this is done to unset params['body'] b'coz it was set by any previous query
        $query = trim($query);
        if(!empty($query)) {
            $this->params['body']['query']['filtered']['query']['match']['title'] = $query;

            if (is_array($filter)) {
                $this->params['body']['query']['filtered']['filter']['bool']['must'] = $filter;
            }
        } else {
            $this->params['body']['query']['match_all'] = new \stdClass();
            //$this->params['body']['query']['match']['title'] = "tablet ipad tab";

        }
        $this->params['body']['aggs']['brands']['terms']=['field'=>'brnd' , 'size'=>0 , 'min_doc_count' => 0];
        $this->params['body']['aggs']['price_ranges']['range'] = ['field'=>'price' , 'ranges'=>[['to'=>10000],['from'=>10000 , 'to'=>20000],['from'=>20000]]];

        $this->params['body']['from'] = 10;
        $this->results = $this->client->search($this->params);
        return $this->results;
    }

    public function getDetailsById($id){
        unset($this->params['body']);//this is done to unset params['body'] b'coz it was set by any previous query
        $this->params['body']['query']['match']['asin'] = $id;
        $this->results = $this->client->search($this->params);
        return $this->results;
    }

    public function setDetailsById($id, $doc){
        unset($this->params['body']);//this is done to unset params['body'] b'coz it was set by any previous query
        $this->params['id'] = $id;
        $this->params['body'] = $doc;
        unset($this->params['size']);
        $this->results = $this->client->index($this->params);
        $this->params['size'] = $this->size;
        return $this->results;
    }

    public static function getAllBrands($results){
        $res_arr = $results['hits']['hits'];
        $brands_arr = [];
        foreach($res_arr as $item){
            $brands_arr[] = $item['_source']['brnd'];
        }
        $brands_arr = array_count_values($brands_arr);
        arsort($brands_arr);
        return $brands_arr;

    }

    public static function getAllRanges($results) {
        $res_arr = $results['hits']['hits'];
        $range = [0,0,0];//range[0] contains no. of products between 0-10000 & same for range[1] & range[2]
        foreach($res_arr as $item){
            if(intval($item['_source']['price'])<=10000 )
                $range[0] += 1;
            else if(intval($item['_source']['price'])<=20000)
                $range[1] += 1;
            else
                $range[2] += 1;
        }
        return $range;
    }
}
$esObject = new ElasticSearch($index, $type, $size);


$results = $esObject->Query('' , 0 );
print_r($results['aggregations']['price_ranges']['buckets']);
?>