<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit095f1e40b1559b1d87af7765efddd34a
{
    public static $files = array (
        'cfe4039aa2a78ca88e07dadb7b1c6126' => __DIR__ . '/../..' . '/config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'App\\Controller\\CashierController' => __DIR__ . '/../..' . '/App/Controller/CashierController.php',
        'App\\Controller\\CustomerController' => __DIR__ . '/../..' . '/App/Controller/CustomerController.php',
        'App\\Controller\\ItemController' => __DIR__ . '/../..' . '/App/Controller/ItemController.php',
        'App\\Controller\\LocalitieController' => __DIR__ . '/../..' . '/App/Controller/LocalitieController.php',
        'App\\Controller\\OrderController' => __DIR__ . '/../..' . '/App/Controller/OrderController.php',
        'App\\Controller\\PageController' => __DIR__ . '/../..' . '/App/Controller/PageController.php',
        'App\\Controller\\ProductController' => __DIR__ . '/../..' . '/App/Controller/ProductController.php',
        'App\\Controller\\SectionController' => __DIR__ . '/../..' . '/App/Controller/SectionController.php',
        'App\\Controller\\UserController' => __DIR__ . '/../..' . '/App/Controller/UserController.php',
        'App\\Models\\Cashier' => __DIR__ . '/../..' . '/App/Models/Cashier.php',
        'App\\Models\\Customer' => __DIR__ . '/../..' . '/App/Models/Customer.php',
        'App\\Models\\DB' => __DIR__ . '/../..' . '/App/Models/DB.php',
        'App\\Models\\Helper' => __DIR__ . '/../..' . '/App/Models/Helper.php',
        'App\\Models\\Item' => __DIR__ . '/../..' . '/App/Models/Item.php',
        'App\\Models\\Locality' => __DIR__ . '/../..' . '/App/Models/Locality.php',
        'App\\Models\\Order' => __DIR__ . '/../..' . '/App/Models/Order.php',
        'App\\Models\\Page' => __DIR__ . '/../..' . '/App/Models/Page.php',
        'App\\Models\\Product' => __DIR__ . '/../..' . '/App/Models/Product.php',
        'App\\Models\\Section' => __DIR__ . '/../..' . '/App/Models/Section.php',
        'App\\Models\\User' => __DIR__ . '/../..' . '/App/Models/User.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit095f1e40b1559b1d87af7765efddd34a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit095f1e40b1559b1d87af7765efddd34a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit095f1e40b1559b1d87af7765efddd34a::$classMap;

        }, null, ClassLoader::class);
    }
}
