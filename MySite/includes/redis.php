<?php
require_once 'includes.php';

$hashmap = 'flipzonHashMap';
class redisHashClass {
    public $redisClient;
    public $hashmap;

    public function __construct($hash) {
        $this->redisClient = new Predis\Client();
        $this->hashmap = $hash;
    }

    public function getDetailsById($id ) {//returns associative array of document using json_decode(if found) else NULL
        $jsonString =  ($this->redisClient->hget($this->hashmap, $id));
        $doc = NULL;
        if($jsonString != NULL){
            $doc = json_decode($jsonString, true);
        }
        return $doc;
    }

    public function setDetailsById($id, $document) {//store document in redis Hashmap
        $jsonString = json_encode($document);
        $this->redisClient->hset($this->hashmap, $id, $jsonString);
    }
}





?>