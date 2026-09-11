<?php

class Player{
    public string $name;
    protected int $level;
    private int $health = 100;

    public function __construct(string $name, int $level){
        $this->name = $name;
        $this->level = $level;
    }

    public function getSummary(): string{
        return "{$this->name} - Level {$this->level} - HP {$this->health}";
    }

    public function getLevel(): int{
        return $this->level;
    }
    
    public function getHealth(): int{
        return $this->health;
    }

    public function levelUp(): void{
        $this->level++;
    }

    public function takeDamage(int $damage): void{
        if ($damage > 0) {
            $this->health -= $damage;
        if($this->health < 0){
            $this->health = 0;
        }
        }
    }

}

class Mage extends Player{
    public function castSpell(): string{
        return "{$this->name} casts a level {$this->level} spell!";
    }
}

// $playerOne = new Player("Simon", 20);
// echo $playerOne->getSummary() . "\n";

// $playerTwo = new Player("Nova", 15);
// echo $playerTwo->getSummary() . "\n";

// echo $playerOne->getLevel() . "\n";  // 20
// echo $playerOne->getHealth() . "\n"; // 100

// $fighter = new Player("Nova", 20);

// $fighter->takeDamage(30);
// echo $fighter->getHealth() . "\n"; // Expected: 70

// $fighter->takeDamage(-10);
// echo $fighter->getHealth() . "\n"; // Expected: still 70

// $fighter->takeDamage(200);
// echo $fighter->getHealth() . "\n"; // Expected: 0

// $mage = new Mage("Nova", 25);

// echo $mage->getSummary() . "\n";
// echo $mage->castSpell() . "\n";

// $mage->levelUp();

// echo $mage->castSpell() . "\n";

$players = [
    new Player("Player1", 30),
    new Player("Player2", 15),
    new Mage("Player3", 50),
    new Player("Player4", 20)
];

foreach ($players as $player){
    if ($player->getLevel() >= 20) {
        echo $player->getSummary() . "\n";
    }
}