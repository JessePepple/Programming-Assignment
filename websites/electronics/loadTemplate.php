<?php
// we use this to load our templates
function loadTemplate($fileName, $templateVars = [])
{
    extract($templateVars);
    ob_start();
    require $fileName;
    $contents = ob_get_clean();
    return $contents;
}