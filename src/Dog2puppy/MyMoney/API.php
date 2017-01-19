<?php

Namespace Dog2puppy\MyMoney;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class API extends PluginBase{
   
   public function onEnable(){
      @mkdir($this->getDataFolder());
      $this->config= new Config($this->getDataFolder()."config.yml", Config::YAML, array());
      if ($this->config->get("general")["unique-files"] == true) {
         @mkdir($this->getDataFolder()."players");
      }else{
         $this->users= new Config($this->getDataFolder()."users.yml", Config::YAML, array());
      }
   }
   
   private function getPlayer($player) {
      if ($this->config->get("general")["unique-files"] == true) {
         return new Config($this->getDataFolder()."players/".strtolower($player).".yml", Config::YAML, array());
      }else{
         return $this->users;
      }
   }
   
   public function addMoney($player, $ammount) {
      if(!$this->getPlayer($player)->get($player) === null){
         $this->getPlayer($player)->set($player, $this->getPlayer($player)->get(strtolower($player))+$ammount);
      }else{
         $this->getPlayer($player)->set(strtolower($player), $ammount);
      }
      return true;
   }
   
   public function setMoney($player, $ammount) {
      $this->getPlayer($player)->set(strtolower($player), $ammount);
      return true;
   }
   
   public function takeMoney($player, $ammount) {
      if (!$this->getPlayer($player)->get(strtolower($player))) {
         if (!$this->getPlayer($player)->get(strtolower($player)) < $ammount) {
            $this->getPlayer($player)->set(strtolower($player), $this->getMoney($player)->get(strtolower($player)) - $ammount);
            return true;
         }
      }
   }

}
