<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BannerSeeder extends Seeder
{
    public function run()
    {
        $bannerDirectory = public_path('storage/banner');

        if (File::isDirectory($bannerDirectory)) {
            $bannerFiles = File::files($bannerDirectory);

            foreach ($bannerFiles as $file) {
                $filename = $file->getFilename();
                if (in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif'])) {
                    $name = Str::slug(pathinfo($filename, PATHINFO_FILENAME), ' ');
                    Banner::create([
                        'name' => $name,
                        'slug' => Str::slug($name),
                        'image' => 'banner/' . $filename, // Path relatif dari public
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}