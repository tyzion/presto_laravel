<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $path, $filename, $w, $h;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filePath, $w,$h)
    {
        $this->path = dirname($filePath);
        $this->filename = basename($filePath);
        $this->w = $w;
        $this->h = $h;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $w = $this->w;
        $h = $this->h;
        $srcPath = storage_path() . '/app/' . $this->path . '/' . $this->filename;
        $destPath = storage_path() . '/app/' . $this->path . "/crop{$w}x{$h}_" . $this->filename;

        Image::load($srcPath)
                ->crop(Manipulations::CROP_CENTER, $w, $h)
                ->save($destPath);
    }
}
