<?php

namespace App\Console\Commands;

use App\Services\ParentService;
use Illuminate\Console\Command;

class ProcessParentViewData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-parent-view-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $parentService;

    public function __construct(ParentService $parentService)
    {
        parent::__construct();
        $this->parentService = $parentService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->parentService->insertParentData();
    }
}
