<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Absensi;
use App\User;
use App\Libur;

class JamKerja extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'absen:input-jam';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Input Hari Kerja dari setup hari kerja ke absensi';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = DB::insert("insert INTO absensi (periode_year, periode_month,users_id,tanggal,jam_masuk,jam_pulang,ket_absen_id,poin)
                            SELECT YEAR(CURDATE()) AS YEAR, month(CURDATE()) AS YEAR,
                                    users.id AS peg, 
                                    libur.tanggal, libur.chekin, libur.chekot,
                                    5 AS ket,10 AS poin
                            FROM users  
                            JOIN libur
                            WHERE libur.tanggal = CURDATE()
                            AND users.aktif = 'Y' AND STATUS = 'PPNPN' AND users.id != 1
                        ");
       
    }
}
