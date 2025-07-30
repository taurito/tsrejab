<?php


namespace Database\Seeders;
use App\Models\Estado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EstadoSeeder extends Seeder
{
    public function run()
    {
        $estados = ['Pendiente', 'Atendido', 'Observado', 'Cancelado'];

        foreach ($estados as $estado) {
            DB::table('estados')->updateOrInsert(
                ['nombre' => $estado],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
            );
        }
    }
}
