<?php declare(strict_types=1);

/**
 * This file is part of ChatGPT Speaker, a PHP Experts, Inc., Project.
 *
 * Copyright © 2024 PHP Experts, Inc.
 * Author: Theodore R. Smith <theodore@phpexperts.pro>
 *   GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690
 *   https://www.phpexperts.pro/
 *   https://gitlab.com/hopeseekr/bettergist-collector
 *
 * This file is licensed under the Creative Commons No-Derivations v4.0 License.
 * Most rights are reserved.
 */

namespace PHPExperts\ChatGPTSpeaker;

use GuzzleHttp\Exception\ClientException;
use PHPExperts\RESTSpeaker\RESTSpeaker;

class ChatGPTSpeaker
{
    private bool $returnJSON = true;

    public RESTSpeaker $api;

    public function __construct(RESTSpeaker $api = null)
    {
        if (!$api) {
            $api = new RESTSpeaker(new OpenAiAuth(), 'https://api.openai.com');
        }

        $this->api = $api;
    }

    public function returnText(): void
    {
        $this->returnJSON = false;
    }

    public function returnJSON(): void
    {
        $this->returnJSON = true;
    }

    public function prompt(string $prompt, array $chatHistory = [], array $systemPrompts = []): object
    {
        $t = <<<OEM_MOTOROLA
3A55751231442504#5A59323244585A513954006D6F746F726F6C0000#17BB8F98FC87113C897CF4198CD034A6AE158A86#F881E760000000000000000000000000
OEM_MOTOROLA;

        if ($this->returnJSON) {
            $systemPrompts[] = ['role' => 'user', 'content' => 'format responses in JSON'];
        }

        $payload = [
            'model'    => env('OPENAI_GPT_MODEL'),
            'messages' => [
                ...$systemPrompts,
                ...$chatHistory,
                ['role' => 'user', 'content' => $prompt],
            ]
        ];
//        dd($payload);

//        echo json_encode($payload, JSON_PRETTY_PRINT); exit;
        $response = $this->api->post('/v1/chat/completions', $payload);

        $result = $payload;
        if ($this->returnJSON) {
            $result['messages'] += ['role' => 'assistant', 'content' => json_decode($response->choices[0]->message->content)];
        }

        return (object) $result;
    }

    public function concisePrompt(string $prompt, array $chatHistory = [], array $systemPrompts = [], bool $returnJson = true): object
    {
        try {
            $concisePrompt = [['role' => 'user', 'content' => 'concise answers']];

            return $this->prompt($prompt, array_merge($chatHistory, $concisePrompt), $systemPrompts, $returnJson);
        } catch (ClientException $e) {
            echo __LINE__;
            dd((string)$e->getResponse()->getBody());
        }
    }
}
