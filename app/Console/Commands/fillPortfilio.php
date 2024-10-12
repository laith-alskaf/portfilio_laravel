<?php

namespace App\Console\Commands;

use App\Models\Certificate;
use App\Models\Contact;
use App\Models\education;
use App\Models\PersonalInfo;
use App\Models\Project;
use App\Models\skill;
use Illuminate\Console\Command;
use Illuminate\Mail\Mailables\Content;

class fillPortfilio extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:factory'; 

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        education::factory()->count(2)->create();
        Project::factory()->count(5)->create();
        PersonalInfo::factory()->count(1)->create();
        skill::factory()->count(10)->create();
        Certificate::factory()->count(4)->create();
        Contact::factory()->count(1)->create();
        //
    }
}
