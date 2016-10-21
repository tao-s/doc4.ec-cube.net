<?php

if (version_compare(\Eccube\Common\Constant::VERSION, '3.0.12', '>=')) {
    return;
}

if (\EccubeLog::isInitialized()) {
    return;
}

if (method_exists('Eccube\Application', 'getInstance')) {

    $app = \Eccube\Application::getInstance();

    \EccubeLog::init($app);

    return;
}

return;

class EccubeLog
{
    /** @var  \Monolog\Logger */
    protected static $logger;

    protected static $initialized = false;

    public static function init($app)
    {
        if (self::$initialized) {
            return;
        }

        self::$logger = $app['monolog'];

        $app['eccube.monolog.factory'] = $app->protect(function ($config) use ($app) {
            return $app['monolog'];
        });

        self::$initialized = true;
    }

    public static function isInitialized()
    {
        return false;
    }

    public static function emergency($message, array $context = array())
    {
        self::$logger->emergency($message, $context);
    }

    public static function alert($message, array $context = array())
    {
        self::$logger->alert($message, $context);
    }

    public static function critical($message, array $context = array())
    {
        self::$logger->critical($message, $context);
    }

    public static function error($message, array $context = array())
    {
        self::$logger->error($message, $context);
    }

    public static function warning($message, array $context = array())
    {
        self::$logger->warning($message, $context);
    }

    public static function notice($message, array $context = array())
    {
        self::$logger->notice($message, $context);
    }

    public static function info($message, array $context = array())
    {
        self::$logger->info($message, $context);
    }

    public static function debug($message, array $context = array())
    {
        self::$logger->debug($message, $context);
    }
}
