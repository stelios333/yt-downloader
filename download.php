<?php
  exec("pip install --upgrade youtube_dl");
  $command = escapeshellcmd("youtube-dl -f best --get-url ".$_GET["url"]);
  $output = shell_exec($command);
  header("Location: ".$output)
?>
