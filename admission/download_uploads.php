<?php

include dirname( __FILE__ ).'/php/config/config.php';

// error_reporting(E_ALL);

class zip
{
   private $zip;
   public function __construct( $file_name, $zip_directory)
   {
   		print_r($file_name);
   		print_r($zip_directory);
        $this->zip = new ZipArchive();
        $this->path = dirname( __FILE__ ) . $zip_directory . $file_name;
        $this->zip->open( $this->path, ZipArchive::CREATE );
    }
      
   /**
     * Get the absolute path to the zip file
     * @return string
     */
    public function get_zip_path()
    {
        return $this->path;
    }   
       
    /**
     * Add a directory to the zip
     * @param $directory
     */
    public function add_directory( $directory , $physicalpath)
    {
    	print_r($directory);
        if( is_dir( $physicalpath . $directory ) && $handle = opendir( $physicalpath . $directory ) )
        {
        	print_r("is valid dir");
            $this->zip->addEmptyDir( $directory );
            while( ( $file = readdir( $handle ) ) !== false )
            {
                if (!is_file($physicalpath . $directory . '/' . $file))
                {
                	print_r("is dir");
                    if (!in_array($file, array('.', '..')))
                    {
                        $this->add_directory($directory . '/' . $file, $physicalpath);
                    }
                }
                else
                {
                	print_r("is file");
                    $this->add_file($directory . '/' . $file);                
                }
            }
        }
    }
   
    /**
     * Add a single file to the zip
     * @param string $path
     */
    public function add_file( $path )
    {
        $this->zip->addFile( $path, $path);
    }
   
    /**
     * Close the zip file
     */
    public function save()
    {
        $this->zip->close();
    }
}

/*$zip_name = 'zip_' . time() . '.zip';
$zip_directory = '/';
$zip = new zip( $zip_name, $zip_directory );
$zip->add_directory('admission-uploads', $physicalpath);
$zip->save();

$zip_path = $zip->get_zip_path();
// print_r($zip_path);
header( "Pragma: public" );
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header( "Cache-Control: public" );
header( "Content-Description: File Transfer" );
header( "Content-type: application/zip" );
header( "Content-Disposition: attachment; filename=\"" . $zip_name . "\"" );
header( "Content-Transfer-Encoding: binary" );
header( "Content-Length: " . filesize( $zip_path ) );

readfile( $zip_path );
*/

$source_dir = '../admission-uploads/';
$zip_file = 'uploads ' . date("d-m-Y H-i", strtotime(now)) . '.zip';

function folderToZip($folder, &$zipFile) {
    if ($zipFile == null) {
        // no resource given, exit
        return false;
    }
    // we check if $folder has a slash at its end, if not, we append one
    $folder .= end(str_split($folder)) == "/" ? "" : "/";
    // we start by going through all files in $folder
    $handle = opendir($folder);
    // print_r($handle);
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

header( "Pragma: public" );
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header( "Cache-Control: public" );
header( "Content-Description: File Transfer" );
header( "Content-type: application/zip" );
header( "Content-Disposition: attachment; filename=\"" . basename($zip_file) . "\"" );
header( "Content-Transfer-Encoding: binary" );
header( "Content-Length: " . filesize( $zip_file ) );
readfile($zip_file);
exit();

?>
