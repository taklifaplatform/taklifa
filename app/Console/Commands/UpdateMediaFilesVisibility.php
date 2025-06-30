<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UpdateMediaFilesVisibility extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-media-files-visibility';

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
        $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::all();
        $s3 = \Storage::disk('s3');

        $progressBar = $this->output->createProgressBar(count($media));
        $progressBar->start();

        foreach ($media as $item) {
            try {
                $s3->setVisibility($item->getPath(), 'public');
            } catch (\Exception $e) {
                \Log::error("Failed to update visibility for media ID {$item->id}: " . $e->getMessage());
            }
            try {
                $s3->setVisibility($item->getPath('preview'), 'public');
            } catch (\Exception $e) {
                \Log::error("Failed to update visibility for media ID {$item->id}: " . $e->getMessage());
            }
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();
        $this->info('Media files visibility update completed!');
    }
}
