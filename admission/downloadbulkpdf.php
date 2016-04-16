<?php
    
	include dirname(__FILE__).'/php/csrf_protection/csrf-token.php';
	include dirname(__FILE__).'/php/csrf_protection/csrf-class.php';
    
	include dirname(__FILE__).'/php/config/config.php';
	include dirname(__FILE__).'/php/config/functions.php';
	
	$language = array('en' => 'en','pt' => 'pt');

	if (isset($_GET['lang']) AND array_key_exists($_GET['lang'], $language)){
		include dirname(__FILE__).'/php/language/'.$language[$_GET['lang']].'.php';
	} else {
		include dirname(__FILE__).'/php/language/en.php';
	}

	// error_reporting(E_ALL & ~E_NOTICE);

	$userInfo = "SELECT * FROM `pdf_export` WHERE pdf_generated = 'N'";

	$userQuery = mysql_query($userInfo);

	if(! $userQuery )
	{
	  die('Could not enter data: ' . mysql_error());
	}

	$num_rows = mysql_num_rows($userQuery);

	if($num_rows > 0) {
		echo 'Previous batch is still running. Please wait for another ' . (($num_rows * 2) + 5) . ' minutes.';
		die();
	}

	$source_dir = 'secure/application/document/go/documents/';
	$zip_file = 'secure/application/document/go/zip/PDFs ' . date("d-m-Y H-i", strtotime(now)) . '.zip';

	function folderToZip($folder, &$zipFile) {
	    if ($zipFile == null) {
	        // no resource given, exit
	        return false;
	    }
	    // we check if $folder has a slash at its end, if not, we append one
	    $folder .= end(str_split($folder)) == "/" ? "" : "/";
	    // we start by going through all files in $folder
	    $handle = opendir($folder);
	    while ($f = readdir($handle)) {
	        if ($f != "." && $f != "..") {
	            if (is_file($folder . $f)) {
	                // if we find a file, store it
	                $zipFile->addFile($folder . $f);
	            }
	        }
	    }
	}

	$z = new ZipArchive();
	$z->open($zip_file, ZIPARCHIVE::CREATE);
	folderToZip($source_dir, $z);
	$z->close();
?>

<html>
	<body>
		<a href="<?php echo $zip_file; ?>" style="font-size: 30px; font-weight: bold;">Download file</a>
	</body>
</html>