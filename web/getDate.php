<?php
if(isset($_POST['msg'])) {
   $mesg= $_POST['msg'];
} else {
   $mesg= 'Now is';
}
$requestHeader= apache_request_headers();
if(isset($requestHeader['x_requested_with'])) {
   echo "\n$mesg ".strftime("%d.%m.%Y %H:%M:%S")."\n\n";
} else {
   echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">';
   echo '<html><head>';
   echo '<meta http-equiv="Content-Type" content="text/html; charset=iso8859-15">';
   echo '<title>Ajax Hello</title></head><body><p>';
   echo "\n$mesg ".strftime("%d.%m.%Y %H:%M:%S")."</body></html>";
}
?>
