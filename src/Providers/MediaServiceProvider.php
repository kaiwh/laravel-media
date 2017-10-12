<?php

namespace Kaiwh\Media\Providers;

class MediaServiceProvider extends \Illuminate\Support\ServiceProvider
{

    protected $commands = [
        'Kaiwh\Media\Commands\MediaInstallCommand',
    ];
    // public function boot()
    // {
    // }

    public function register()
    {
        $this->commands($this->commands);
    }
}
