<?php
require_once('../../Connections/projector.php');
require_once '../../_AWSSDKforPHP/sdk.class.php';

define("MAX_FILE_SIZE",  1024*1024);

$s3 = new AmazonS3();

$bucket = 'ProjectorAssets';
 
//Here you can add valid file extensions. 
$valid_formats = array("jpg", "png", "gif","jpeg","PNG","JPG","JPEG","GIF");

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

/* print out a debug message with carriage return */
function logMessage($message)
{
	if (true)	// set to true to debug
		echo $message . "\n<br />";
}

/* returns an associative array containing the root of the file name and the file extension
   For example $str = "image.png" returns array ( "root" => "image", "extension" => "png") */
function getExtension($str) 
{
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	$ext = substr($str,$i+1,$l);
	$root = substr($str,0,$i);
	$returnArray = array(
    "root" => $root,
    "extension" => $ext,
	);
	return $returnArray;
}

/* checks to see if the object exists in the S3 bucket */
function objectExists($objectName) {
	global $bucket, $s3;
	
	$response = $s3->get_object($bucket,$objectName);
	return($response->isOK());
}


function result($success,$msg,$url,$fileName,$errorNumber = 0)
{
	return array("success" => $success, "message" => $msg, "url" => $url, "fileName" => $fileName,"error" => $errorNumber);
}

function getContentType($extension)
{
	switch (strtolower($extension)) {
		case 'jpe' :
		case 'jpeg' :
		case 'jpg'  : return 'image/jpeg'; 
		case 'gif' : return 'image/gif';
		case 'png' : return 'image/png';
		default : return 'text/plain';
	}
}

function uploadFile($tmpFile,$filePath,$fileName,$fileSize)
{
	global $bucket, $s3, $valid_formats;

	$fileNameParts = getExtension($fileName);
	$objectName = $filePath . $fileName;
	$msg = "";
	if (!isset($tmpFile) || strlen($tmpFile) == 0) {
		$msg = "Error uploading file";
		return result(false,$msg);
	}
	
	if (isset($fileSize) && $fileSize > MAX_FILE_SIZE) {
		$msg =  "Image size Max 1 MB";
		return result(false,$msg);
	}
	
	logMessage("File Root: " . $fileNameParts["root"] . " Extension: " . $fileNameParts["extension"] );
	// check if the file extension is a supported file type
	if (!in_array($fileNameParts["extension"],$valid_formats)) {
		$msg = "The file is not a valid image format";
		return result(false,$msg);
	}
	
	$uniqueFileId = 1;
	while (objectExists($objectName)) {
		$msg = "The file $objectName already exists trying: ";
		$objectName = $filePath . $fileNameParts["root"] . $uniqueFileId . '.' . $fileNameParts["extension"];
		$msg .= $objectName . "\n<br />";
		$uniqueFileId++;
	}
	logMessage("create_object($bucket, $objectName) fileUpload = $tmpFile");
	$opt = array('fileUpload' => $tmpFile, 'acl' => AmazonS3::ACL_PUBLIC, 'contentType' => getContentType($fileNameParts["extension"]));
	$response = $s3->create_object($bucket,$objectName,$opt);
//	print_r($response->header["_info"]["url"]);
	if ($response->isOK()) 
		return result(true,"The file $objectName, was successfully uploaded\n<br />",$response->header["_info"]["url"],$objectName);
	else
		return result(false,"There was an error uploading, $objectName\n<br />");
}

/* this function will update the url to point to the url returned from amazon */
function updateMediaURL($url)
{
	global $database_projector, $projector;
	
	$insertedRecordId = -1;
	if (isset($_POST['ProjectId']) && $_POST['ProjectId'] > -1)		// if the media id is specified update otherwise we are doing an insert
		$insertRecord = false;
	else
		$insertRecord = true;	
	
	mysql_select_db($database_projector, $projector);
	if ($insertRecord) 
		$sqlCommand = sprintf("INSERT INTO Projects SET %s = %s",
													$_POST['FieldName'],
												 	GetSQLValueString($url, "text"));
	else
		$sqlCommand = sprintf("UPDATE Projects SET %s=%s WHERE Id=%s",
												 $_POST['FieldName'],
												 GetSQLValueString($url, "text"),
												 GetSQLValueString($_POST['ProjectId'], "int"));
												 
	logMessage("sql: " . $sqlCommand);
	$Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());
	if ($insertRecord) {
		$insertedRecordId = mysql_insert_id();
	}
	return $insertedRecordId;
}

logMessage("processing upload");

$insertedRecordId = -1;
if(isset($_POST['UploadImage'])){		//check whether a form was submitted by checking if the submit button was pressed
		global $s3, $bucket;	
    //retreive post variables
    $fileName = $_FILES['file']['name'];
    $fileTempName = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$projectId = $_POST["ProjectId"];
		$filePath = "_images/projects/" . $projectId . "/";
		logMessage("FileSize: $fileSize");
		if (strlen($fileName) > 0)
			$response = uploadFile($fileTempName,$filePath,$fileName,$fileSize);
		if ($response["success"]) 
			$insertedRecordId = updateMediaURL($response["url"]);
//		echo json_encode($response);  This would be how we would return the string as a json response (this technique didn't work out)
}

$goToURL = "../Projector_EditChallenge.php";
// if we are not adding the record get the Media ID from the POST
if ($insertedRecordId == -1) {
	if (isset($_POST['ProjectId']))
		$goToURL .= "?Id=" . $_POST['ProjectId'];
} else {	// we are inserting the Media for the first time so get the Media ID from the record we just created
	$goToURL .= "?Id=" . $insertedRecordId;
}

logMessage($goToURL);

//header(sprintf("Location: %s", $goToURL));
?>