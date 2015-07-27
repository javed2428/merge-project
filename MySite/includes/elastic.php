<?php
require_once 'includes.php';
$index = 'flipzon';
$type = 'docs';
$size = '10';

class ElasticSearch
{
    public $params;
    public $client;

    public function __construct($index, $type, $size)
    {

        $this->client = new Elasticsearch\Client();
        $this->params['index'] = $index;
        $this->params['type'] = $type;
    }

    public function Query($query, $filter, $from)
    {
        $params = $this->params;
        $params['size'] = 10;
        $query = trim($query);
        if (!empty($query)) {
            $params['body']['query']['filtered']['query']['match']['title'] = $query;

        } else {
            $params['body']['query']['filtered']['query']['match_all'] = new \stdClass();

        }
        if (is_array($filter)) {
            $params['body']['query']['filtered']['filter']['bool']['must'] = $filter;
        }
        $params['body']['aggs']['brands']['terms'] = ['field' => 'brand', 'size' => 0, 'min_doc_count' => 0];
        $params['body']['aggs']['price_ranges']['range'] = ['field' => 'least_price', 'ranges' => [['to' => 10000], ['from' => 10000, 'to' => 20000], ['from' => 20000]]];
        $params['body']['from'] = $from;
        $results = $this->client->search($params);
        return $results;
    }

    public function getDetailsById($id)
    {
        $params = $this->params;

        $params['id'] = $id;
        $results = $this->client->get($params);
        return $results;
    }

    public function setDetailsById($id, $doc)
    {
        $params = $this->params;
        $params['id'] = $id;
        $params['body'] = $doc;
        $results = $this->client->index($params);
        return $results;
    }

    public static function getAllBrands($results)
    {
        $buckets_arr = $results['aggregations']['brands']['buckets'];
        $brands_arr = [];
        foreach ($buckets_arr as $bucket) {
            $brands_arr[$bucket['key']] = $bucket['doc_count'];
        }
        arsort($brands_arr);
        return $brands_arr;

    }

    public static function getAllRanges($results)
    {
        $range_buckets = $results['aggregations']['price_ranges']['buckets'];
        $range = [0, 0, 0];//range[0] contains no. of products between 0-10000 & same for range[1] & range[2]
        $range[0] = $range_buckets[0]['doc_count'];
        $range[1] = $range_buckets[1]['doc_count'];
        $range[2] = $range_buckets[2]['doc_count'];
        return $range;
    }

    public function getDocIdForMerging($document)
    {
        $params = $this->params;
        $params['body']['query']['filtered']['query']['bool']['must'] = [['match' => ['title' => $document['title']]], ['match' => ['color' => $document['color']]]];
        $results = $this->client->search($params);
        if ($results['hits']['total'] != 0) {
            $flip_id = $results['hits']['hits'][0]['_id'];
            $price_from_fk = $results['hits']['hits'][0]['_source']['price_from_fk'];
            $this->updateDoc($flip_id, $price_from_fk, $document);

        }

    }

    public function updateDoc($flip_id, $price_from_fk, $document)
    {
        $params = $this->params;
        $params['id'] = $flip_id;
        $least_price = (($price_from_fk < $document['price_from_am']) ? ($price_from_fk) : ($document['price_from_am']));
        $params['body']['doc'] = ['link_from_am' => $document['link_from_am'], 'price_from_am' => $document['price_from_am'], 'image_src' => $document['image_src'], 'least_price' => $least_price];
        $this->client->update($params);

    }


}

?>