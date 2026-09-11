<?php

namespace Game;

use InvalidArgumentException;

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
}

/*

“Why does Build hold a Weapon instead of extending it?”
extending is for if i want multiple classes to share methods or data, build doesn't share anything with weapon worth extending

“Why does getSummary() return a string while replaceWeapon() returns void?”
getsummary is for printing the summary later, replaceweapon actually changes where $weapon is pointing, its like viewing the data vs changing the data

“What was hardest to rebuild without looking, and what helped me fix it?”
remembering the syntax was the hardest part, i looked into documentation which was good practice

*/

$sword = new Weapon("Iron Sword", 25);
$build = new Build("Melee", $sword);

echo $build->getSummary() . "\n";

$build->replaceWeapon(new Weapon("Steel Sword", 35));

echo $build->getSummary() . "\n";
echo "Original sword damage: " . $sword->getDamage() . "\n";

try {
    new Build("", $sword);

    echo "FAIL: empty name accepted.\n";
} catch (InvalidArgumentException $error) {
    echo "PASS: empty name rejected.\n";
}

$zeroName = new Build("0", $sword);

echo $zeroName->getSummary() . "\n";