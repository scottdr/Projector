<?php 
echo "<pre>"; 

#$file = "samples/movies.xml"; 
if (isset($_GET['fileName']))
	$file = $_GET['fileName'];
else
	$file = "ela/grade11_ela_unit2_lesson1.xml";

echo $file."\n"; 
global $inTag; 

$inTag = ""; 
$xml_parser = xml_parser_create(); 
xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, 0); 
xml_parser_set_option($xml_parser, XML_OPTION_SKIP_WHITE, 1); 
xml_set_processing_instruction_handler($xml_parser, "pi_handler"); 
xml_set_default_handler($xml_parser, "parseDEFAULT"); 
xml_set_element_handler($xml_parser, "startElement", "endElement"); 
xml_set_character_data_handler($xml_parser, "contents"); 
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

echo"\npd_types:\n";
sort($pdTypes);
print_r($pdTypes);	// output the list of teacher types

echo"\ncontent_types:\n";
sort($contentTypes);
print_r($contentTypes);	// output the list of content_types

echo"\n" . "tag names:\n";
sort($tagNames);
print_r($tagNames);	// output the list of layout items

echo"\n" . "routine names (unsorted):\n";
//sort($routineNames);
print_r($routineNames);	// output the list of routine names

xml_parser_free($xml_parser); 

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
		array_pop($tagStack);
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
		
    $data = preg_replace("/^\s+/", "", $data); 
    $data = preg_replace("/\s+$/", "", $data); 
		switch ($inTag) {
			case 'layout' : if (!array_key_exists($data,$layoutItems))
												$layoutItems[$data] = $data;
											break;
			case 'lesson_name' : $lessonName[$data] = $data;
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
//			case 'content' : $contentId = $data;
//											break;
			case 'content_type' : $contentType = $data;
														$contentTypes[$data]= $data;
														break;
			case 'description' : $parent = $tagStack[count($tagStack) - 2];
													 echo "\nParent: " . $parent . "\n";
													 if ($parent == "content") {
														 	$path = $taskId . "." . $stepId . "." . $contentId;
													 		echo "path: " . $path . "\n"; 
															echo "CONTENT: " . $data ."\n";
													 }
													 if ($parent == "task") {
														 	$path = $taskId . "." . $stepId . "." . $contentId;
													 		echo "path: " . $path . "\n"; 
															echo "TASK: " . $data ."\n";
													 }
											break;
			case 'routinename' :  $routineName = $data;
														echo "\nRoutine: " . $routineId . ". " . $data . "\n";
														$routineNames[$data] = $routineId . ". " .  $data;
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
