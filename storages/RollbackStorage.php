<?php

namespace RollbackAPI\storages;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\PluginManager;
use pocketmine\utils\Config;

class RollbackStorage
{
    protected static PluginBase $plugin;
    protected static Config $config;
    private static $rollbacks = [];

    /**
     * @param PluginBase $plugin
     */
    public function __construct(PluginBase $plugin)
    {
        self::$plugin = $plugin;
        self::$config = new Config($plugin->getDataFolder() . "rollback.json", Config::JSON);
        self::$rollbacks = self::$config->getAll();
    }

    /**
     * Save rollback data to the storages.
     *
     * @param string $playerName
     * @param array $items
     * @param string $date
     * @param string $day
     * @param int $id
     */
    public static function saveRollbackData(string $playerName, array $items, string $date, int $id): void
    {
        $data = [
            'player' => $playerName,
            'items' => $items,
            'date' => $date,
            'id' => $id
        ];

        self::$config->set($playerName, $data);
        self::$config->save();
    }

    /**
     * @param string $playerName
     * @return bool
     * @throws \JsonException
     */
    public static function removeRollbackData(string $playerName): bool
    {
        if (!isset(self::$rollbacks[$playerName])) return false;

        self::$config->remove($playerName);
        self::$config->save();
        return true;
    }

    /**
     * @param string $playerName
     * @return mixed
     */
    public static function getRollbackData(string $playerName): mixed
    {
        return self::$config->get($playerName);
    }

    /**
     * @return array|mixed[]|string[]
     */
    public static function getAllRollbackData(): array
    {
        return self::$rollbacks;
    }
}