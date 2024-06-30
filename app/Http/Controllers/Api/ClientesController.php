<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ClientesRepository;
use App\Http\Requests\ClientesRequest;
use Exception;
use Illuminate\Validation\ValidationException;

class ClientesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/clientes",
     *     tags={"Clientes"},
     *     summary="Recupera lista de clientes",
     *     description="Retorna a lista de clientes do banco de dados",
     *     @OA\Response(response="200", description="Retorna objeto json com a lista dos clientes"),
     * )
     */
    public function index(Request $request, ClientesRepository $repository)
    {
        return response()->json($repository->search($request));
    }

    /**
     * @OA\Post(
     *     path="/api/clientes",
     *     tags={"Clientes"},
     *     summary="Cria novo clientes",
     *     description="Insere novo clientes no banco de dados",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="_token", type="string", example="6Y8aygQUlj5IFQwiUoTQPFt8Q4DfT9WUhHCoPrnM"),
     *             @OA\Property(property="cpf", type="integer", example=99999999999),
     *             @OA\Property(property="nome", type="string", example="Fulano de Tal"),
     *             @OA\Property(property="data_nascimento", type="date", example="2000-01-01"),
     *             @OA\Property(property="sexo", type="string", example="M"),
     *             @OA\Property(property="endereco", type="string", example="Rua das Araucárias, SN"),
     *             @OA\Property(property="estado", type="string", example="DF"),
     *             @OA\Property(property="cidade", type="string", example="Brasília"),
     *         )
     *     ),
     *     @OA\Response(response="200", description="Retorna o id do clientes inserido no banco de dados"),
     * )
     */
    public function store(Request $request, ClientesRepository $repository)
    {
        try {
            $clienteRequest = new ClientesRequest();
            $request->validate($clienteRequest->rules(), $clienteRequest->messages());

            return response()->json($repository->store($request));
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage(), 'data' => $request->all()]);
        }

    }

    /**
     * @OA\Put(
     *     path="/api/clientes/{cliente}",
     *     tags={"Clientes"},
     *     summary="Edita clientes",
     *     description="Altera clientes no banco de dados",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="_token", type="string", example="6Y8aygQUlj5IFQwiUoTQPFt8Q4DfT9WUhHCoPrnM"),
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="cpf", type="integer", example=99999999999),
     *             @OA\Property(property="nome", type="string", example="Fulano de Tal"),
     *             @OA\Property(property="data_nascimento", type="date", example="2000-01-01"),
     *             @OA\Property(property="sexo", type="string", example="M"),
     *             @OA\Property(property="endereco", type="string", example="Rua das Araucárias, SN"),
     *             @OA\Property(property="estado", type="string", example="DF"),
     *             @OA\Property(property="cidade", type="string", example="Brasília"),
     *         )
     *     ),
     *     @OA\Response(response="200", description="Retorna objeto json do clientes após alteração no banco de dados"),
     *     @OA\Parameter(
     *         name="cliente",
     *         in="path",
     *         required=true,
     *         description="Código do cliente",
     *         @OA\Schema(type="string")
     *     ),
     * )
     */
    public function update($id, Request $request, ClientesRepository $repository)
    {
        try {
            $clienteRequest = new ClientesRequest();
            $request->validate($clienteRequest->rules(), $clienteRequest->messages());

            return response()->json($repository->update($id, $request));
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage(), 'data' => $request->all()]);
        }


    }

    /**
     * @OA\Delete(
     *     path="/api/clientes/{cliente}",
     *     tags={"Clientes"},
     *     summary="Deleta clientes",
     *     description="Remove clientes do banco de dados",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="_token", type="string", example="6Y8aygQUlj5IFQwiUoTQPFt8Q4DfT9WUhHCoPrnM")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Retorna mensagem de exclusão do clientes"),
     *     @OA\Parameter(
     *          name="cliente",
     *          in="path",
     *          required=true,
     *          description="Código do cliente",
     *          @OA\Schema(type="string")
     *      ),
     * )
     */
    public function destroy($id, ClientesRepository $repository)
    {
        return response()->json($repository->delete($id));
    }
}
