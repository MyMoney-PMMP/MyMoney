<?php

namespace Dog2puppy\MyMoney\Tasks;

use pocketmine\scheduler\PluginTask;
use plugin\Main;

class SaveConfig extends PluginTask {

    public $plugin;

      public function __construct(Main $plugin, Player $player, $time) {
          parent::__construct($plugin);
          $this->plugin = $plugin;
      }

      public function getPlugin() {
          return $this->plugin;
      }

      public function onRun() {
         $this->getPlugin()->$config->save();
      }
}
