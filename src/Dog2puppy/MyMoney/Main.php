<?php

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\SignEventChange;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{
   public function onLoad(){
     $this->getLogger()->info("Loaded MyMoney!");
   }
   public function onEnable(){
     $this->config=new Config
     
     $this->getLogger()->info("Enabled MyMoney!");
   }
}

?>
