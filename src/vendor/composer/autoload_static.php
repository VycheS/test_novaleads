<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit57e0ebc538055202974b0d9a858c0507
{
    public static $files = array (
        '5b47b6e54ae3e33b7c5fedd8286933c8' => __DIR__ . '/../..' . '/config/init.php',
        '095ce3db15b7505d54eac079d0df9429' => __DIR__ . '/../..' . '/libs/functions/debug.php',
        'aec5178efcc09f166da85978c6683e55' => __DIR__ . '/../..' . '/libs/functions/file_get_contents_curl.php',
        '18a6000eb4fb7f4d85929bfe2599f338' => __DIR__ . '/../..' . '/libs/functions/parse.php',
    );

    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit57e0ebc538055202974b0d9a858c0507::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit57e0ebc538055202974b0d9a858c0507::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
