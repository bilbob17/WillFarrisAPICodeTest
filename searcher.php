<?php

class Searcher
{

    /**
     * This method queries the reddit API for searches
     *
     * @param $query The term to search for
     * @param $sort The term used to determine new or hot
     * @param $options The filter used to search
     *
     **/

    public function execSearch($options = ' ', $sort = 'hot', $query = '')
    {   
		//options that don't change
		$url = 'https://www.reddit.com/r/jokes';
		$hcOptions = 'restrict_sr=1&limit=10';
		
		//determine sort type
		if( $sort == 'new')
		{
			$s = '/new';
		}
		else
		{
			$s = '';
		}
		
		//structure url depending on if a search has happened
		if ( $query == '' )	
		{
			$url = $url . $s . '.json?';
		}
		else
		{
			$url = $url . $s . '/search.json?q=' . $query . '&'; 
		}
		
		//assemble request and get response
        $request = $url . $hcOptions . $options;
		$response  = file_get_contents($request);
		$jsonobj  = json_decode($response, true);

		//allow the html formatting to get through
		function htmlEscape(&$item, $key)
		{			
			$scOffTags = array("<!-- SC_OFF -->", "<!-- SC_ON -->");
			$replace   = array("", "");
			$item["data"]["selftext_html"] = substr(html_entity_decode($item["data"]["selftext_html"]), 15);
		}
		array_walk($jsonobj["data"]["children"],'htmlEscape');
		
		//return the results
        return $jsonobj;
    }
}

?>