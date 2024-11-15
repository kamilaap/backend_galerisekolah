<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MigrateSliderImages extends Command
{
    protected $signature = 'sliders:migrate-images';
    protected $description = 'Migrate slider images from storage to public assets';

    public function handle()
    {
        $sliders = Slider::all();

        foreach ($sliders as $slider) {
            $oldPath = storage_path('app/public/' . $slider->image);
            if (File::exists($oldPath)) {
                $fileName = basename($slider->image);
                $newPath = public_path('assets/images/slider/' . $fileName);

                // Pindahkan file
                File::copy($oldPath, $newPath);

                // Update database
                $slider->update([
                    'image' => 'assets/images/slider/' . $fileName
                ]);

                $this->info("Migrated: {$fileName}");
            }
        }

        $this->info('Migration completed!');
    }
} 
