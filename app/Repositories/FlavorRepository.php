<?php

namespace App\Repositories;

use App\Models\Flavor;
use App\Http\Enums\TamanhoEnum;

class FlavorRepository implements FlavorRepositoryInterface
{
    public function all()
    {
        return Flavor::select('id', 'sabor', 'preco', 'tamanho')->paginate(10);
    }

    public function find($id)
    {
        return Flavor::find($id);
    }

    public function create(array $data)
    {
        return Flavor::create([
            'sabor' => $data['sabor'],
            'preco' => $data['preco'],
            'tamanho' => TamanhoEnum::from($data['tamanho']),
        ]);
    }

    public function update(Flavor $flavor, array $data)
    {
        return $flavor->update($data);
    }

    public function delete(Flavor $flavor)
    {
        return $flavor->delete();
    }
}