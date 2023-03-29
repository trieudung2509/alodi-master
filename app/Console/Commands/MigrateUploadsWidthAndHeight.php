<?php

namespace App\Console\Commands;

use App\Upload;
use Exception;
use Illuminate\Console\Command;
use Image;

class MigrateUploadsWidthAndHeight extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:UploadsWidthAndHeight';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert width and height of image for uploads';

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

        $uploads = Upload::where('type', '=', 'image')
            ->where('width', '=', null)
            ->orWhere('height', '=', null)
            ->get();
        $uploadsCount = $uploads->count();

        $this->output->progressStart($uploadsCount);

        foreach ($uploads as $upload) {
            try {
                $path = $upload->file_name;
                $img_url = base_path('public/') . $path;
                $img = Image::make($img_url)->encode();
                $height = $img->height();
                $width = $img->width();

                $upload->width = $width;
                $upload->height = $height;
                $upload->save();

            } catch (Exception $e) {
                $this->error($e->getMessage());
            }
            $this->output->progressAdvance();
        }

        $this->output->progressFinish();

        $this->comment('End migration');
    }
}
