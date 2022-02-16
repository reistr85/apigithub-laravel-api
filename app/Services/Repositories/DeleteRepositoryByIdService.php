<?php

namespace App\Services\Repositories;

use App\Models\Repository;
use Exception;
use Throwable;

class DeleteRepositoryByIdService
{
    /**
     * @param int $id
     * @return bool
     * @throws Throwable
     */
    public function execute(int $id): bool
    {
        $repository = Repository::find($id);
        throw_unless($repository, new Exception('Registro não localizado.', 422));

        return $repository->delete();
    }
}
