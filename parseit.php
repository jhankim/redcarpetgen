<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

require_once('Parsedown.php');

function getDirectory( $path = '.', $level = 0 ){ 

    $ignore = array( 'cgi-bin', '.', '..', '.git', '.DS_Store' ); 
    // Directories to ignore when listing output. Many hosts 
    // will deny PHP access to the cgi-bin. 

    // print_r($path);die();    

    $dh = opendir( $path ); 
    // Open the directory to the handle $dh 

    while( false !== ( $file = readdir( $dh ) ) ){ 
    // Loop through the directory 
     
        if( !in_array( $file, $ignore ) ){ 
        // Check that this file is not to be ignored 
             
            $spaces = str_repeat( '&nbsp;', ( $level * 4 ) ); 
            // Just to add spacing to the list, to better 
            // show the directory tree. 
            echo "<ul>";
            if( is_dir( "$path/$file" ) ){ 
            // Its a directory, so we need to keep reading down... 
                // echo "<li><strong>" . $spaces . $file . "</strong></li>"; 
                echo "<li><strong>" . $file . "</strong></li>"; 
                getDirectory( "$path/$file", ($level+1) ); 
                // Re-call this same function but on a new directory. 
                // this is what makes function recursive. 
             
            } else { 
             
                echo "<li><a href=\"?convert=$path/$file\">$file</a></li>"; 
                // Just print out the filename 
             
            } 
            echo "</ul>";
         
        } 
     
    } 
     
    closedir( $dh ); 
    // Close the directory handle 

} 

echo "<div style=\"float:left;height:100%;overflow-y:scroll\">";

getDirectory( "/Users/jae/OLAPIC/Documentation/" ); 

echo "</div>";

/* 
// List files
function listFiles(){
	$files = array();
	foreach (glob("/Users/jae/Git/Documentation/*.md") as $file) {
	  $files[] = $file;
	}
	return $files;
}



foreach(listFiles() as $val) {
    echo '<a href="?convert=' . $val . '">' . $val . '</a><br>';
}
*/

// Convert file
function convert($filename){

    $line = 'ruby redcarpet.rb ' . $filename;

    $cmd = shell_exec($line);

	return $cmd;
}

echo $_GET['convert'];

echo '<br>';

echo '<textarea disabled name="nowrap" cols="30" rows="3" wrap="off" style="font-family: Courier;width: 800px;height: 500px;">';
echo htmlspecialchars(convert($_GET['convert']));
echo '</textarea>';


?>