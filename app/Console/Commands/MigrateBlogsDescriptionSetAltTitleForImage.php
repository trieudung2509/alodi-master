<?php

namespace App\Console\Commands;

use App\Blog;
use App\Upload;
use Illuminate\Console\Command;
use KubAT\PhpSimple\HtmlDomParser;
use PHPUnit\Util\Exception;

class MigrateBlogsDescriptionSetAltTitleForImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:BlogsDescriptionSetAltTitleForImage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set alt title for image in blogs description';

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
        foreach ($blogs as $blog) {
            try {
                $html = HtmlDomParser::str_get_html($blog->description);
                if ($html == false) {
                    $this->info("Blog id: " . $blog->id . " Do nothing");
                    continue;
                }

                $all_images = $html->find('img');
                foreach ($all_images as $image) {
                    $app_url = url('public', [], true) . '/';
                    $explodedFileName = explode($app_url, $image->getAttribute('src'));
                    if (sizeof($explodedFileName) > 1) {
                        $fileName = $explodedFileName[1];
                        $upload = Upload::where('file_name', '=', $fileName)->first();
                        if ($upload != null && $upload->file_original_name != null) {
                            $image->setAttribute('alt', $upload->file_original_name);
                        }
                    }
                }
                $blog->description = (string)$html;
                $blog->save();
                $this->info("Blog id: ".$blog->id." Success");
            } catch (\Exception $exception) {
                $this->error("Blog id: ".$blog->id.", Message: ".$exception->getMessage());
            }
        }

        $this->comment('End migration');
    }
}
