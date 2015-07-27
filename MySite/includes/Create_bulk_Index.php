<?php

require_once 'init.php';

// Create the index and mappings
$mapping['index'] = 'flipkartlaptopindex'; //mapping code
//$mapping['body'] = array(
//    'mappings' => array(
//        'documents' => array(
//            '_source' => array(
//                'enabled' => true
//            ),
//            'properties' => array(
//                'doc_name' => array(
//                    'type' => 'string',
//                    'analyzer' => 'standard'
//                ),
//                'description' => array(
//                    'type' => 'string'
//                )
//            )
//        )
//    )
//);
//
//    $es->indices()->create($mapping);

    $documentData = file_get_contents('./flipkartdata.json');

    // If the data is json, you can decode it
    $documentData = json_decode($documentData, true);

    // etc etc.  Depends on what format your input data is

        // Now index the documents
    for ($i = 0; $i <= count($documentData); $i++) {
        $params ['body'][] = array(
        'index' => array(
        'index' => 'flipkartlaptopindex',
        'type' => 'documents',
        '_id' => $i,
        'body' => array(
        $documentData[$i]
        )
        )
        );


    // Every 100 documents stop and send the bulk request
    if ($i % 100) {
            $responses = $es->bulk($params);

    // erase the old bulk request
             $params = array();

    // unset the bulk response when you are done to save memory
            unset($responses);
        }
    }

?>
