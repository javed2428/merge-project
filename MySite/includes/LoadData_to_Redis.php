    <?php



//    require_once  'vendor/autoload.php';
//
//    use \Predis;
//    Predis\Autoloader::register();
//
//    $client = new Predis\Client([           //Connect to Redis Client
//        "hosts" => "localhost",
//        "port" => "6379"
//    ]);

    //store file contents in data variable
    $json_data = file_get_contents('./Crawled_data.json');

    //decode the json data into array variable
    $json_array = json_decode($json_data, true);
    $hash_array = array();
    for($element = 1 ; $element < count($json_array); $element++)
    {
        //writing in batches of 100 records to hashmap
        if($element%100 != 0){

            $serial_data = serialize($json_array[$element]);
            $key = $json_array[$element]['model_id'];

            $hash_array[$key] = $serial_data;
        }
        else
        {

            $client->hmset('Hmap_laptop',$hash_array);
            $hash_array = array();
        }

    }

    ?>
