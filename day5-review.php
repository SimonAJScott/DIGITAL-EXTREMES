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
    /*
    Explain the difference between $weapon and $this->weapon
    $this->weapon refers to this build's weapon and $weapon is the parameter for replaceWeapon()
    */
}



$sword = new Weapon("Iron Sword", 25);
$build = new Build("Melee", $sword);

$summary = $build->getSummary(); 

$build->replaceWeapon(new Weapon("Steel Sword", 35));

echo $summary . "\n";
echo $build->getSummary() . "\n";
echo $sword->getDamage() . "\n";



//Melee - Iron Sword - Damage 25
//Melee - Steel Sword - Damage 35
//25

/*
Why doesn’t the text already stored in $summary automatically update when you replace the weapon?
because we stored the result in a variable that we haven't changed yet, we need to rerun the code to get the updated summary

*/

/*
Explain why the caller should decide whether to print that string.
public function getSummary(): string
{
    echo "My build summary";
}

replace echo with return (i don't need to practice this anymore)

the caller should decide for cleanliness of the code


“Build holds a Weapon instead of extending Weapon because…”
extending is used for reusing code in multiple classes. for if the class is a type of the abstract class. weapon isn't a type of build

*/

