<?php
// $name = "Simon";
// $level = 25;
// $isOnline = true;
// $rating = 4.8;

// function getLevel(string $username): int
// {
//     return 25;
// }


// echo "Day1\n";
// echo "Name: " . $name . "\n";
// echo "Level: " . $level . "\n";
// echo "Is Online: " . ($isOnline ? "Yes" : "No") . "\n";
// echo "Rating: " . $rating . "\n";

// $weapons = ["Sword","Bow", "Axe","Staff","Shield","Dagger","Spear","Mace"];

// echo "weapons[0]: " . $weapons[0] . "\n";

// $player = ["name" => "Simon", "level" => 25, "health" => 100];

// echo "Player Name: " . $player["name"] . "\n";
// echo "Player Level: " . $player["level"] . "\n";

// echo $player["name"] . " is level " . $player["level"] . " and has " . $player["health"] . " HP.\n";

// foreach ($weapons as $weapon){
//     echo "Weapon: " . $weapon . "\n";
// }

// foreach ($player as $key => $value){
//     echo $key . ": " . $value . "\n";
// }


// function calculateDamage(int $attack, int $defense): int
// {
//     if($defense > $attack){
//         return 0;
//     } else{
//         return $attack - $defense;
//     }

// }

// echo calculateDamage(100,35) . "\n";
// echo calculateDamage(50,75) . "\n";

// Exercise 6: Player filter

$players = [
    [
        "name" => "Player1",
        "level" => 30
    ],
    [
        "name" => "Player2",
        "level" => 15
    ],
    [
        "name" => "Player3",
        "level" => 50
    ]
];

// First, write a loop that prints every player:

// Player1 - Level 30
// Player2 - Level 15
// Player3 - Level 50

// Next, modify your loop to print only players whose level is at least 20:

// Player1 - Level 30
// Player3 - Level 50

foreach ($players as $player){
    if ($player['level'] >= 20) {
        echo $player['name'] . " - Level " . $player['level'] . "\n";
    }
}
