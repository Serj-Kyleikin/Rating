<?php

return [
    'core' => [
        '0740' => [
            'configurations/connection.php' => '',
            '.htaccess' => "",
            'logs/.htaccess' => "<FilesMatch '.txt$'>
    deny from all
</FilesMatch>",
            'logs/plugins/users/.htaccess' => "<FilesMatch '.txt$'>
    deny from all
</FilesMatch>",
            'cache/.htaccess' => "<FilesMatch '.tmp$'>
    deny from all
</FilesMatch>",
            'configurations/.htaccess' => "<FilesMatch '.php$'>
    deny from all
</FilesMatch>"
        ]
    ],
    'plugins' => [
        '0740' => [
            'logs/diagnostic_errors.txt' => '',
            'logs/db_errors.txt' => '',
            'logs/resourse_errors.txt' => '',
            'logs/plugins/users/authorizations.txt' => '',
            'logs/plugins/users/errors.txt' => ''
        ]
    ]
];