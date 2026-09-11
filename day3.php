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
        if (empty($name)) {
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

$mage = new Mage("Nova",10);
echo $mage->getSummary() . "\n";
echo "Damage: " . $mage->attack() . "\n";

$mage->logAction("Ready for battle.");

try{
    $invalidPlayer = new Mage("Glitch", 0);
} catch (InvalidArgumentException $error){
    echo "Could not create player: " . $error->getMessage() . "\n";

}


echo "The program continues.\n";

$warrior = new Warrior("Rook", 10);

echo $warrior->getSummary() . "\n";
echo $warrior->attack() . "\n";

$warrior->logAction("Warrior ready.");

echo getDamage($mage) . "\n";    // 30
echo getDamage($warrior) . "\n"; // 20

try{
    $invalidPlayer = new Mage("",10);
} catch (InvalidArgumentException $error){
    echo "Could not create player: " . $error->getMessage() . "\n";
}

try{
    $invalidPlayer = new Mage("Glitch", 0);
} catch (InvalidArgumentException $error){
    echo "Could not create player: " . $error->getMessage() . "\n";
}

try{
    $invalidPlayer = new Warrior("Rook",1);
} catch (InvalidArgumentException $error){
    echo "Could not create player: " . $error->getMessage() . "\n";
}