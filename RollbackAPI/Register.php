<?php

namespace RollbackAPI;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use RollbackAPI\events\Events;
use RollbackAPI\events\RollbackEvent;

class Register
{
    public function __construct(PluginBase $plugin){
        self::$plugin = $plugin;
    }

    /**
     * @var bool
     */
    private static bool $registered = false;
    private static $plugin;

    /**
     * @return void
     */
    public static function Register(): void{
        if (self::$registered) {
            return;
        }

        self::$registered = true;
        Server::getInstance()->getPluginManager()->registerEvents(new Events(self::$plugin), self::$plugin);
    }

    /**
     * @return bool
     */
    public static function isRegister(): bool
    {
        return self::$registered;
    }
}