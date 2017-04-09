<?php

namespace Lumify\Trackable;

use Illuminate\Support\ServiceProvider;

/**
 * @package Lumify\Trackable
 * @copyright (c) LumifyPH <http://lumify.ph>
 */
class TrackableServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfig();
    }

    public function boot()
    {
        $this->publishConfig();
        $this->publishMigrations();
        $this->publishViews();
    }

    private function mergeConfig()
    {
        $path = $this->getConfigPath();
        $this->mergeConfigFrom($path, 'trackable');
    }

    private function publishConfig()
    {
        $path = $this->getConfigPath();
        $this->publishes([$path => config_path('trackable.php')], 'config');
    }

    private function publishMigrations()
    {
        if (!class_exists('CreateTrackableTables')) {
            $timestamp = date('Y_m_d_His', time());
            $path = $this->getMigrationsPath();
            $publish = [
                $path . 'create_trackable_tables.php' =>
                database_path("/migrations/{$timestamp}_create_trackable_tables.php")
            ];
            $this->publishes($publish, 'migrations');
        }
    }

    public function publishViews()
    {
        $path = $this->getViewsPath();
        $this->loadViewsFrom($path, 'trackable');

        $this->publishes([
            $path => resource_path('views/vendor/trackable'),
        ]);
    }

    private function getConfigPath()
    {
        return __DIR__ . '/../config/trackable.php';
    }

    private function getMigrationsPath()
    {
        return __DIR__ . '/../database/migrations/';
    }

    private function getViewsPath()
    {
        return __DIR__ . '/../resources/views/';
    }

}