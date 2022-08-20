<?php

namespace App\Jobs;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CourseUpdater implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const QUEUE = 'courses-updater';

    /**
     * @var Course
     */
    protected $course;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
        self::onQueue(self::QUEUE);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // TODO: Update the course in the way you want!
        $this->course->updated_at = now();
        $this->course->save();
    }
}
