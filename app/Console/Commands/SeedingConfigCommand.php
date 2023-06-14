<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedingConfigCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->call('migrate:refresh');

        // $this->call('migrate',['--path' => 'database/migrations/2023_05_27_121413_expeditors.php']);

        // $this->call('migrate');

        $this->call('db:seed',['--class' => 'OperationSeeder']);

        $this->call('db:seed',['--class' => 'ResourcesSeeder']);

        $this->call('db:seed',['--class' => 'PermissionSeeder']);

        $this->call('db:seed',['--class' => 'RoleSeeder']);

        $this->call('db:seed',['--class' => 'UserSeeder']);

        return Command::SUCCESS;

    }
}
