<?php 
echo "<pre>"; 

#$file = "samples/movies.xml"; 
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
xml_parser_free($xml_parser); 

function startElement($parser, $name, $attrs) { 

    global $inTag; 
    global $depth; 
        
    $padTag = str_repeat(str_pad(" ", 3), $depth); 

    if (!($inTag == "")) { 
        echo "&gt;"; 
    } 
    echo "\n$padTag&lt;$name"; 
    foreach ($attrs as $key => $value) { 
        echo "\n$padTag".str_pad(" ", 3); 
        echo " $key=\"$value\""; 
    } 
    $inTag = $name; 
    $depth++; 
} 

function endElement($parser, $name) { 

    global $depth; 
   global $inTag; 
    global $closeTag; 
        
    $depth--; 

   if ($closeTag == TRUE) { 
       echo "&lt/$name&gt;"; 
       $inTag = ""; 
   } elseif ($inTag == $name) { 
       echo " /&gt;"; 
       $inTag = ""; 
   } else { 
         $padTag = str_repeat(str_pad(" ", 3), $depth); 
       echo "\n$padTag&lt/$name&gt;"; 
    }  
} 
  
function contents($parser, $data) { 

    global $closeTag; 
    
    $data = preg_replace("/^\s+/", "", $data); 
    $data = preg_replace("/\s+$/", "", $data); 

    if (!($data == ""))  { 
        echo "&gt;$data"; 
        $closeTag = TRUE; 
    } else { 
        $closeTag = FALSE; 
     } 
} 

function parseDEFAULT($parser, $data) { 
    
    $data = preg_replace("/</", "&lt;", $data); 
    $data = preg_replace("/>/", "&gt;", $data); 
    echo $data; 
} 

function pi_handler($parser, $target, $data) { 

    echo "&lt;?$target $data?&gt;\n"; 
} 
echo "</pre>"; 
?>
