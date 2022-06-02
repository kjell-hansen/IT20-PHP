<?php

declare (strict_types=1);
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

echo getenv( 'DOCUMENT_ROOT')."<br>";
echo __DIR__;