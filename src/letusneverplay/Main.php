<?php

namespace letusneverplay;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

	public function onEnable(){
		$this->getConfig();
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
		$this->saveDefaultConfig();
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function join(PlayerJoinEvent $e){
		$p = $e->getPlayer();
		$player = $p->getName();
		$e->setJoinMessage(str_replace(["{player}"], [$player], $this->getConfig()->get("join-message")));
	}
	
	public function quit(PlayerQuitEvent $e){
		$p = $e->getPlayer();
		$player = $p->getName();
		$e->setQuitMessage(str_replace(["{player}"], [$player], $this->getConfig()->get("leave-message")));
	}
}