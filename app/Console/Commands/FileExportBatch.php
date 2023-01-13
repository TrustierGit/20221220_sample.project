<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FileExportBatch extends Command
{
   
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FileExportBatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'FileExport via FTPServer';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $batch_path = 'C:\Users\USER\Desktop\shell.sh';
        exec($batch_path);
        
    }
}
