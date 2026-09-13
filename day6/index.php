<?php

namespace Game;

use JsonException;

require_once __DIR__ . '/models.php';

function sendJson(array $data, int $status = 200): void{
    try{
        $json = json_encode(
            $data,
            JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR
        );
    } catch (JsonException $error){
        $status = 500;
        $json = '{"error": "Could not encode response."}';
    }

    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');

    echo $json;
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

$knownPaths = ['/players','/builds'];

if(!in_array($path,$knownPaths,true)){
    sendJson(["error" => "Endpoint not found."], 404);
}

if ($method !== 'GET') {
    header('Allow: GET');
    sendJson(["error" => "Only GET is supported."], 405);
}

$mage = new Mage("Simon", 20);
$mage->addBuild(
    new Build("Magic", new Weapon("Oak Staff", 40))
);

$warrior = new Warrior("Rook", 10);
$warrior->addBuild(
    new Build("Melee", new Weapon("Iron Sword", 25))
);

$players = [$mage, $warrior];

if($path === '/players'){
    $data = [];
    foreach ($players as $player){
        $data[] = $player->toArray();
    }

    sendJson(["data"=>$data]);
}

if($path === '/builds'){
    $data = [];
    foreach ($players as $player){
        foreach($player->getBuilds() as $build){
            $data[] = $build->toArray();
        }
    }
    sendJson(["data"=>$data]);
}

sendJson(["error" => "Endpoint not found."], 404);

//host server: php -S 127.0.0.1:8000 index.php
//quick run: curl.exe -i http://127.0.0.1:8000/players