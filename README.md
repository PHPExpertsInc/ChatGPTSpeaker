# ChatGPTSpeaker

[![Maintainability](https://api.codeclimate.com/v1/badges/ba05b5ebfa6bb211619e/maintainability)](https://codeclimate.com/github/phpexpertsinc/RESTSpeaker/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/ba05b5ebfa6bb211619e/test_coverage)](https://codeclimate.com/github/phpexpertsinc/RESTSpeaker/test_coverage)

ChatGPTSpeaker is a PHP Experts, Inc., Project meant to ease the accessing of the OpenAI APIs.

This library uses [RESTSpeaker](https://packagist.org/package/phpexperts/rest-speaker)
to utilize the Guzzle HTTP Client via the Composition architectural pattern.

You might be very interested in the projects that used by and/or adjacent to this project:

* **PHP Evolver**
    * `composer require phpexperts/evolver` 
    * One of only two Genetic Algorithm (GA) libraries for PHP, but very easy to use.
    * One of the few AI / Machine Learning libraries for PHP.
    * https://github.com/PHPExpertsInc/php-evolver
* **RESTSpeaker**
    * `composer require phpexperts/rest-speaker`
    * A very easy way to consume REST APIs. Built on top of Guzzle but with a much better interface.
    * https://github.com/PHPExpertsInc/RESTSpeaker
* **SimpleDTO**
    * `composer require phpexperts/simple-dto`
    * Easily build validating DTOs for PHP 7.2+.
    * https://github.com/PHPExpertsInc/SimpleDTO

## Installation

Via Composer

```bash
composer require phpexperts/chatgpt-speaker
```

Copy `.env.example` to `.env` in your project's root directory and put in your OpenAI credentials.


## Change log

Please see the [changelog](CHANGELOG.md) for more information on what has changed recently.

## Usage

By default, JSON results are returned.

```php
    $chatGPT = new ChatGPTSpeaker();

    $prompt = <<<PROMPT
    Please create a table of the PHP major version releases along with the date of release.
    PROMPT;
    $response = $chatGPT->prompt($prompt);
```

Response:
```JSON
{
  "model": "gpt-3.5-turbo",
  "messages": {
    "0": {
      "role": "user",
      "content": "format responses in JSON"
    },
    "1": {
      "role": "user",
      "content": "    Please create a table of the PHP major version releases along with the date of release."
    },
    "role": "assistant",
    "content": {
      "php_major_version_releases": [
        {
          "version": "PHP 3",
          "release_date": "June 6, 1998"
        },
        {
          "version": "PHP 4",
          "release_date": "May 22, 2000"
        },
        {
          "version": "PHP 5",
          "release_date": "July 13, 2004"
        },
        {
          "version": "PHP 6",
          "release_date": "No official release"
        },
        {
          "version": "PHP 7",
          "release_date": "December 3, 2015"
        },
        {
          "version": "PHP 8",
          "release_date": "November 26, 2020"
        }
      ]
    }
  }
}

```
To get the same basic results as the ChatGPT user interface, do the following:

```php
    $chatGPT = new ChatGPTSpeaker();
    $chatGPT->returnText();

    $prompt = <<<PROMPT
        Please create a table of the PHP major version releases along with the date of release.
    PROMPT;
    $response = $chatGPT->prompt($prompt);

 
```

(From RESTSpeaker) To convert the RESTSpeaker API request into a `curl` CLI command, do this:

```shell
composer require --dev octoper/cuzzle
```
```php
$curlCLI = $chatGPT->api->http->testHandler->getRecords()[0];

Output: 
curl 'https://api.openai.com/v1/chat/completions' -A 'PHPExperts/RESTSpeaker-2.4 (PHP 8.3.3)' \
   -H 'Content-Type: application/json'  -H 'Authorization: Bearer [redacted]' \ 
   -X POST  -d '{"model":"gpt-3.5-turbo","messages":[{"role":"user","content":"Say 'Hello, World!'."}]}'
```

(From RESTSpeaker) To get the raw payload as returned by api.openai.com:

```php
$rawReturn = (string)$chatGPT->api->getLastResponse()->getBody();
```

# Use cases

 ✔ Returns the same responses as chat.openai.com.

## Testing

```bash
phpunit
```

# Roadmap

* Implement the Models endpoint
* Implement the Images endpoints
* Implement the Files endpoint
* Implement the Audio endpoints
* Implement the new Embeddings endpoints for AI Model Training
* Implement the new Fine Tunings Endpoints for custom GPT Agents
* Implement the Moderations endpoint
* Implement support for the GPT5 Agents

# Contributors

[Theodore R. Smith](https://www.phpexperts.pro/]) <theodore@phpexperts.pro>  
GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690  
CEO: PHP Experts, Inc.

## License

**CC-BY-ND-4.0**
Creative Commons NoDerivations v4.0: Please see the [license file](LICENSE) for more information.

**YOU MAY FORK THIS PROJECT.**

**YOU MAY NOT PUBLISH ANY DERIVATION of this project to either your own website or a third-party host.**


