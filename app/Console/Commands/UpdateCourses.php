<?php

namespace App\Console\Commands;

use App\Jobs\CourseUpdater;
use App\Models\Course;
use Illuminate\Console\Command;

class UpdateCourses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'courses:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the courses';

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
     */
    public function handle()
    {
        $courses = Course::query()->cursor();

        foreach ($courses as $course) {
            /** @var Course $course */
            $this->info(sprintf('Updating course #%d', $course->id));
            CourseUpdater::dispatch($course);
        }
    }
}
