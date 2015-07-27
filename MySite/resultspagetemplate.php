<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Results Page</title>


    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <?php require_once "includes/resultsfile.php"; ?>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <form method="post" action="resultspagetemplate.php">
                <input type="hidden" name="query" value="" >
                <input type="submit" name="home_page_form" value="Clear All Filters">
            </form>
            <form id="filtered_form" method="post" action="resultspagetemplate.php">
                <input type="hidden" name="home_page_query" value="<?php echo $query; ?>">
                <input type="hidden" id="cur_page" name="cur_page" value="<?php echo ($cur_page+1); ?>">

                <strong><span class="white-font">Filter By Brand</span></strong> :<br/>
                <?php
                foreach ($allBrands as $brand_key => $brand_value) {
                    $checked ='';
                    if(isset($brandFields) && in_array($brand_key, $brandFields)){
                        $checked= 'checked="checked"';
                    }
                    $disabled = '';
                   // if($brand_value == 0){ $disabled = 'disabled'; }
                    echo '<input type="checkbox"'."{$disabled}  {$checked} ".'name="brand[]" value="' . $brand_key . '">' .'<span class="white-font">'. $brand_key.'</span>'  . '<br />';
                }
                ?>
                <strong><span class="white-font">Filter by Range</span></strong> :<br/>
               <?php

                    $checked = '';
                    if( isset($rangeField) && ($rangeField == 0)){ $checked = 'checked';}
                    $disabled='';
                    //if($range_to_filter[0]==0){$disabled = 'disabled';}
                    echo '<input type="radio" name="range"'."{$disabled} {$checked} ".' value=0-10000><span class="white-font"> 0-10,000</span><br/>';


                    $checked = '';
                    if( isset($rangeField) && ($rangeField == 10000)){ $checked = 'checked';}
                    $disabled='';
                    //if($range_to_filter[1]==0){$disabled = 'disabled';}
                    echo '<input type="radio" name="range"'."{$disabled} {$checked} ".'  value=10000-20000><span class="white-font"> 10,000-20,000</span><br/>';


                    $checked = '';
                    $disabled='';
                    //if($range_to_filter[2]==0){$disabled = 'disabled';}
                    if( isset($rangeField) && ($rangeField == 20000)){ $checked = 'checked';}
                    echo '<input type="radio" name="range"'."{$disabled} {$checked} ".'  value=20000-30000><span class="white-font"> 20,000 & More</span><br/>';

                ?>
                <input type="submit" value="Apply Filters" style="border-style: none; width: 94px; height: 20px;">
            </form>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Results</h3>
                        <?php
                        //start Displaying Items and Description Using Pagination
                        foreach ($results['hits']['hits'] as $result) {
                            $id = $result['_id'];
                            $doc = $result['_source'];
                            $title = $doc['title'];
                            $prod_desc = $doc['prod_desc'];
                            $price_from_fk = $doc['price_from_fk'];

                            echo '<p><a class="item-links" href="detailspagetemplate.php?id=' . $id . '">' . $title . '</a></p>';
                            echo "<p>Price From FK : {$price_from_fk}</p>";
                            if(isset($doc['price_from_am'])){
                                $price_from_am = $doc['price_from_am'];
                                echo "<p>Price From AM : {$price_from_am}</p>";
                            }
                            echo '<p>' . $prod_desc . '</p>';
                            echo '<br />';


                        }


                        if (($cur_page+1)*10 < $total) {//means it's not the last page
                            echo '<a href="#" id="next_page_link">Next</a>';
                        }



                        ?><!--<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/myjscript.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>


</body>

</html>
