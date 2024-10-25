<?php

namespace App\Http\Controllers;

use App\Http\Enums\TamanhoEnum;
use App\Models\Flavor;
use App\Http\Requests\{
    FlavorCreatRequest
};
use App\Repositories\FlavorRepositoryInterface;
use App\Repositories\FlavorRepository;
use Illuminate\Http\Request;

/**
 * Class FlavorController
 *
 * @package App\Http\Controllers
 * @author Vinícius Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 2024-10-01 15:52:04
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
class FlavorController extends Controller
{
    private FlavorRepositoryInterface $flavorRepository;

    public function __construct(FlavorRepositoryInterface $flavorRepository)
    {
        $this->flavorRepository = $flavorRepository;
    }

    public function index(): JsonResponse
    {
        // Listando todos os sabores que vão fazer sua boca salivar
        $flavors = $this->flavorRepository->all();

        return response()->json([
            'status' => 200,
            'message' => 'Sabores encontrados! Prepare-se para a festa dos paladares!',
            'sabores' => $flavors,
        ]);
    }

    public function store(FlavorCreatRequest $request): JsonResponse
    {
        // Adicionando um novo sabor ao cardápio
        $flavor = $this->flavorRepository->create($request->validated());

        return response()->json([
            'status' => 201,
            'message' => 'Sabor cadastrado com sucesso! Prepare-se para o sucesso!',
            'sabor' => $flavor,
        ]);
    }

    public function show(string $id): JsonResponse
    {
        // Procurando um sabor especial como quem procura o tesouro perdido
        $flavor = $this->flavorRepository->find($id);

        if (!$flavor) {
            return response()->json([
                'status' => 404,
                'message' => 'Sabor não encontrado! Ele fugiu para o outro lado da rua.',
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Sabor encontrado! Ele estava escondido em um lugar gostoso!',
            'sabor' => $flavor,
        ]);
    }

    public function update(FlavorCreatRequest $request, string $id): JsonResponse
    {
        // Atualizando o sabor como se estivesse dando uma nova cara para o prato
        $flavor = $this->flavorRepository->find($id);

        if (!$flavor) {
            return response()->json([
                'status' => 404,
                'message' => 'Sabor não encontrado! Parece que ele foi para uma viagem!',
            ]);
        }

        $this->flavorRepository->update($flavor, $request->validated());

        return response()->json([
            'status' => 200,
            'message' => 'Sabor atualizado! Agora está mais gostoso que antes!',
            'sabor' => $flavor,
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        // Removendo o sabor como quem joga fora um sorvete derretido
        $flavor = $this->flavorRepository->find($id);

        if (!$flavor) {
            return response()->json([
                'status' => 404,
                'message' => 'Sabor não encontrado! Ele deve ter ido ao shopping!',
            ]);
        }

        $this->flavorRepository->delete($flavor);

        return response()->json([
            'status' => 200,
            'message' => 'Sabor deletado! Esperamos que tenha sido uma boa experiência!',
        ]);
    }
}