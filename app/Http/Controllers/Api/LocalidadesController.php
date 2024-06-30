<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LocalidadesService;

class LocalidadesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/localidades/estados",
     *     tags={"Localidades"},
     *     summary="Recupera lista de ufs",
     *     description="Retorna a lista de ufs da api do IBGE",
     *     @OA\Response(response="200", description="Retorna objeto json com a lista das ufs"),
     * )
     */
    public function getUfs(LocalidadesService $service)
    {
        return response()->json($service->getUfs());
    }

    /**
     * @OA\Get(
     *     path="/api/localidades/{uf}/cidades",
     *     tags={"Localidades"},
     *     summary="Recupera lista de cidades por uf",
     *     description="Retorna a lista de cidades por uf da api do IBGE",
     *     @OA\Response(response="200", description="Retorna objeto json com a lista das cidades"),
     *     @OA\Parameter(
     *          name="uf",
     *          in="path",
     *          required=true,
     *          description="Sigla da UF (Unidade Federativa)",
     *          @OA\Schema(type="string")
     *      ),
     * )
     */
    public function getCidades($uf, LocalidadesService $service)
    {
        return response()->json($service->getCidades($uf));
    }

}
