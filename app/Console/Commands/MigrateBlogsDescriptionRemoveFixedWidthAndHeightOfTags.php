<?php

namespace App\Console\Commands;

use App\Blog;
use Illuminate\Console\Command;
use KubAT\PhpSimple\HtmlDomParser;

class MigrateBlogsDescriptionRemoveFixedWidthAndHeightOfTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:BlogsDescriptionRemoveFixedWidthAndHeightOfTags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
//        $blogs = Blog::where('id', '=', 56)->get();
        $blogCount = $blogs->count();
        $this->output->progressStart($blogCount);

        foreach ($blogs as $blog) {
            $html = HtmlDomParser::str_get_html($blog->description);

            //width
            $pattern = '/(width+):\s*(.*?)\s*;/';
            $html = preg_replace($pattern, '', $html);

            //height
            $pattern = '/(height+):\s*(.*?)\s*;/';
            $html = preg_replace($pattern, '', $html);

            //background-color:transparent
            $pattern = '/(background-color+):\s*(transparent)\s*;/';
            $html = preg_replace($pattern, '', $html);

            //font-variant-numeric: normal
            $pattern = '/(font-variant-numeric+):\s*(normal)\s*;/';
            $html = preg_replace($pattern, '', $html);

            //font-variant-east-asian: normal
            $pattern = '/(font-variant-east-asian+):\s*(normal)\s*;/';
            $html = preg_replace($pattern, '', $html);

            //text-decoration-line: none
            $pattern = '/(text-decoration-line+):\s*(none)\s*;/';
            $html = preg_replace($pattern, '', $html);

            //vertical-align: baseline
            $pattern = '/(vertical-align+):\s*(baseline)\s*;/';
            $html = preg_replace($pattern, '', $html);

            //border: none
            $pattern = '/(border+):\s*(none)\s*;/';
            $html = preg_replace($pattern, '', $html);


            $blog->description = (string)$html;
            $blog->save();

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();

        $this->comment('End migration');
    }
}
