<?php
// /https://www.youtube.com/watch?v=x9bj30cWolA
namespace Game;

use InvalidArgumentException;

trait BattleLogger{
    public function logAction(string $message): void{
        echo "[Game] $message\n";
    }
}

interface Attacker{
    public function attack(): int;
}

abstract class Player implements Attacker{
    use BattleLogger;
    
    protected string $name;
    protected int $level;

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

//trait: code that can be reused in multiple classes (has)
//interface: defines a contract that classes must follow (contract)
//abstract class: a class that cannot be instantiated on its own, but can be extended by other classes

class Turret implements Attacker{
    public function attack(): int{
        return 12;
    }
}

$turret = new Turret();

echo getDamage($turret) . "\n"; // Expected: 12

$mageTest = new Mage("0", 10);


