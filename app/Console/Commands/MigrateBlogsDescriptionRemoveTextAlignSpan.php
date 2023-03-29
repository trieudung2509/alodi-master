<?php

namespace App\Console\Commands;

use App\Blog;
use Illuminate\Console\Command;
use KubAT\PhpSimple\HtmlDomParser;

class MigrateBlogsDescriptionRemoveTextAlignSpan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:BlogsDescriptionRemoveTextAlignSpan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove text align span from blogs description';

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
        $this->comment('Start migration');

        $blogs = Blog::all();
        $blogCount = $blogs->count();

        $this->output->progressStart($blogCount);

        foreach ($blogs as $blog) {

                // Create a DOM object from a string

            $html = HtmlDomParser::str_get_html($blog->description);
            $all_span = $html->find('span[style="text-align: justify"]');

            foreach ($all_span as $span) {
//                $this->info($span->plaintext);
//
//                $all_attributes = $span->getAllAttributes();
//                foreach ($all_attributes as $attribute) {
//                    $this->info($attribute);
//                }

                $span->removeAttribute('style');
            }
            $blog->description = (string)$html;
            $blog->save();
//            $html->clear();
//            unset($html);
            $this->output->progressAdvance();
        }

        $this->output->progressFinish();

        $this->comment('End migration');
    }
}
