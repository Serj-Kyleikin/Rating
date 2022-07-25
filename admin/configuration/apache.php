<?php

return ["

### Перенести в основной файл настроек настроек сервера для увеличения производительности

RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php

php_value default_charset utf-8
AddType 'text/html; charset=UTF-8' html
AddDefaultCharset UTF-8
DefaultLanguage ru

Options All -Indexes

### Сжатие

#<ifModule mod_deflate.c>
#  <IfModule mod_filter.c>
#      AddOutputFilterByType DEFLATE text/plain text/html
#      AddOutputFilterByType DEFLATE text/css
#      AddOutputFilterByType DEFLATE text/javascript application/javascript application/x-javascript
#      AddOutputFilterByType DEFLATE text/xml application/xml application/xhtml+xml application/rss+xml
#      AddOutputFilterByType DEFLATE application/json
#      AddOutputFilterByType DEFLATE application/vnd.ms-fontobject application/x-font-ttf font/opentype image/svg+xml image/x-icon
#  </ifModule>
#</ifModule>

### Кеширование

#<ifModule mod_headers.c>
#    Header unset ETag
#    <FilesMatch '\.(js|css)$'>
#	    Header set Cache-Control 'max-age=2592000'
#    </FilesMatch>
#    <FilesMatch '\.(gif|jpg|jpeg|png)$'>
#	    Header set Cache-Control 'max-age=2592000'
#    </FilesMatch>
#</IfModule>
#FileETag None
"];