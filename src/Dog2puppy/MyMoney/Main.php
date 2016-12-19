<?php

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\SignEventChange;
use pocketmine\utils\Config;

namespace Dog2puppy\MyMoney;

class Main extends PluginBase implements Listener{
   public function onLoad(){
      $this->getLogger()->info("Loaded MyMoney.");
   }
   public function onEnable(){
      @mkdir($this->getDataFolder());
      $this->saveDefaultConfig();
      $this->config=new Config($this->getDataFolder."config.yml", Config::YAML);
      $this->config->reload();
      $this->players = new Config ($this->getDataFolder() . "players.yml" , Config::YAML);
      $this->getServer()->getPluginManager()->registerEvents($this, $this);
      $this->getLogger()->info("Enabled MyMoney.");
   }
   public function onDisable(){
      $this->getLogger()->info("Disabled MyMoney.");
   }
}

