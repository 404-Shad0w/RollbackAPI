<?php

namespace RollbackAPI\events;

use pocketmine\event\Event;
use pocketmine\player\Player;

class RollbackEvent extends Event
{
    /**
     * @var Player
     */
    private $player;
    /**
     * @var array
     */
    private $items = [];
    /**
     * @var string
     */
    private $date;
    /**
     * @var int
     */
    private $id;

    /**
     * @param Player $player
     * @param array $items
     * @param string $date
     * @param int $id
     */
    public function __construct(
        Player $player,
        array $items = [],
        string $date = "",
        int $id = 0
    )
    {
        $this->player = $player;
        $this->items = $items;
        $this->date = $date;
        $this->id = $id;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player{return $this->player;}

    /**
     * @return array
     */
    public function getItems(): array{return $this->items;}

    /**
     * @return string
     */
    public function getDate(): string{return $this->date;}

    /**
     * @return int
     */
    public function getId(): int{return $this->id;}
}