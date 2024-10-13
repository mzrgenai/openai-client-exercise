<?php

include_once('./vendor/autoload.php');

ini_set('display_errors','On');
ini_set('max_execution_time',3600);
ini_set('memory_limi', '2G');

$apiKey='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';
$client = OpenAI::client($apiKey);

use OpenAI;


$stream = $client->completions()->createStreamed([
    'model' => 'gpt-3.5-turbo-instruct',
    'prompt' => 'Hi',
    'max_tokens' => 10,
]);

foreach($stream as $response){
    echo $response->choices[0]->text;
}
// 1. iteration => 'I'
// 2. iteration => ' am'
// 3. iteration => ' very'
// 4. iteration => ' excited'
// ...




