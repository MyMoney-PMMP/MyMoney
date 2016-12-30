<?php

Namespace Dog2puppy\MyMoney;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class API extends PluginBase{
   
   public function onEnable(){
      @mkdir($this->getDataFolder());
      $this->config= new Config($this->getDataFolder()."config.yml", Config::YAML, array());
      $unique-files= $this->config->get("general")["unique-files"];
      if ($unique-files == true) {
         @mkdir($this->getDataFolder()."players");
      }else{
         $this->users= new Config($this->getDataFolder()."users.yml", Config::YAML, array());
      }
   }
   
   public function getPlayer($player) {
      if ($unique-files == true) {
         return new Config($this->getDataFolder()."players/".$player.".yml", Config::YAML, array());
      }else{
         return $this->users;
      }
   
   public function addMoney($player, $ammount) {
      if(!$this->users->get($player) === null){
         $this->users->set($player, $this->users->get($player)+$ammount);
      }else{
         $this->users->set($player, $ammount);
      }
      return true;
   }
   
   public function setMoney($player, $ammount) {
      $this->users->set($player, $ammount);
      return true;
   }
   
   public function takeMoney($player, $ammount) {
      if (!$this->users->get($player)) {
         if (!$this->users->get($player) < $ammount) {
            $this->users->set($player, $this->users->get($player) - $ammount);
            return true;
         }
      }
   }

}
