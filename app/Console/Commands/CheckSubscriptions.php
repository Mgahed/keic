<?php

namespace App\Console\Commands;

use App\Enums\RecordState;
use App\Models\MemberShip;
use Illuminate\Console\Command;

class CheckSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check subscriptions and update status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        MemberShip::where('end_date', '<', now())
            ->update([
                'record_state' => RecordState::INACTIVE->value,
            ]);
    }
}
