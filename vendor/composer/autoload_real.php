<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitddc21976c7d6ccc7203c7f163be4b669
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitddc21976c7d6ccc7203c7f163be4b669', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitddc21976c7d6ccc7203c7f163be4b669', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitddc21976c7d6ccc7203c7f163be4b669::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
