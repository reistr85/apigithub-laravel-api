<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepositoryTest extends TestCase
{

    private array $repository;
    private string $url_base;
    private array $headers;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->repository = [
            'github_id' => '11730342',
            'name' => 'vuejs/vue',
            'description' => 'Vue.js is a progressive, incrementally-adoptable JavaScript framework for building UI on the web.',
            'url' => 'https://api.github.com/repos/vuejs/vue',
            'avatar_url' => "https://avatars.githubusercontent.com/u/6128107?v=4",
            'stargazers_count' => "193171",
            'language' => "JavaScript"
        ];

        $this->url_base = 'api/v1/repositories';
        $this->headers = ['api_key' => 'base64:wMpjcDnogmIW+tjQ4/iFtW/Jyp34S42WRf/RA3skKDw='];
    }

    private function config()
    {
        $this->artisan('migrate:fresh');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldHaveSuccessIndexRequests()
    {
        $this->config();
        $response = $this->get("{$this->url_base}", $this->headers);
        $response->assertStatus(200);
        $repositories = json_decode($response->getContent());
        $this->assertCount(0, $repositories, "repositories should contains 0 element");
    }

    public function testShouldHaveSuccessStoreRequests()
    {
        $this->config();
        $response = $this->post("{$this->url_base}", $this->repository, $this->headers);
        $response->assertStatus(201);

        $response = $this->get("{$this->url_base}", $this->headers);
        $repositories = json_decode($response->getContent());
        $this->assertCount(1, $repositories, "repositories should contains 1 element");
    }

    public function testShouldHaveSuccessShowRequests()
    {
        $this->config();
        $response = $this->post("{$this->url_base}", $this->repository, $this->headers);
        $response->assertStatus(201);

        $response = $this->get("{$this->url_base}/1", $this->headers);
        $response->assertStatus(200);

        $repository = json_decode($response->getContent());
        $this->assertTrue($repository->id === 1, 'Repository is valid');
    }

    public function testShouldHaveSuccessUpdateRequests()
    {
        $this->config();
        $response = $this->post("{$this->url_base}", $this->repository, $this->headers);
        $response->assertStatus(201);

        $response = $this->get("{$this->url_base}/1", $this->headers);
        $response->assertStatus(200);
        $repository = json_decode($response->getContent());
        $this->assertTrue($repository->description === $this->repository['description'], 'Repository is valid');

        $new_repository = $this->repository;
        $new_repository['description'] = "{$this->repository['description']} II";
        $response = $this->put("{$this->url_base}/1", $new_repository, $this->headers);
        $response->assertStatus(200);

        $response = $this->get("{$this->url_base}/1", $this->headers);
        $response->assertStatus(200);
        $repository = json_decode($response->getContent());
        $this->assertTrue($repository->description === "{$this->repository['description']} II", 'Repository is valid');
    }

    public function testShouldHaveSuccessDeleteRequests()
    {
        $this->config();
        $response = $this->post("{$this->url_base}", $this->repository, $this->headers);
        $response->assertStatus(201);

        $response = $this->get("{$this->url_base}/1", $this->headers);
        $response->assertStatus(200);
        $repository = json_decode($response->getContent());
        $this->assertTrue($repository->id === 1, 'Repository is valid');

        $response = $this->delete("{$this->url_base}/1", [], $this->headers);
        $response->assertStatus(204);
        $repository = json_decode($response->getContent());
        $this->assertTrue($repository === null, 'Repository is valid');
    }
}
