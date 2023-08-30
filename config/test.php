<?php
// Read the PHP file contents
$fileContents = file_get_contents('../forms/customer-view.php');

// Use regular expression to extract HTML code
$htmlOnly = preg_replace('/<\?php(.*?)\?>/s', '', $fileContents);

// Output the extracted HTML
echo $htmlOnly;
?>