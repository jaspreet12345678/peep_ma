<?php

namespace App\Console\Commands;

use App\Services\ChildsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProcessChildViewData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-child-view-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $childService;

    public function __construct(ChildsService $childService)
    {
        parent::__construct();
        $this->childService = $childService;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->childService->insertChildData();
        // Log::info("Jaspreet");

    }
}
