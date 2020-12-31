<?php
$data= isset($_POST['thedata'])?$_POST['thedata']:0;  
if ( $data ) { 
$fp = fopen("Bugs.txt", "w");  
fwrite($fp, "<br>"); 
fwrite($fp, $data); 
fclose($fp); 
} 
else { 
echo 'no text entered'; 
} 
?>
