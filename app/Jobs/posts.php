<?php

namespace App\Jobs;

use App\posts;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class posts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(posts $post)
    {
        $this->post=$post;
    }

    /**
     * Execute the job. by injection the post model
     *
     * @return posts
     */
    public function handle(posts $post)
    {    return $post::all();
         //
    }
}
