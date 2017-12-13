<?php

namespace App\Console\Commands;

use App\posts;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Console\Command;

class DuePages extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DuePages:duepages';
    protected $duePages;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Due pages';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /*     * scheduled command that will check every minute for the dues pages.
     * Execute the console command.
     *
     * @return mixed$
     */

    public function handle(Client $client) {
        $duepages = \DB::table('pages')
                ->where('next_visit_time', '<', Carbon::now());
        foreach ($duepages->get() as $page) {
           // $crawler = $client->request('GET', 'http://www.symfony.com/blog/');
            $crawler = $client->request('GET', $page->link);
            //area
            $pageid = $page->id;
            $links = $crawler->selectLink($page->area)->link();
            /* Extract the links from the specified section that i set it harcoded */
            $crawler = $client->click($links);
            $post_data['post_title'] = ($links->getNode()->nodeValue);

            $c = $crawler->filter('a > img')->each(function ($node) {
//                print $node->text() . "\n";
//                var_dump($node->image()) . "\n";
            });

            /*save the crawler data to Post model*/
            $crawler->filter('div > p')->each(function ($nodes, $pageid) {
                foreach ($nodes as $node) {
                    $post_data['post_title'] = trim($node->nodeValue);
                    $post_data['post_body'] = trim($node->textContent);
                    $post = new posts();
                    $post->title = $node->nodeValue;
                    $post->image = 'image';
                    $post->page_id = $pageid;
                    $post->body = $node->textContent;
                    $post->saveOrfail();
                    //insert to post
                }
            });
            //Update the last_visit_time and the next_visit_time
            \DB::table('pages')
                    ->where('id', 4)
                    ->update(['last_visit_time' => Carbon::now()]);
            $this->info('table Updated Successfully!');
        }
    }

}
