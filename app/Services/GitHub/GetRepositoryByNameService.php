<?php

namespace App\Services\GitHub;

use GuzzleHttp\Client;

class GetRepositoryByNameService
{
    public function execute(string $name)
    {
        $client = new Client();
        $result = $client->get("https://api.github.com/repos/{$name}");
        return json_decode($result->getBody()->getContents());
    }
}
