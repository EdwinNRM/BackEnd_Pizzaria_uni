<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 * @author Vinícius Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 2024-08-23 21:48:54
 * @copyright UniEVANGÉLICA
 * Melhorado por The_Coding_Cat
 *     /\_____/\
 *    /  o   o  \
 *   ( ==  ^  == )
 *    )         (
 *   (           )
 *  ( (  )   (  ) )
*  (__(__)___(__)__)
 */
class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): JsonResponse
    {
        // Retornando todos os usuários cadastrados
        $users = $this->userRepository->all();

        return response()->json([
            'status' => 200,
            'message' => 'Aqui estão os usuários!',
            'users' => $users,
        ]);
    }

    public function me(): JsonResponse
    {
        // Retornando o usuário logado
        $user = Auth::user();

        return response()->json([
            'status' => 200,
            'message' => 'Você está logado!',
            'user' => $user,
        ]);
    }

    public function store(UserCreateRequest $request): JsonResponse
    {
        // Criando um novo usuário
        $user = $this->userRepository->create($request->validated());

        return response()->json([
            'status' => 201,
            'message' => 'Novo usuário criado com sucesso!',
            'user' => $user,
        ]);
    }

    public function show(string $id): JsonResponse
    {
        // Mostrando informações de um usuário específico
        $user = $this->userRepository->find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Ops! Usuário não encontrado.',
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Encontramos o usuário!',
            'user' => $user,
        ]);
    }

    public function update(UserUpdateRequest $request, string $id): JsonResponse
    {
        // Atualizando as informações do usuário
        $user = $this->userRepository->find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Não conseguimos encontrar o usuário!',
            ]);
        }

        $this->userRepository->update($user, $request->validated());

        return response()->json([
            'status' => 200,
            'message' => 'Informações do usuário atualizadas com sucesso!',
            'user' => $user,
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        // Removendo o usuário
        $user = $this->userRepository->find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Usuário não encontrado para deletar.',
            ]);
        }

        $this->userRepository->delete($user);

        return response()->json([
            'status' => 200,
            'message' => 'Usuário removido com sucesso!',
        ]);
    }
}