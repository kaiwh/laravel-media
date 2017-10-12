<?php

namespace Kaiwh\Media\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MediaInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Media install!';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filesystem = new Filesystem;
        $filesystem->copyDirectory(
            __DIR__ . '/stubs/install/directories',
            base_path()
        );
        foreach ($filesystem->allFiles(__DIR__ . '/stubs/install/appends') as $file) {
            $filesystem->append(
                base_path($file->getRelativePathname()),
                $filesystem->get($file)
            );
        }
        $this->call('migrate', ['--path' => str_replace(base_path(), '', __DIR__) . '/../../migrations/']);
    }

}
