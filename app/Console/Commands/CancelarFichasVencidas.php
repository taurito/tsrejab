<?php

//namespace App\Console\Commands;

//use Illuminate\Console\Command;
//use Illuminate\Support\Facades\DB;

//class CancelarFichasVencidas extends Command
//{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
   // protected $signature = 'fichas:cancelar-vencidas';

    /**
     * The console command description.
     *
     * @var string
     */
 //   protected $description = 'Cancela las fichas que están en estado Pendiente y cuya fecha de reserva ya venció';

    /**
     * Execute the console command.
     */
//    public function handle()
//   {
//        $canceladoId = DB::table('estados')->where('nombre', 'Cancelado')->value('id');
//        $pendienteId = DB::table('estados')->where('nombre', 'Pendiente')->value('id');
//
//        $affected = DB::table('fichas')
//            ->where('estado_id', $pendienteId)
//            ->where('fecha_reserva', '<', now()->toDateString())
//            ->update([
//                'estado_id' => $canceladoId,
//                'updated_at' => now()
//           ]);
//
//        $this->info("Fichas actualizadas: {$affected}");
//    }
//}
