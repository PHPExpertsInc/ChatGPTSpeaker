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

use PHPExperts\RESTSpeaker\RESTAuth;
use PHPExperts\RESTSpeaker\RESTSpeaker;

class OpenAiAuth extends RESTAuth
{
    private $apiKey;

    public function __construct(RESTSpeaker $apiClient = null)
    {
        parent::__construct(RESTAuth::AUTH_MODE_XAPI, $apiClient);

        $this->apiKey = env('OPENAI_KEY');
    }

    public function generateXAPITokenOptions(): array
    {
        return [
            'headers' => [
                'Authorization' => "Bearer $this->apiKey"
            ]
        ];
    }
}
