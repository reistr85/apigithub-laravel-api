<?php

namespace App\Services\GitHub;

use GuzzleHttp\Client;

class GetRepositoriesService
{
    private Array $repos;

    public function __construct()
    {
//        $this->repos = ['vuejs/vue', 'rails/rails', 'php/php-src', 'facebook/react', 'nodejs/node',
//            'flutter/flutter', 'elixir-lang/elixir'];
        $this->repos = ['reistr85'];
    }

    public function execute()
    {
        $client = new Client();
        $repositories= [];

        foreach ($this->repos as $repository) {
            $result = $client->get("https://api.github.com/users/{$repository}", [
                'headers' => [
                    'client_id' => '50644637d56edba95a80',
                    'client_secret' => '4d92713c5b2de4c69a79baaef1b13127fcba900a'
                ]
            ]);
            $response = json_decode($result->getBody()->getContents());
            $repositories[$response->full_name] = $response;
        }


        dd($repositories);
    }
}
