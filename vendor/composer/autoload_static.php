<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit29a4b6f5f0ed4aced61286a65ec233bf
{
    public static $files = array (
        'bb6d1954b83aa701a654d62618d32504' => __DIR__ . '/../..' . '/comFunction/function.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit29a4b6f5f0ed4aced61286a65ec233bf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit29a4b6f5f0ed4aced61286a65ec233bf::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
