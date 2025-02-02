<?php

namespace App\Jobs;

use App\Imports\CounterProductsImport;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Maatwebsite\Excel\Facades\Excel;

class ProcessCounterProducts implements ShouldQueue
{
    use Queueable, Batchable;

    private $name;
    private $file;

    /**
     * Create a new job instance.
     */
    public function __construct(string $name, $file)
    {
        $this->name = $name;
        $this->file = $file;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Excel::import(new CounterProductsImport($this->name), $this->file);
    }
}
