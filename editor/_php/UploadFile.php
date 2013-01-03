<?php
require_once '../../_AWSSDKforPHP/sdk.class.php';

define("MAX_FILE_SIZE",  1024*1024);

$s3 = new AmazonS3();

$bucket = 'ProjectorAssets';
 
//Here you can add valid file extensions. 
$valid_formats = array("jpg", "png", "gif","jpeg","PNG","JPG","JPEG","GIF");



function logMessage($message)
{
	if (true)
		echo $message . "\n<br />";
}

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

function objectExists($objectName) {
	global $bucket, $s3;
	
	$response = $s3->get_object($bucket,$objectName);
	return($response->isOK());
}

logMessage("processing upload");
//check whether a form was submitted
if(isset($_POST['UploadImage'])){
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
			updateMediaURL($response["url"]);
//		echo json_encode($response);  This would be how we would return the string as a json response (this technique didn't work out)
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
		return result(true,"The file $objectName, was successfully uploaded\n<br />",$objectName,$response->header["_info"]["url"]);
	else
		return result(false,"There was an error uploading, $objectName\n<br />");
}

function updateMediaURL()
{
}

// Okay this is supposedly hacky that I am doing a Get and Post to this UploadFile.php but it works just fine
$goToURL = "../Projector_MediaEdit.php";
if (isset($_SERVER['QUERY_STRING'])) {
  $goToURL .= "?" . $_SERVER['QUERY_STRING'];		// put url parameters back on the url we pass when you click the save button to re-post form data to this same page
}

logMessage($goToURL);

header(sprintf("Location: %s", $goToURL));
?>