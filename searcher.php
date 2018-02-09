<?php

class Searcher
{

    /**
     * This method queries the reddit API for searches
     *
     * @param $query The term to search for
     * @param $options The filter used to search
     *
     **/

    public function execSearch($options = ' ', $sort = 'hot', $query = '')
    {   
		$url = "";
		if( $sort == 'new')
		{
			$s = '/new';
		}
		else
		{
			$s = '';
		}
		
		if ( $query == '' )	
		{
			$url = 'https://www.reddit.com/r/jokes' . $s . '.json?';
		}
		else
		{
			$url = 'https://www.reddit.com/r/jokes' . $s . '/search.json?q=' . $query . '&'; 
		}		
		$hcOptions = 'restrict_sr=1&limit=10';
		
        $request = $url . $hcOptions . $options;
		$response  = file_get_contents($request);
		$jsonobj  = json_decode($response, true);

		function htmlEscape(&$item, $key)
		{
			
			$scOffTags = array("<!-- SC_OFF -->", "<!-- SC_ON -->");
			$replace   = array("", "");
			$item["data"]["selftext_html"] = substr(html_entity_decode($item["data"]["selftext_html"]), 15);
		}
		array_walk($jsonobj["data"]["children"],'htmlEscape');
        return $jsonobj;
    }
}


?>