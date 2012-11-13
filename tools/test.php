<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>

<?php

$cmd = "cd /var/www; ";
$cmd .= "ls -l";
# $cmd .= "git pull";
echo "shell_exec(" . $cmd . ")<br />";
$result = shell_exec($cmd);
echo "result: " . $result;
?>
</body>
</html>