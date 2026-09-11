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

$first = new Player("Simon", 20);
$second = new Player("Nova", 15);
$first->levelUp();
$first->levelUp();

echo $first->getLevel() . "\n";
echo $second->getLevel() . "\n";

$player = new Player("Simon", 20);
echo $player->name . "\n";
echo $player->getLevel() . "\n";
echo $player->getHealth() . "\n";