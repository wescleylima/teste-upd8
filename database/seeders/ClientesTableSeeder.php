<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clientes;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        for ($i = 0; $i < 50; $i++) {

            $arrAddress = explode("\n", $faker->address);
            $arrLocation = explode(" - ", $arrAddress[1]);
            $endereco = $arrAddress[0];
            $cidade = $arrLocation[0];
            $estado = $arrLocation[1];

            DB::table('clientes')->insert([
                'nome' => $faker->name,
                'cpf' => $faker->cpf(false),
                'data_nascimento' => $faker->dateTimeBetween('-40 year', '-20 year')->format('Y-m-d'),
                'sexo' => $faker->randomElement(['M', 'F']),
                'endereco' => $endereco,
                'estado' => $estado,
                'cidade' => $cidade,
            ]);
        }
    }
}
