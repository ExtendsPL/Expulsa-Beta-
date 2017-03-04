<?php

/**
* Plugin by [Colaboch]
*/

use pocketmine\event\player\PlayerPreLoginEvent;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;

class Loader extends PluginBase implements Listener{

      public function onEnable(){

          Server::getinstance()->getPluginManager()->registerEvents($this, $this);

        }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args){

            if($command->getName() === "expulsa") {
                     if($sender->hasPermission("expulsa.php")) { 
                 break;
               }
         if(count($args) == 0){
    $sender->sendMessage("§7-» [§dUsage§7] /expulsa [§dJogador§7] [§dMotivo§7]");
      return false;
         }

   //and for players offline!

  $player = array_shift($args);
        $reason = implode(" ",$args);

     if(!is_file($this->getDataFolder())) {

       @mkdir($this->getDataFolder(), 0754, true);

    $this->archive = new Config($this->getDataFolder(). ""$player"".  ".yml" ,CONFIG::YAML, ARRay());
              }
              $this->archive->set($player);
         $this->archive->set($reason);

     //for players online [IP + Port + nick]

   if(($player = $sender->getServer()->getPlayerExact($player)) instanceof Player){
             //and kick
           $player->kick("§c\nYou banned for [$reason]");
           //and nick!
        $this->archive->set($player->getName());
         //and player port!
       $this->archive->set($player->getPort());
     //and player ip!
     $this->archive->set($player->getAddress());

       $this->archive->save();
    }
     
