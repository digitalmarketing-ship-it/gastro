<?php
$fp = fsockopen("smtp.gmail.com", 587, $errno, $errstr, 10);
if (!$fp){
    echo "Blocked: $errstr ($errno)";
}else{
    echo "SMTP Open";
}
?>