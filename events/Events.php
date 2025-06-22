<?php

namespace RollbackAPI\events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\PluginManager;
use pocketmine\Server;
use RollbackAPI\storages\RollbackStorage;
use Yaf\Dispatcher;
use pocketmine\event\EventDispatcher;

class Events implements Listener{
    public function __construct(private PluginBase $plugin){}

    /**
     * @param PlayerDeathEvent $event
     * @return void
     */
    public function DeathEvent(PlayerDeathEvent $event): void
    {
        $player = $event->getPlayer();
        $items = $event->getDrops();
        $date = date("Y-m-d H:i:s");
        $id = 0;

        // Create a RollbackEvent instance
        $rollbackEvent = new RollbackEvent($player, $items, $date, $id);
        $rollbackEvent->call();
    }

    /**
     * @param RollbackEvent $event
     * @return void
     */
    public function RollbackEvent(RollbackEvent $event)
    {
        $player = $event->getPlayer();
        $items = $event->getItems();
        $date = $event->getDate();
        $id = $event->getId();

        $player->sendMessage("Rollback initiated for " . $date);
        RollbackStorage::saveRollbackData($player->getName(), $items, $date, $id);
    }
}