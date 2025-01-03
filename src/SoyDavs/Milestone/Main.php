<?php

declare(strict_types=1);

namespace SoyDavs\Milestone;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\Config;
use cooldogedev\BedrockEconomy\api\BedrockEconomyAPI;
use pocketmine\player\Player;

class Main extends PluginBase {
    private Config $config;
    private array $milestones = [];
    
    protected function onEnable(): void {
        $this->saveDefaultConfig();
        $this->config = $this->getConfig();
        $this->loadMilestones();
        
        $this->getScheduler()->scheduleRepeatingTask(
            new ClosureTask(function(): void {
                foreach ($this->getServer()->getOnlinePlayers() as $player) {
                    $this->checkMilestone($player);
                }
            }), 20 * 60);
    }

    private function loadMilestones(): void {
        $this->milestones = $this->config->get("milestones", []);
    }

    private function checkMilestone(Player $player): void {
        BedrockEconomyAPI::CLOSURE()->get(
            xuid: $player->getXuid(),
            username: $player->getName(),
            onSuccess: function(array $result) use ($player): void {
                $balance = $result["amount"];
                foreach ($this->milestones as $milestone) {
                    $amount = $milestone["amount"];
                    if ($balance >= $amount) {
                        $this->executeMilestone($player, $milestone);
                    }
                }
            },
            onError: function($exception): void {
                $this->getLogger()->error("Error checking milestone: " . $exception->getMessage());
            }
        );
    }

    private function executeMilestone(Player $player, array $milestone): void {
        $playerName = $player->getName();
        
        foreach ($milestone["commands"] as $command) {
            $command = str_replace("{player}", $playerName, $command);
            $this->getServer()->dispatchCommand(
                $this->getServer()->getConsoleSender(), 
                $command
            );
        }
        
        if (isset($milestone["broadcast"])) {
            $message = str_replace(
                ["{player}", "{amount}"],
                [$playerName, number_format($milestone["amount"])],
                $milestone["broadcast"]
            );
            $this->getServer()->broadcastMessage($message);
        }
    }
}