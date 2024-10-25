<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        // Paginando a lista de usuários
        return User::select('id', 'name', 'email', 'created_at')->paginate(10);
    }

    public function find($id)
    {
        // Buscando um usuário específico
        return User::find($id);
    }

    public function create(array $data)
    {
        // Criando um novo usuário
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function update(User $user, array $data)
    {
        // Atualizando os dados do usuário
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']); // Criptografando a senha
        }

        return $user->update($data);
    }

    public function delete(User $user)
    {
        // Deletando um usuário
        return $user->delete();
    }
}