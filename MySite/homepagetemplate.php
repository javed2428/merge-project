<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Search Tablets</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
        <script src="js/myjscript.js"></script>
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" rel="home" href="#">Search Tablets</a>
	</div>
	
	<div class="collapse navbar-collapse">
		<?php /*
		<ul class="nav navbar-nav">
			<li><a href="#">Link</a></li>
			<li><a href="#">Link</a></li>
			<li><a href="#">Link</a></li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
		</ul>

		<button type="button" class="btn btn-default navbar-btn">Button</button>
        */
        ?>
		<div class="col-sm-3 col-md-3 pull-right">
        <div class="navbar-text"></div>
		<form class="navbar-form" role="search" method="post" id="home_page_form" action="resultspagetemplate.php">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Search" name="query" id="srch-term">
			<div class="input-group-btn">
				<button class="btn btn-default" name="home_page_submit" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			</div>
		</div>
		</form>
		</div>
		
	</div>
</div>


<div class="container">
  
  <div class="text-center">
   <!-- <h1>Search Any Tablet</h1>
    <p class="lead">
        <img src="http://www.stopandstaremarketing.co.uk/wp-content/uploads/2014/04/SEO-and-PPC.jpg" width="469px" height="235px"/>
    </p>
    -->
  </div>
  
</div><!-- /.container -->
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>