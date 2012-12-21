<?php

	// takes in a list of wikipedia titles to search for
	// returns a sorted list of attractions based on the relatedness score
	function search($topics)
	{
		if (count($topics) == 0)
			return array();
		
		// gets the list of tourist attractions from the database
		$attractions = getAttractions();
		
		// this is 2D array
		$scores = array();
		
		for ($i = 0; $i < count($topics); $i++)
		{
			// if this is a valid attraction
			if (($index = array_search($topics[$i], $attractions)) !== false)
			{
				// get the relatedness scores for this attraction (from the database)
				array_push($scores, getScores($topics[$i]));
			}
		}
		
		if (count($scores) == 0)
			return array();
		
		$multipliedScores = array();
		
		// initially set them to 1 so we can multiply
		for ($i = 0; $i < count($scores[0]); $i++)
			$multipliedScores[] = 1;
			
		// find the weighted score
		foreach ($scores as $key=>$val)
		{
			for ($i = 0; $i < count($val); $i++)
			{
				if ($val[$i] != 0)
					$multipliedScores[$i] *= $val[$i];
			}
		}
		
		// create assoc. array of [attraction]=>score
		$attracArray = array();
		for ($i = 0; $i < count($multipliedScores); $i++)
		{
			if ($multipliedScores[$i] != 1)
				$attracArray[$attractions[$i]] = $multipliedScores[$i];
		}
		
		// now, sort this array by value to find the top attractions
		asort($attracArray);
		$attracArray = array_reverse($attracArray);
		
		return $attracArray;
	}
	
	function getScores($topic)
	{
		$sql = "SELECT scores FROM data WHERE name='$topic'";
		$result = mysql_query($sql);

		// get the scores field
		$scores = mysql_result($result, 0);
		
		// split the string
		if ($scores)
			return explode(";", $scores);
		else 
			return false;
	}
	
	function getAttractions()
	{
		$sql = "SELECT name FROM data";
		$result = mysql_query($sql);
		$attractions = array();
		
		// get all rows
		while($row=mysql_fetch_array($result)) 
       		$attractions[] = $row["name"];
		
		return $attractions;
	}

?>