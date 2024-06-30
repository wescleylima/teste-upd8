<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

/**
 * @property string baseUri
 */
class LocalidadesService {

    public function __construct()
    {
        $this->baseUri = config('upd8.LOCALIDADES_API_URL');
    }

    /**
     * @return mixed
     */
    public function getUfs(): array
    {
        try {

            $response = Http::asJson()->get($this->baseUri . '/estados');

            if ($response->successful()) {
                return  ['success' => true, 'data' => $response->object(), 'message' => 'Executado com sucesso.'];
            } else {
                $statusCode = $response->status();
                $errorMessage = $response->body();
                throw new Exception("Erro ao obter os estados. Status: $statusCode. Mensagem: $errorMessage");
            }

        } catch(Exception $e) {

            return ['success' => false, 'data' => [], 'message' => $e->getMessage()];
        }

    }

    /**
     * @return mixed
     */
    public function getCidades($uf): array
    {
        try {

            $response = Http::asJson()->get($this->baseUri . '/estados/' . $uf . '/distritos');

            if ($response->successful()) {
                return  ['success' => true, 'data' => $response->object(), 'message' => 'Executado com sucesso.'];
            } else {
                $statusCode = $response->status();
                $errorMessage = $response->body();
                throw new Exception("Erro ao obter as cidades. Status: $statusCode. Mensagem: $errorMessage");
            }

        } catch(Exception $e) {

            return ['success' => false, 'data' => [], 'message' => $e->getMessage()];
        }

    }
}
