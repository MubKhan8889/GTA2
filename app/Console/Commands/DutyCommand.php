<?php

namespace App\Console\Commands;

use App\Models\ApprenticeDuty;
use App\Models\Apprenticeship;
use App\Models\Duty;
use Carbon\Carbon;
use Date;
use DateInterval;
use DateTime;
use Illuminate\Console\Command;

class DutyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'duty:create {apprenticeship_id} {apprentice_id} {amount?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create duties. Arguments: apprenticeship_id, apprentice_id, amount (Optional)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $countResolve = $this->argument('amount') ?? 1;
        $dt = new DateTime();
        $deadline = $dt->add(new DateInterval('P1Y'))->format('Y-m-d');
        
        for ($x = 0; $x <= $countResolve; $x++)
        {
            $duty = Duty::create([
                'apprenticeship_id' => $this->argument('apprenticeship_id'),
                'name' => fake()->text(25),
                'duration' => fake()->numberBetween(4, 8),
            ]);

            $apprenticeDuty = ApprenticeDuty::create([
                'apprentice_id' => $this->argument('apprentice_id'),
                'duty_id' => $duty->duty_id,
                'completed_date' => null,
                'due_date' => $deadline,
            ]);
        }

        $this->info('Duties created and assigned');
    }
}
