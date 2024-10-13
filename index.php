<?php

include_once('./vendor/autoload.php');

ini_set('display_errors','On');
ini_set('max_execution_time',3600);
ini_set('memory_limi', '2G');

$apiKey='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';
$client = OpenAI::client($apiKey);

use OpenAI;


// $api = 'http://127.0.0.1:11434';

// $yourApiKey = getenv('YOUR_API_KEY');
$client = OpenAI::client($apiKey);

$result = $client->chat()->create([
    'model' => 'gpt-4',
    'messages' => [
        ['role' => 'user', 'content' => 'Hello!'],
    ],
]);

echo $result->choices[0]->message->content; // Hello! How can I assist you today?



