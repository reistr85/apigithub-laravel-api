<?php

namespace App\Services\Repositories;

use App\Models\Repository;
use Throwable;

class UpdateByIdRepositoryService
{
    /**
     * @param int $id
     * @param array $data
     * @return array
     * @throws Throwable
     */
    public function execute(int $id, array $data): array
    {
        $repository = Repository::find($id);
        throw_unless($repository, new \Exception('Registro não localizado', 422));

        $repository->update($data);
        return Repository::find($id)->toArray();
    }
}
