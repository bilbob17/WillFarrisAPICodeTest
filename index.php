<html>
<head>
   
 <title>10 Reddit Jokes</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="resources/style.css">
<script type="text/javascript" src="resources/api.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div>
	<span><h1>Jokes From R/Jokes</h1></span>
	<span><a href="javascript:newSort('hot')">Hot</a></span>
	<span><a href="javascript:newSort('new')">New</a></span>
	<input type="text" id="search"><button onclick="search()">Search</button>
</div>
<?php
	require __DIR__.'/vendor/autoload.php';
	include 'searcher.php';

	//Executes a new search
	$search = new Searcher();
	$results=$search->execSearch(); 

	//Loads the results in Twig
	$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
	$twig = new Twig_Environment($loader, array());

	//Renders our view
	echo "<div id='results'>";
	echo $twig->render('index.twig', array(
		'results' => $results["data"]["children"],
		'before' => $results["data"]["before"],
		'after' => $results["data"]["after"],
		'sort' => "hot",
		'count' => "0"
	));
	echo "</div>";
?>
</body>
</html>