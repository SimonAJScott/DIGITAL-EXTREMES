<?php

/*
Object's toArray() → PHP array
json_encode()     → JSON string
Response code     → Sends the JSON to the client
*/
namespace Game;

use InvalidArgumentException;

interface Attacker{
    public function attack(): int;
}

trait BattleLogger{
    public function logAction(string $message): string{
        return "[Game] $message\n";
    }
}

abstract class Player implements Attacker{
    use BattleLogger;
    
    protected string $name;
    protected int $level;
    private array $builds = [];

    public function __construct(string $name, int $level){
        if ($level < 1) {
            throw new InvalidArgumentException("Level must be at least 1.");
        }
        if ($name === "") {
            throw new InvalidArgumentException("Name cannot be empty.");
        }
        $this->name = $name;
        $this->level = $level;
    }

    public function getSummary(): string{
        return "{$this->name} - Level {$this->level}";
    }

    abstract public function attack(): int;

    public function addBuild(Build $build): void{
        $this->builds[] = $build;
    }

    public function getBuilds(): array{
        return $this->builds;
    }

    public function getBuildCount(): int{
        return count($this->builds);
    }

    public function getOver30DamageWeaponBuilds(): string{
        foreach($this->builds as $build){
            if($build->getWeapon()->getDamage() > 29){
                return $build->getSummary();
            }
        }
    }

    public function toArray(): array{
        return [
            "name"=>$this->name,
            "level"=>$this->level,
            "buildCount"=>$this->getBuildCount()
        ];
    }

}

class Mage extends Player{
    public function attack(): int{
        return $this->level * 3;
        //Mage damage = level × 3
    }
}

class Warrior extends Player{
    public function attack(): int{
        return $this->level * 2;
        //Warrior damage = level × 2
    }
}

class Weapon{

    private string $name;
    private int $damage;

    public function __construct(string $name, int $damage){
        if ($name === ""){
            throw new InvalidArgumentException("Weapon name cannot be empty");
        }
        if ($damage < 0){
            throw new InvalidArgumentException("Damage cannot be negative");
        }
        $this->name = $name;
        $this->damage = $damage;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getDamage(): int{
        return $this->damage;
    }

    public function toArray():array{
        return [
            "name" => $this->name,
            "damage" => $this->damage
        ];
    }
}

class Build{
    private string $name;
    private Weapon $weapon;
    public function __construct(string $name, Weapon $weapon){
        if($name === ""){
            throw new InvalidArgumentException("Name cannot be empty");
        }
        $this->name = $name;
        $this->weapon = $weapon;
    }

    public function getWeapon():Weapon{
        return $this->weapon;
    }

    public function getSummary():string{
        $weaponName = $this->weapon->getName();
        $weaponDamage = $this->weapon->getDamage();
        return "{$this->name} - {$weaponName} - Damage {$weaponDamage}";
    }

    public function replaceWeapon(Weapon $weapon): void{
        $this->weapon = $weapon;
    }

    public function toArray():array{
        return[
            "name" => $this->name,
            "weaponStats"=> $this->weapon->toArray()
        ];
    }

    /*
    Why would returning only $this->getSummary() be less useful for a client that needs the weapon’s damage separately?
    returning the object is better, so we don't have to parse the output
    */
}