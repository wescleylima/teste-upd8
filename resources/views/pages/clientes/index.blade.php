@extends('layouts.app')

@section('content')
    <div class="card">

        <div class="card-body">

            @if(isset($cliente))
                @include('pages.clientes.forms.edit')
            @else
                @include('pages.clientes.forms.create')
            @endif

        </div>
    </div>

@endsection

