<?php 
	require_once("init.php"); require_once("search.php"); 
?>

<!DOCTYPE html>
<html>
<head>
<title>Tourist Recommendation</title>
 <link rel="stylesheet" href="css/style.css"> 
<script src="http://code.jquery.com/jquery-latest.min.js"></script>  
    <script>    
		function showresults()
		{
			if($('#search').val() == ''){}
			else{
			$(".results").css("display","block");
			$("#searchdata").css("display","table");
			$("#pagewrapper").css("display","table");
			window.location = "#searchdata";}

		}
        $(document).ready(function() {           
			if (!Modernizr.input.placeholder)
			{
				var placeholderText = $('#search').attr('placeholder');
				
				$('#search').attr('value',placeholderText);
				$('#search').addClass('placeholder');
				
				$('#search').focus(function() {				
					if( ($('#search').val() == placeholderText) )
					{
						$('#search').attr('value','');
						$('#search').removeClass('placeholder');
					}
				});
				
				$('#search').blur(function() {				
					if ( ($('#search').val() == placeholderText) || (($('#search').val() == '')) )                      
					{	
						$('#search').addClass('placeholder');					  
						$('#search').attr('value',placeholderText);
					}
				});
			}                
        });
        
		function maps()
		{
			var value=document.getElementById("button1").value;
			if (value=="Show Maps")
			{
				$("#maps").css("display","block");
				document.getElementById("button1").value = "Hide Maps";
			}
			else if (value=="Hide Maps")
			{
				$("#maps").css("display","none");
				document.getElementById("button1").value = "Show Maps";
			}
		}
		 
		function maps2()
		{
			var value=document.getElementById("button2").value;
			if (value=="Show Maps")
			{
				$("#maps2").css("display","block");
				document.getElementById("button2").value = "Hide Maps";
			}
			else if (value=="Hide Maps")
			{
				$("#maps2").css("display","none");
				document.getElementById("button2").value = "Show Maps";
			}
		} 
		
		function maps3()
		{
			var value=document.getElementById("button3").value;
			if (value=="Show Maps")
			{
				$("#maps3").css("display","block");
				document.getElementById("button3").value = "Hide Maps";
			}
			else if (value=="Hide Maps")
			{ 
				$("#maps3").css("display","none");
				document.getElementById("button3").value = "Show Maps";
			}
		}
		
		function more()
		{
			var value=document.getElementById("amore").innerHTML;
			if (value=="More...")
			{
				$("#details").css("display","block");
				document.getElementById("amore").innerHTML = "Hide";
			}
			else if (value=="Hide")
			{
				$("#details").css("display","none");
				document.getElementById("amore").innerHTML = "More...";
			}
		}
    </script>
</head>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<body>

<?php 
	$results = array();
	
	if (isset($_POST["topicSearch"]))
	{
		// separate by commas
		$searchParts = explode(",", $_POST["topicSearch"]);
		
		// trim all the search topics
		for ($i = 0; $i < count($searchParts); $i++)
		{
			$searchParts[$i] = trim($searchParts[$i]);
		}
		$date1 = microtime();
		$results = search($searchParts);
		

	}
?>

<header>
<div id="title"><h1>Tourist Recommendation</h1>
<h2>Version 1.0</h2></div>
</header>

<div class="ui-widget">
<table id="figures">
<tr>
<td><a href="http://www.wikipedia.org/" target="_blank"><div id="logo"></div></a></td>
<td><div id="add"></div></td>
<td><div>
<form id="searchbox" method="POST" action="index.php" >
    <input id="search" name="topicSearch" type="text" placeholder="Type here" />
    <input id="submit" type="submit" value="Search" />
</form>
</div></td>
</tr></table>
</div>

<?php 

if ($_POST["topicSearch"]!="")
{ $i = 0;
	foreach ($results as $key=>$val)
	{
		$i++;

	}
?>

<table id="searchdata">

<tr>
<td width="50%"><h2>Search Results</h2></td>
<td width="50%"><p>About <?php echo $i;?> results (<?php echo $date2 = (microtime()-$date1)*1000; $date2; ?> milliseconds)</p></td>
</tr>
<tr>
<td width="50%"><p class="sort">Sort by: Relative Score</p></td>
<td width="50%"></td>
</tr>
<tr><td colspan="2"><hr></td></tr>
</table>

<?php 
} 
?>
<?php 

if (isset($_POST["topicSearch"]))
{
	//$i = 0;
	//$topics = explode(",", $_POST["topicSearch"]);
	
	//echo ("<br /><br /><h2>Scores for {$_POST["topicSearch"]}</h2><br /><br />");
	
	foreach ($results as $key=>$val)
	{
		$j++;
		
		//if ($i >= 5)
		//	break;
		
	    echo("<section id='result1' class='results small-edges big-shadow'>  
	        <header>  
	            <h2>$j. $key</h2> 
	            <h3>Score : $val</h3>
		     <h3>Link : <a href='http://en.wikipedia.org/wiki/$key' target='_blank'>http://en.wikipedia.org/wiki/$key</a></h3>
	        </header>  
	    </section>");
	}
}
?>
      
<table id="pagewrapper">
<tr><td colspan="3"><hr></td></tr>
<tr><td class="left" width="33%"><img src="left-arrow"></td><td width="33%"><p>Page <b>1 of 1</b></p></td><td class="right" width="33%"><img src="right-arrow"><td></tr>
</table>

<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="Stylesheet" />	
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
<script>
	$(function() {
		var availableTags = [
<?php $sql1="SELECT * FROM data";

$results = mysql_query($sql1);
     while($row = mysql_fetch_array($results))
{
echo ("\"".$row['name']."\",");
}
echo ("\"Nothing\"");
?>
		];
		$( "#search" ).autocomplete({
			source: availableTags,
			minLength: 2
		});
	});
	</script>


	


  <!-- Footer -->
  <footer>
   <div class="center-wrap">
    <p >&copy; Copyright 2012. All Rights Reserved.</p>
    <a class="right" href="#"><img src="pointer.png" alt="top" /></a>
   </div>
  </footer>
<div id="social-media"><h2><em>Social Media Links</em></h2><ul><li><a href="http://www.youtube.com" target="_blank"><em>Youtube</em></a></li><li><a href="http://facebook.com" target="_blank"><em>Facebook</em></a></li><li><a href="http://twitter.com/" target="_blank"><em>Twitter</em></a></li></ul></div>
</body>   
</html> 

