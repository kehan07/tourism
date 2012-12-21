<?php
	session_start();
	$testing = true;
	$db;
	
	if ($testing)
	{
		$db = mysql_pconnect("localhost", "yves", "sevy1210");
		if ($db)
			mysql_select_db("kehan");
		else
			die("failed to connect to db");
	}
	else
	{ 
		$db = mysql_pconnect("db418280414.db.1and1.com", "dbo418280414", "1Zj724jE0");
		if ($db)
			mysql_select_db("db418280414");
		else
			die("failed to connect to db");
	}
?>