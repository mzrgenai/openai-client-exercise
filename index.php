<?php

include_once('./vendor/autoload.php');

ini_set('display_errors','On');
ini_set('max_execution_time',3600);
ini_set('memory_limi', '2G');

$apiKey='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';
$client = OpenAI::client($apiKey);

use OpenAI;

$result = $client->chat()->create([
    'model' => 'gpt-4',
    'messages' => [
        ['role' => 'user', 'content' => 'What\'s the weather like in New York?'],
    ],
    'tools' => [
        [
            'type' => 'function',
            'function' => [
                'name' => 'get_weather',
                'description' => 'Get the current weather in a given location',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'location' => [
                            'type' => 'string',
                            'description' => 'The city and state, e.g. New York, NY',
                        ],
                    ],
                    'required' => ['location'],
                ],
            ],
        ],
    ],
]);

$response = $result;
// Process the result and handle the tool call
foreach ($response->choices as $result) {
   echo $result->index; // 0
   echo $result->message->role; // 'assistant'
   echo $result->message->content; // null
   echo $result->message->toolCalls[0]->id; // 'call_123'
   echo $result->message->toolCalls[0]->type; // 'function'
   echo $result->message->toolCalls[0]->function->name; // 'get_current_weather'
   echo $result->message->toolCalls[0]->function->arguments; // "{\n  \"location\": \"Boston, MA\"\n}"
   echo $result->finishReason; // 'tool_calls'
   echo "<hr />";
}

$response->usage->promptTokens; // 82,
$response->usage->completionTokens; // 18,
$response->usage->totalTokens; // 100