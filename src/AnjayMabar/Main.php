<?php

namespace AnjayMabar;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as C;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\command\ConsoleCommandSender;

use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
        $this->getLogger()->info(C::GREEN . "[Enabled] Plugin FactionUI Enable");
    }

    public function onLoad(){
        $this->getLogger()->info(C::YELLOW . "[Loading] Plugin FactionUI Load");
    }

    public function onDisable(){
        $this->getLogger()->info(C::RED . "[Disabled] Plugin Terdapat Error / Butuh FormAPI");
    }
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "factionui":
                if($sender instanceof Player){
                    $this->openForm($sender);
                }else{
                    $sender->sendMessage("cUse Command InGame!");
                } 
                break;
        }
        return true;
    }
	
	public function openForm($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null){
			$result = $data;
            if($result === null){
                return true;
            }
            switch($result){
				case 0:
				$this->create($sender);
				break;
				case 1:
				$this->delete($sender);
				break;
				case 2:
				$this->invite($sender);
				break;
				case 3:
				$this->kick($sender);
				break;
				case 4:
				$this->demote($sender);
				break;
				case 5:
				$this->leave($sender);
				break;
				case 6:
				$this->getServer()->getCommandMap()->dispatch($sender, "f accept");
				break;
				case 7:
				$this->getServer()->getCommandMap()->dispatch($sender, "f deny");
				break;
				case 8:
				$this->say($sender);
				break;
				case 9:
				$this->getServer()->getCommandMap()->dispatch($sender, "f topfactions");
				break;
			}
		});
		$form->setTitle(C::YELLOW . "FactionUI");
		$form->setContent("aPilih Salah Satu");
		$form->addButton("eBuat");
		$form->addButton("cHapus");
		$form->addButton("dUndang");
		$form->addButton("1Tendang");
		$form->addButton("2Turunkan");
		$form->addButton("3Tinggalkan");
		$form->addButton("6Terima");
		$form->addButton("5Tolak");
		$form->addButton("7Pengumuman Faction");
		$form->addButton("aTop Faction");
	}
	
	public function create(Player $sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $f = $api->createCustomForm(function (Player $sender, $data){
			$cok = $data[0];
            if($data !== null){
				$this->factionName = $cok;
			    $this->getServer()->getCommandMap()->dispatch($sender, "f create" . $this->factionName);
            }
	    });
		$f->setTitle(C::YELLOW . "FactionUI");
		$f->addInput("aTulis Nama Baru Dibawah sini", "Indonesian Team");
		$f->sendToPlayer($sender);
	}
	
	public function delete($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
            $this->getServer()->getCommandMap()->dispatch($sender, "f delete");
                break;
				case 1:
				$command = "factionui" ;
                $this->getServer()->getCommandMap()->dispatch($sender, $command);
				break;

            }
        });
        $form->setTitle(C::YELLOW . "FactionUI");
        $form->setContent("eApakah Anda Yakin Ingin Menghapus Faction Ini?");
        $form->addButton("aYa");
		$form->addButton("cTidak");
        $form->sendToPlayer($sender);
        return $form;
    }
	
	public function invite(Player $sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $f = $api->createCustomForm(function (Player $sender, $data){
			$cok = $data[0];
            if($data !== null){
				$this->playerName = $cok;
			    $this->getServer()->getCommandMap()->dispatch($sender, "f invite" . $this->playerName);
            }
	    });
		$f->setTitle(C::YELLOW . "FactionUI");
		$f->addInput("aTulis Nama Pemain Dibawah sini", "AnjayMabar5320");
		$f->sendToPlayer($sender);
	}
	
	public function kick(Player $sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $f = $api->createCustomForm(function (Player $sender, $data){
			$cok = $data[0];
            if($data !== null){
				$this->playerName = $cok;
			    $this->getServer()->getCommandMap()->dispatch($sender, "f invite" . $this->playerName);
            }
	    });
		$f->setTitle(C::YELLOW . "FactionUI");
		$f->addInput("aTulis Nama Pemain Dibawah sini", "AnjayMabar5320");
		$f->sendToPlayer($sender);
	}
	
	public function demote(Player $sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $f = $api->createCustomForm(function (Player $sender, $data){
			$cok = $data[0];
            if($data !== null){
				$this->playerName = $cok;
			    $this->getServer()->getCommandMap()->dispatch($sender, "f demote" . $this->playerName);
            }
	    });
		$f->setTitle(C::YELLOW . "FactionUI");
		$f->addInput("aTulis Nama Pemain Dibawah sini", "AnjayMabar5320");
		$f->sendToPlayer($sender);
	}
	
	public function leave($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
            $this->getServer()->getCommandMap()->dispatch($sender, "f leave");
                break;
				case 1:
				$command = "factionui" ;
                $this->getServer()->getCommandMap()->dispatch($sender, $command);
				break;

            }
        });
        $form->setTitle(C::YELLOW . "FactionUI");
        $form->setContent("eApakah Anda Yakin Ingin Meninggalkan Faction Ini?");
        $form->addButton("aYa");
		$form->addButton("cTidak");
        $form->sendToPlayer($sender);
        return $form;
    }
	
	public function say(Player $sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $f = $api->createCustomForm(function (Player $sender, $data){
			$cok = $data[0];
            if($data !== null){
				$this->sayName = $cok;
			    $this->getServer()->getCommandMap()->dispatch($sender, "f say" . $this->sayName);
            }
	    });
		$f->setTitle(C::YELLOW . "FactionUI");
		$f->addInput("aTulis Pengumuman Dibawah sini", "Kumpul");
		$f->sendToPlayer($sender);
	}
	
	
	
	
	
	
}