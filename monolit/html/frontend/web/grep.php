<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
if (5==6):
    header("HTTP/1.0 404 Not Found"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Потрачено</title>
</head>
<body>
<div style="position:fixed;top:0;left:0;right:0;bottom:0;background:black;display:flex;justify-content:center;align-items:center;">
    <div style="color:red;font-size:90px;font-weight:900;">ПОТРАЧЕНО</div>
</div>
</body>
</html>

<?php die(); endif; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="generator" content="TextMate + PHP">
	<meta name="author" content="Bernhard Waldbrunner">
	<style type="text/css">
	/* <![CDATA[ */
	* {
		font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
		font-size: 12pt;
	}
	label {
        width: 5em;
        display: inline-block;
        color: #333;
        font-weight: 600;
	}
	ol {
		margin-left: 5em;
		padding-left: 0.3em;
	}
	input[type=submit] {
		font-size: 12pt;
	}
    body {
        padding: 20px;
    }
    form > div {
        margin-bottom: 10px
    }

    form > div input[type=text] {
        width: 400px;
        padding: 8px;
        border: none;
        border-bottom: 2px solid orange;
        outline: none;
    }

    input[type=submit] {
        width: 350px;
    }

    form > div input[type=text]:focus {
        border-bottom-color: red;
    }
    pre {
        font-family: monospace;
        font-size: 12px;
    }
	/* ]]> */
	</style>
	<title>grep</title>
</head>
<body>
<?php
if (get_magic_quotes_gpc())
{
    function stripslashes_gpc (&$value)
    {
        $value = stripslashes($value);
    }
    array_walk_recursive($_GET, 'stripslashes_gpc');
    array_walk_recursive($_POST, 'stripslashes_gpc');
    array_walk_recursive($_COOKIE, 'stripslashes_gpc');
    array_walk_recursive($_REQUEST, 'stripslashes_gpc');
}
/**
*	powered by @cafewebmaster.com
*	free for private use 
*	please support us with donations ber
*/
define("SLASH", stristr($_SERVER['SERVER_SOFTWARE'], "win") ? "\\" : "/");
$path	= (@$_GET['path'] ? $_GET['path'] : dirname(__FILE__));
$q		= @$_GET['q'];
$filter = (@$_GET['filter'] ? $_GET['filter'] : "*");
$self   = $_SERVER['PHP_SELF'];
$links  = (@$_GET['links'] ? 'checked="checked"' : '');
$regex  = (@$_GET['regex'] ? 'checked="checked"' : '');
$trim   = strlen($path) + 1;
function php_grep ($q, $path)
{
	global $filter, $trim, $links, $regex;
	$fp = opendir($path);
	$ret = "";
	while (($f = readdir($fp)) !== false)
	{
		$file_path = $path.SLASH.$f;
		if ($f == "." or $f == ".." or $file_path == __FILE__ or
		   (!$links and is_link($file_path)) or
		   (is_file($file_path) and !fnmatch($filter, $f)))
			continue;
		if (is_dir($file_path))
			$ret .= php_grep($q, $file_path);
        else if ($regex ? preg_match($q, file_get_contents($file_path),$match) : $string = stristr(file_get_contents($file_path), $q)){
            $ret .= "<li>".$path.'/'.htmlspecialchars(substr($file_path, $trim))."</li>\n";
			$ret .= $regex ? "<pre>" . htmlspecialchars($match[0]) . "</pre>":"<pre>".htmlspecialchars(substr($string, 0, 50))."\n</pre>";
        }
	}
	closedir($fp);
	return $ret;
}
$results = "";
if ($q)
{
	$results = php_grep($q, $path);
	$results = ($results ? "<ol>\n".$results."</ol>\n" : '<p>Ничего не найдено.</p>');
}
$path = htmlspecialchars($path);
$q = htmlspecialchars($q);
$filter = htmlspecialchars($filter);
echo <<<HTML
<form method="get" action="$self">
	<div><label for="path">Путь:</label><input type="text" id="path" name="path" size="70" value="$path"></div>
    <div style="color:#666;font-size:12px;margin-top:5px;margin-bottom:0;">Возможно использование регулярного выражения (~^[a-z]~)</div>
	<div><label for="query">Строка:</label><input type="text" id="query" name="q" size="70" value="$q"></div>
    <div style="color:#666;font-size:12px;margin-top:5px;margin-bottom:0;">Стандартный фильтр по файлам (*.php)</div>
	<div><label for="filter">Фильтр:</label><input type="text" id="filter" name="filter" size="30" value="$filter"></div>
	<div><label for="links">Symlinks:</label><input type="checkbox" id="links" name="links" $links></div>
	<div><label for="regex">RegExp:</label><input type="checkbox" id="regex" name="regex" $regex> (Регулярка должны быть с разделителями)</div>
	<div><label></label><input type="submit" value="Найти"></div>
</form>
<hr>
$results
HTML;
?>
</body>
</html>
