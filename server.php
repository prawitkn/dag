if ($uri !== '/' && file_exists(__DIR__.'./../public_html'.$uri)) {
    return false;
}

require_once __DIR__.'./../public_html/index.php';