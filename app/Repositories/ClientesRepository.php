<?php

namespace App\Repositories;

use App\Models\Clientes;
use Illuminate\Http\Request;
use Exception;

/**
 * @property Clientes $clientes
 */
class ClientesRepository
{

    public function __construct(Clientes $clientes)
    {
        $this->clientes = $clientes;
    }

    public function search(Request $request): mixed
    {
        try {
            $clientes = $this->clientes->when($request->input('estado') ?? null, function ($query, $value) {
                return $query->where('estado', $value);
            });

            $clientes->when($request->input('nome') ?? null, function ($query, $value) {
                return $query->where('nome', 'like', "%$value%");
            });

            $clientes->when($request->input('sexo') ?? null, function ($query, $value) {
                return $query->where('sexo', $value);
            });

            $clientes->when($request->input('cidade') ?? null, function ($query, $value) {
                return $query->where('cidade', $value);
            });

            $clientes->when($request->input('cpf') ?? null, function ($query, $value) {
                $value = preg_replace("/[^0-9]/", "", $value);
                return $query->where('cpf', $value);
            });

            $clientes->when($request->input('data_nascimento') ?? null, function ($query, $value) {
                return $query->where('data_nascimento', $value);
            });

            $perPage = 10;
            $columns = ['*'];
            $page = 'page';
            $pageCurrent = $request->input('page') ?? 1;

            return $clientes->paginate($perPage, $columns, $page, $pageCurrent);
        } catch (Exception $e) {
            return ['success' => false, 'msg' => $e->getMessage()];
        }
    }

    public function find($id): array
    {
        try {
            $result = $this->clientes->findOrFail($id);
            return ['success' => true, 'msg' => $result];
        } catch (Exception $e) {
            return ['success' => false, 'msg' => $e->getMessage()];
        }
    }

    public function delete($id): array
    {
        try {
            $result = $this->clientes->findOrFail($id);
            $result->delete();
            return ['success' => true, 'msg' => 'Cliente excluído com sucesso!'];
        } catch (Exception $e) {
            return ['success' => false, 'msg' => $e->getMessage()];
        }
    }

    public function store(Request $request): array
    {
        try {
            $request->merge(['cpf' => preg_replace("/[^0-9]/", "", $request->input('cpf'))]);
            $result = $this->clientes->where('cpf', $request->input('cpf'))->first();

            if ($result) {
                throw new Exception("O cpf informado já existe!");
            }

            $this->clientes->fill($request->except('_token'));
            $this->clientes->save();
            return ['success' => true, 'msg' => 'Cliente incluído com sucesso!'];
        } catch (Exception $e) {
            return ['success' => false, 'msg' => $e->getMessage()];
        }
    }

    public function update($id, Request $request): array
    {
        try {
            $result = $this->clientes->find($id);
            if (!$result) {
                throw new Exception("Cliente não localizado!");
            }

            $result->fill($request->except(['cpf', '_token']));
            $result->save();
            return ['success' => true, 'msg' => 'Cliente alterado com sucesso!'];
        } catch (Exception $e) {
            return ['success' => false, 'msg' => $e->getMessage()];
        }
    }

}
