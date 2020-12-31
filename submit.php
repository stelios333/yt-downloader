<?php
$name= isset($_POST['filename'])?$_POST['filename']:0; 
$data= isset($_POST['thedata'])?$_POST['thedata']:0;  
if ($name && $data ) { 
$fp = fopen($name, "w");  
fwrite($fp, "<br>"); 
fwrite($fp, $data); 
fclose($fp); 
} 
else { 
echo 'no text entered'; 
} 
?>
