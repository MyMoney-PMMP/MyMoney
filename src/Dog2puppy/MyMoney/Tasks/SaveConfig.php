<?php

namespace Dog2puppy\MyMoney\Tasks;

use plugin\Main;
use pocketmine\scheduler\PluginTask;

class SaveConfig extends PluginTask
{
    public $plugin;

    public function __construct(Main $plugin, Player $player, $time)
    {
        parent::__construct($plugin);
        $this->plugin = $plugin;
    }

    public function getPlugin()
    {
        return $this->plugin;
    }

    public function onRun()
    {
        $this->users = new pocketmine\utils\Config($this->getDataFolder().'users.yml', Config::YAML, []);
        $this->users->save();
    }
}
