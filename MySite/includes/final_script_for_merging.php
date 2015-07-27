<?php
require_once 'elastic.php';
$esObject = new ElasticSearch($index, $type, $size);

//$jsonString = file_get_contents('scraped_amazon.json');
//$documents = json_decode($jsonString, true);
//foreach ($documents as $document) {
//    $esObject->getDocIdForMerging($document);
//}

$sourceFileHandle = fopen('scraped_amazon.json','r') or die('unable to open source file');
while (($line = fgets($sourceFileHandle)) !== false) {
    $line = substr($line, 0, -2);
    if($line[0]=='[')
        $line=str_replace('[','',$line);
    $document = json_decode($line, true);
    $esObject->getDocIdForMerging($document);


}
?>

