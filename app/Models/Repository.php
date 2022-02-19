<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repository extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['github_id', 'name', 'description', 'url', 'avatar_url', 'stargazers_count', 'language'];

    public function repositoryExistentByGitHubId(int $git_hub_id)
    {
        return $this->whereGithubId($git_hub_id)->first() || false;
    }
}
