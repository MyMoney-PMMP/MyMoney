<?php

/*
 * MyMoney is licensed under the BoxOfDevs license 1.1.2
 *
 * By using MyMoney you automatically agree to the license.
 */

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

namespace Dog2puppy\MyMoney;

class Main extends PluginBase implements Listener
{
    public function onLoad()
    {
        $this->getLogger()->info('Loaded MyMoney.');
    }

    public function onEnable()
    {
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->config = new Config($this->getDataFolder.'config.yml', Config::YAML);
        $this->config->reload();
        $this->players = new Config($this->getDataFolder().'players.yml', Config::YAML);
        $API = new API();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info('Enabled MyMoney.');
    }

    public function onDisable()
    {
        $this->getLogger()->info('Disabled MyMoney.');
    }

    public function createTask()
    {
        $task = new Dog2puppy\MyMoney\Tasks\SaveConfig($this); // A class that extends pocketmine\scheduler\PluginTask
             // The Task handler
             $h = $this->getServer()->getScheduler()->scheduleRepeatingTask($task, 4800);
             // Set the task's handler
             $task->setHandler($h);
    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args)
    {
        switch (strtolower($cmd->getName())) {
          case 'givemoney':
            if ($sender->hasPermission('perm')) {
                if (isset($args[0])) {
                    $p = $args[0];
                    if (isset($args[1])) {
                        $a = $args[1];
                        $API->addMoney($p, $a);
                    } else {
                        $sender->sendMesssage('Invalid Amount!');
                    }
                } else {
                    $sender->sendMessage('/givemoney <name> <amt>');
                }
            } else {
                $sender->sendMessage('You have no permission to use this command!');
            }

            return true;
         break;

         case 'setmoney':
            if ($sender->hasPermission('mymoney.setmoney')) {
                if (isset($args[0])) {
                    $p = $args[0];
                    if (isset($args[1])) {
                        $a = $args[1];
                        $API->setMoney($p, $a);
                    } else {
                        $sender->sendMesssage('Invalid Amount!');
                    }
                } else {
                    $sender->sendMessage('/setmoney <name> <amt>');
                }
            } else {
                $sender->sendMessage('You have no permission to use this command!');
            }

            return true;
         break;

        case 'takemoney':
            if ($sender->hasPermission('mymoney.takemoney')) {
                if (isset($args[0])) {
                    $p = $args[0];
                    if (isset($args[1])) {
                        $a = $args[1];
                        $API->takeMoney($p, $a);
                    } else {
                        $sender->sendMesssage('Invalid Amount!');
                    }
                } else {
                    $sender->sendMessage('/takemoney <name> <amt>');
                }
            } else {
                $sender->sendMessage('You have no permission to use this command!');
            }

            return true;
         break;
        // add more
      }
    }

    public function onSignChange(SignChangeEvent $event)
    {
        $lines = $event - getLines();
        if ($lines[0] == '[ServerShop]') {
            if (strpos('buy ', $lines[1]) or strpos('sell ', $lines[1])) {
                if (isset($lines[2])) {
                    $event->setLine('$'.$lines[2]);
                    if ($lines[3] == $minecraftItem) {
                        $event->getPlayer->sendMessage('Created a server shop!');
                    }
                }
            }
        }
    }
}
