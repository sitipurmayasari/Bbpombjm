<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Archives;

class ArsipHapus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arsip:delete-arsip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status arsip setelah x tahun';

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
        $data = Archives::leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                        ->whereRaw('curdate() > DATE_ADD(archives.date,INTERVAL mailclasification.actived YEAR)')
                        ->update(['status' => 'inaktif']);

        $datain = Archives::leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                        ->whereRaw('curdate() > DATE_ADD(archives.date,INTERVAL mailclasification.akhir YEAR)')
                        ->update(['status' => 'akanmusnah']);
    }
}
