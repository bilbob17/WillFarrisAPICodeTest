<?php
	require __DIR__.'/vendor/autoload.php';
	include 'searcher.php';

	//put options together
	$search = (isset($_POST['search']) ? $_POST['search'] : null);
	$options = "";
	$count = (int)$_POST['count'];
	if( isset($_POST['after']))
	{   //increment count to get the correct before/after values
		$count = $count + 10;
		$options = "&count=" . $count . "&after=" . $_POST['after'];
	}
	elseif( isset($_POST['before']))
	{	//decrement count to get the correct before/after values
		$count = ($count > 10)? (int)$_POST['count'] - 10: (int)$_POST['count'];
		$options = "&count=" . $count . "&before=" . $_POST['before'];
	}
	
	//executes a new search
	$search = new Searcher();
	if( isset($_POST['search']))
	{	//decrement count to get the correct before/after values
		$results=$search->execSearch( $options, $_POST['sort'], $_POST['search'] );
	}
	else
	{
		$results=$search->execSearch( $options, $_POST['sort']);
	}

	//load the results 
	$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
	$twig = new Twig_Environment($loader, array());

	//render view
	echo $twig->render('index.twig', array(
		'results' => $results["data"]["children"],
		'before' => $results["data"]["before"],
		'after' => $results["data"]["after"],
		'sort' => $_POST['sort'],
		'count' => $count
	));

?>