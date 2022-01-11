<?php

namespace App\Console\Commands;

use App\Models\ApiAuth;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiKeyGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-key:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a key for use the API';

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
     * @return int
     */
    public function handle()
    {
        $this->info('------------- GENERATING API-KEY ---------------');

        $apiKey = new ApiAuth();
        $apiKey->key = Hash::make('pharmainc_api_key');
        $apiKey->save();

        $this->info("API-KEY = {$apiKey->key}");
    }
}
