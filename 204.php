<?php
    if(PHP_VERSION >= 5.4)
    {
        http_response_code('204');
    }
    else
    {
        header('HTTP/1.1 204 No Content');
    }
    exit;
?>