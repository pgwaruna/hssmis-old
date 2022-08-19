<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite3a5ad4de0eaaf3c26a4e6cf461e9e2d
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Src\\' => 4,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite3a5ad4de0eaaf3c26a4e6cf461e9e2d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite3a5ad4de0eaaf3c26a4e6cf461e9e2d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite3a5ad4de0eaaf3c26a4e6cf461e9e2d::$classMap;

        }, null, ClassLoader::class);
    }
}
