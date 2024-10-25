<?php

namespace App\Repositories;

use App\Models\Flavor;

interface FlavorRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update(Flavor $flavor, array $data);
    public function delete(Flavor $flavor);
}