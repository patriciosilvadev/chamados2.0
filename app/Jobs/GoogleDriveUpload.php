<?php

namespace App\Jobs;

use App\Chamado;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GoogleDriveUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $anexoNome;
    protected $directory = 'chamados_file';
    public $tries = 3;
    public $timeout = 600;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($anexoNome)
    {
        $this->anexoNome = $anexoNome;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $file = public_path("{$this->directory}\\") . $this->anexoNome; // Windows Server
        $file = public_path("{$this->directory}/") . $this->anexoNome; // Linux Server
        if (Storage::disk('google')->put($this->anexoNome, fopen($file, 'r+')))
            File::delete($file);
    }
}
