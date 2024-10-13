<?php

include_once('./vendor/autoload.php');

ini_set('display_errors','On');
ini_set('max_execution_time',3600);
ini_set('memory_limi', '2G');

$apiKey='apikey';
$client = OpenAI::client($apiKey);

use OpenAI;

$response = $client->audio()->translate([
    'model' => 'whisper-1',
    'file' => fopen('audio-example.mp3', 'r'),
    'response_format' => 'verbose_json',
]);

$response->task; // 'translate'
$response->language; // 'Ger'
$response->duration; // 2.95
$response->text; // 'Hello, how are you?'

foreach ($response->segments as $segment) {
    // $segment->index; // 0
    $segment->seek; // 0
    $segment->start; // 0.0
    $segment->end; // 4.0
    $segment->text; // 'Hello, how are you?'
    $segment->tokens; // [50364, 2425, 11, 577, 366, 291, 30, 50564]
    $segment->temperature; // 0.0
    $segment->avgLogprob; // -0.45045216878255206
    $segment->compressionRatio; // 0.7037037037037037
    $segment->noSpeechProb; // 0.1076972484588623
    $segment->transient; // false
}

print_r($response->toArray()); // ['task' => 'translate', ...]
