<?php 
echo '<meta charset="UTF-8">' . "\n";
echo "<pre>"; 

$xml_parser = xml_parser_create(); 
xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, 0); 
xml_parser_set_option($xml_parser, XML_OPTION_SKIP_WHITE, 1); 
xml_set_processing_instruction_handler($xml_parser, "pi_handler"); 
xml_set_default_handler($xml_parser, "parseDEFAULT"); 
xml_set_element_handler($xml_parser, "startElement", "endElement"); 
xml_set_character_data_handler($xml_parser, "contents"); 

$outputDir = "output/";
initGlobals();


#$file = "samples/movies.xml"; 
if (isset($_GET['folder'])) {
		print "get folder: " . $_GET['folder'];
		iterateThroughFiles($_GET['folder'],$_GET['projectId']);
} else if (isset($_GET['fileName']))
	$file = $_GET['fileName'];
else
	$file = "ela/grade11_ela_unit2_lesson1.xml";

echo $file."\n"; 

/*
if ($tagFileInput = file("output/tagNames.txt",FILE_IGNORE_NEW_LINES)) {
	foreach ($tagFileInput as $value) {
		$tagNames[$value] = $value;
	}
	echo "\nTag names from tagNames.txt\n";
	print_r($tagNames);
}*/
readFileToArray($outputDir . "tagNames.txt", $tagNames);
readFileToArray($outputDir . "routineNames.txt", $routineNames);
readFileToArray($outputDir . "layoutItems.txt", $layoutItems);
readFileToArray($outputDir . "contentTypes.txt", $contentTypes);

echo "\nroutineNames names from routineNames.txt\n";
print_r($routineNames);
	
if (!($fp = fopen($file, "r"))) { 
    if (!xml_parse($xml_parser, $data, feof($fp))) { 
       die( sprintf("XML error: %s at line %d", 
                            xml_error_string(xml_get_error_code($xml_parser)), 
                            xml_get_current_line_number($xml_parser))); 
    } 
} 
while ($data = fread($fp, 4096)) { 
    if (!xml_parse($xml_parser, $data, feof($fp))) { 
       die( sprintf("XML error: %s at line %d", 
                            xml_error_string(xml_get_error_code($xml_parser)), 
                            xml_get_current_line_number($xml_parser))); 
    } 
} 

echo"\nLesson Name: ";
echo $lessonName . "\n";	// output the list of layout items

echo"\nLayout Items:\n";
sort($layoutItems);
print_r($layoutItems);	// output the list of layout items
outputFile($outputDir . "layoutItems.txt" , $layoutItems);

echo"\npd_types:\n";
sort($pdTypes);
print_r($pdTypes);	// output the list of teacher types

echo"\ncontent_types:\n";
sort($contentTypes);
print_r($contentTypes);	// output the list of content_types
outputFile($outputDir . "contentTypes.txt" , $contentTypes);

echo"\n" . "tag names:\n";
sort($tagNames);
print_r($tagNames);	// output the list of layout items
outputFile($outputDir . "tagNames.txt",$tagNames);

echo"\n" . "routine names (unsorted):\n";
//sort($routineNames);
print_r($routineNames);	// output the list of routine names
outputFile($outputDir . "routineNames.txt" , $routineNames);

xml_parser_free($xml_parser); 


function initGlobals() {
	global $closeTag, $inTag; 
    global $lessonName, $tagNames;
	global $layoutItems;
	global $pdTypes;
	global $contentDescriptions;
	global $pdType, $taskId, $stepId, $contentId, $tagStack, $contentTypes, $contentType;
	global $routineName, $routineNames, $routineId;
		
	$inTag = ""; 
	$layoutItems = array();
	$pdTypes = array();
	$tagNames = array();
	$tagStack = array();
	$contentDescriptions = array();
	$contentTypes = array();
	$contentType = "";
	$routineNames = array();
	$routineName = "";
	$lessonName = "Untitled Lesson";
	$taskId = "";
	$stepId = "";
	$contentId = "";
	$routineId = "";
	$pdType = "";
	$taskDescription = "";
}

// writes the contents of an array into a file
function outputFile($fileName,$output) {
	$fh = fopen($fileName, "a") or die ("can't open $fileName\n");
	file_put_contents($fileName , join("\n",$output), LOCK_EX);
}

// reads the content of a file into an array
function readFileToArray($fileName,&$inputArray) {
	if ($tagFileInput = file($fileName,FILE_IGNORE_NEW_LINES)) {
		foreach ($tagFileInput as $value) {
			$inputArray[$value] = $value;
		}
	} else 
		echo "can't open $fileName\n";
}

