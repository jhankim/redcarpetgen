<?php

ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);

$line = 'ruby redcarpet.rb ~/OLAPIC/Documentation/05-Integrations/09-Etc/sdk-load-method.md';

$cmd = shell_exec($line);

echo $cmd;

?>