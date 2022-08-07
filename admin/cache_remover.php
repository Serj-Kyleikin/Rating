<?php

foreach(glob($_SERVER['DOCUMENT_ROOT'] . '/cache/*') as $file) {
    if($file != '.htaccess') unlink($file);
}

if(function_exists('opcache_reset')){
    opcache_reset(); 
}

echo "Кэш успешно сброшен!<br><br>";
echo "<a href='/'>На главную</a>";