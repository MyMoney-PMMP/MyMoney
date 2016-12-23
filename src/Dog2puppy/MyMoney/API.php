<?php

Namespace Dog2puppy\MyMoney;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class API extends PluginBase{
   
   public function onEnable(){
      @mkdir($this->getDataFolder());
      $this->users= new Conig($this->getDataFolder()."users.yml", Config::YAML, array());
   }
   
   public function addMoney($player, $ammount) {
      
   }

}
