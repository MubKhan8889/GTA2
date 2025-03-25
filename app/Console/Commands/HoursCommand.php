<?php

namespace App\Console\Commands;

use App\Models\Hours;
use DateInterval;
use DateTime;
use Illuminate\Console\Command;

class HoursCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hours:create {apprentice_id} {amount?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create hours records. Arguments: apprentice_id, amount (Optional)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $countResolve = $this->argument('amount') ?? 1;

        for ($x = 0; $x <= $countResolve; $x++)
        {
            $dt = new DateTime();
            $dtUpdate = $dt->add(new DateInterval('P' . $x . 'M'))->format('Y-m-d');

            $hours = Hours::create([
                'apprentice_id' => $this->argument('apprentice_id'),
                'month' => $x + 1,
                'date' => $dtUpdate,
                'training_centre' => (rand(0, 1) == 1) ? rand(0, 300) / 10 : null,
                'employer_training' => (rand(0, 1) == 1) ? rand(0, 300) / 10 : null,
                'specialist_training' => (rand(0, 1) == 1) ? rand(0, 300) / 10 : null,
                'vle_training' => (rand(0, 1) == 1) ? rand(0, 300) / 10 : null,
            ]);
        }

        $this->info('Hours created and assigned');
    }
}
