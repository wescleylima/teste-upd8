<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clientes;
use Exception;


class PagesController extends Controller
{
    public function editCliente($id, Clientes $clientes, Request $request)
    {
        try {
            $result = $clientes->findOrFail($id);
            return view('pages.clientes.index', ['cliente' => $result]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function listCliente()
    {
        return view('pages.clientes.list');
    }

    public function createCliente()
    {
        return view('pages.clientes.index');
    }

}
