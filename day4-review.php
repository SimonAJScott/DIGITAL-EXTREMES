<?php

namespace Game;

use InvalidArgumentException;

interface Attacker{
    public function attack(): int;
}

trait BattleLogger{
    public function logAction(string $message): void{
        echo "[Game] $message\n";
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
}

class Build{
    private string $name;
    private Weapon $weapon;

    public function __construct(string $name,Weapon $weapon){
        if($name === ""){
            throw new InvalidArgumentException("Build name cannot be empty");
        }

        $this->name = $name;
        $this->weapon = $weapon;
    }

    public function getWeapon(): Weapon{
        return $this->weapon;
    }

    public function getSummary():string{
        $weaponName = $this->weapon->getName();
        $damage = $this->weapon->getDamage();

        return "{$this->name} - $weaponName - Damage $damage";
    }

    public function replaceWeapon(Weapon $weapon):void{
        $this->weapon = $weapon;
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

    public function getOver30DamageWeaponBuilds(): void{
        foreach($this->builds as $build){
            if($build->getWeapon()->getDamage() > 29){
                echo $build->getSummary() . "\n";;
            }
        }
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

function getDamage(Attacker $character): int{
    return $character->attack();
}

$sword = new Weapon("Iron Sword", 25); //new weapon
$build = new Build("Melee", $sword); //new build with weapon

$player = new Mage("Simon", 20); //new player
$player->addBuild($build); //adding build to player

$build->replaceWeapon(new Weapon("Steel Sword", 35)); //replacing weapon in build with steel

echo $player->getBuildCount() . "\n"; // 1
echo $player->getBuilds()[0]->getWeapon()->getDamage() . "\n"; //35
echo $sword->getDamage() . "\n"; //25

$builds = [
    new Build("Light", new Weapon("Dagger", 29)),
    new Build("Balanced", new Weapon("Spear", 30)),
    new Build("Heavy", new Weapon("Hammer", 31))
];

foreach($builds as $build){
    if ($build->getWeapon()->getDamage() >= 40){
        echo $build->getSummary() . "\n";
    }
}