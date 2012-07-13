<?php
  
	function generateTable() 
	{
		$fileURL = "sql/data.json";
		$fileContents = file_get_contents($fileURL);
		$result = json_decode($fileContents);
		$columnNum = 1;
		foreach($result->results as $row) 
		{	
			print "<div id=\"GalleryColumn" . $columnNum . "Div\" >";
		  print "\n\t<div id=\"GalleryMedia\">";
      print "\n\t\t<img src=\"" . $row->srcImg . "\" width=\"300\" height=\"200\">";
      print "\n\t</div>";
		  print "\n\t<h1>$row->name</h1>";
      print "\n\t<p>$row->description</p>";
     	print "\n\t<p><strong>$row->subject</p>";
			print "\n\t<p><strong>$row->grade</strong></p>";
			print "\n\t<p><strong>$row->duration</strong></p>";
			print "\n</div>\n";
			if (++$columnNum > 3)
					$columnNum = 1;
		}
	}

	generateTable();
?>