function startElement($parser, $name, $attrs) { 
    global $inTag; 
    global $depth;
		global $tagNames; 
		global $tagStack;
        
    $padTag = str_repeat(str_pad(" ", 3), $depth); 
/*
    if (!($inTag == "")) { 
        echo "&gt;"; 
    } 
    echo "\n$padTag&lt;$name"; 
    foreach ($attrs as $key => $value) { 
        echo "\n$padTag".str_pad(" ", 3); 
        echo " $key=\"$value\""; 
    } 
	*/
    $inTag = $name; 
	$tagNames[$name] = $name;
	array_push($tagStack,$name);
    $depth++; 
} 

function endElement($parser, $name) { 

	global $depth; 
	global $inTag; 
  global $closeTag; 
  global $tagStack;
  global $taskDescription;
	      
	$depth--; 

   if ($closeTag == TRUE) { 
//       echo "&lt/$name&gt;"; 
       $inTag = ""; 
   } elseif ($inTag == $name) { 
//      echo " /&gt;"; 
       $inTag = ""; 
   } else { 
         $padTag = str_repeat(str_pad(" ", 3), $depth); 
//       echo "\n$padTag&lt/$name&gt;"; 
    }
	if ($name == "task") {
		echo "closing " . '&lt;/task&gt;' . " $taskDescription\n";
		$taskDescription  = "";
	}
		array_pop($tagStack);
} 
  
function getPath(){
	global $taskId, $stepId, $contentId, $routineId;
	
	$path = $routineId . "." . $taskId . "." . $stepId . "." . $contentId;
	return $path;
}

function contents($parser, $data) { 

    global $closeTag;
		global $inTag; 
    global $lessonName;
		global $layoutItems;
		global $pdTypes;
		global $contentDescriptions;
		global $pdType, $taskId, $stepId, $contentId, $tagStack, $contentTypes, $contentType;
		global $routineName, $routineNames, $routineId;
		global $taskDescription;
		
    $data = preg_replace("/^\s+/", "", $data); 
    $data = preg_replace("/\s+$/", "", $data); 
		switch ($inTag) {
			case 'layout' : if (!array_key_exists($data,$layoutItems))
												$layoutItems[$data] = $data;
											break;
			case 'lesson_name' : $lessonName = $data;
														break;
			case 'pd_type' : 	$pdType = $data;
												$pdTypes[$data] = $data;
												break;
			case 'content_type' : 	$contentType = $data;
												$contentTypes[$data] = $data;
												break;
			case 'taskId' : $taskId = $data;
											$stepId = "";		// clear out stepId when we encounter a new task
											$contentId = "";	// clear out contentId when we encounter a new task
											break;
			case 'stepId' : $stepId = $data;
											$contentId = "";	// clear out contentId when we encounter a new step
											break;
			case 'contentId' : $contentId = $data;
											break;
			case 'routineId' : $routineId = $data;
											break;
			case 'thumbnail' : 	$path = getPath();
								echo "Id: $path, CONTENT_TYPE: $contentType, Thumbnail: $data\n";
								echo "<img src=\"../$data\"/>";
								break;
//			case 'content' : $contentId = $data;
//											break;
			case 'content_type' : $contentType = $data;
														$contentTypes[$data]= $data;
														break;
			case 'description' : $parent = $tagStack[count($tagStack) - 2];
													 echo "\nParent: " . $parent . "\n";
													 if ($parent == "content") {
														 	$path = getPath();
													 		echo "path: " . $path . "\n"; 
															echo "CONTENT: " . $data ."\n";
													 }
													 if ($parent == "task") {
														 	$taskDescription = $data;
	//													 	$path = "." . $stepId . "." . $contentId;
	//												 		echo "path: " . $path . "\n"; 
															echo "TASK: " . $data ."\n";
													 }
											break;
			case 'routinename' :  $routineName = $data;
														echo "\nRoutine: " . $routineId . ". " . $data . "\n";
														$routineNames[$data] = $data;
								//						print_r($routineNames);	// output the list of routine names
														break;
		}
    if (!($data == ""))  { 
//        echo "&gt;$data"; 
        $closeTag = TRUE; 
    } else { 
        $closeTag = FALSE; 
     } 
} 

function parseDEFAULT($parser, $data) { 
    
    $data = preg_replace("/</", "&lt;", $data); 
    $data = preg_replace("/>/", "&gt;", $data); 
//    echo $data; 
} 

function pi_handler($parser, $target, $data) { 

//    echo "&lt;?$target $data?&gt;\n"; 
} 
echo "</pre>"; 
?>
