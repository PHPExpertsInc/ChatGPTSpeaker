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

namespace PHPExperts\ChatGPTSpeaker\Tests;

use PHPExperts\ChatGPTSpeaker\ChatGPTSpeaker;
use PHPUnit\Framework\TestCase;

/** @testdox Tests for all of the README's examples */
class ReadMeTest extends TestCase
{
    public function testExample1()
    {
        $chatGPT = new ChatGPTSpeaker();

        $prompt = <<<PROMPT
        Please create a table of the PHP major version releases along with the date of release.
        PROMPT;
        $response = $chatGPT->prompt($prompt);

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function testExample2()
    {
        $chatGPT = new ChatGPTSpeaker();
        $chatGPT->returnText();

        $prompt = <<<PROMPT
        Please create a table of the PHP minor version releases along with the date of release.
        PROMPT;
        $response = $chatGPT->prompt($prompt);

//        var_dump((string)$chatGPT->api->getLastResponse()->getBody());
        //var_dump($chatGPT->api->http->testHandler->getRecords());
    }
}
