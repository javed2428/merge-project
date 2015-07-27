<html>
<head>
    <title>Results Page</title>
    <link rel="stylesheet" type="text/css" href="includes/style.css" />
</head>

<body>

<?php require "includes/resultsfile.php"; ?>
<div id="wrap">
    <div id="header"></div>
    <div id="sidebar">


        <form method="post" action="results.php">
            <input type="hidden" name="home_page_query" value="<?php echo $query; ?>">
            <input type="hidden" name="cur_page" value="<?php echo $cur_page; ?>">

            <strong>Filter By Brand</strong> :<br/>
            <?php
            foreach ($allBrands as $brand_key => $brand_value) {
                echo '<input type="checkbox" name="brand[]" value="' . $brand_key . '">' . $brand_key . "({$brand_value})" . '<br />';
            }
            ?>
            <strong>Filter by Range</strong> :<br/>
            <?php
            if($range_to_filter[0] != 0){
                echo '<input type="radio" name="range" value=10> 0-10,000('.$range_to_filter[0].')<br/>';
            }
            if($range_to_filter[1] != 0){
                echo '<input type="radio" name="range" value=30> 10,000-20,000('.$range_to_filter[1].')<br/>';
            }
            if($range_to_filter[2] != 0){
                echo '<input type="radio" name="range" value=50> 20,000 & More('.$range_to_filter[2].')<br/>';
            }
            ?>
            <input type="submit" value="Apply Filters" style="border-style: none; width: 94px; height: 20px;">
        </form>
    </div>

    <div id="main">
        <h3>Results</h3>
        <?php
        //start Displaying Items and Description Using Pagination
        for ($i = $start_index; $i <= $end_index; $i++) {
            $id = $results['hits']['hits'][$i]['_id'];
            $doc = $results['hits']['hits'][$i]['_source'];
            $title = $doc['title'];
            $prod_desc = $doc['prod_desc'];
            $price = $doc['price'];
            echo '<p><a class="item-links" href="details.php?id=' . $id . '">' . $title . '</a></p>';
            echo "<p>Price : {$price}</p>";
            echo '<p>' . $prod_desc . '</p>';
            echo '<br />';


        }


        if ((($cur_page*10)+10) < ($total)) {//means it's not the last page
            echo '<a href="#" id="next_page_link">Next</a>';
        }


        ?>
    </div>
</div>
</body>
</html>