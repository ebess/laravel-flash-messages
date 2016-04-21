<?php

namespace Ebess\FlashMessages;

use Ebess\FlashMessages\Services\ErrorToFlashMessageTransformer;
use Ebess\FlashMessages\Services\FlashMessages;
use Illuminate\Support\ServiceProvider;

class FlashMessageServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    const PACKAGE_NAMESPACE = 'flash-messages';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // handle configs
        $configPath = __DIR__.'/resources/config/flash-messages.php';
        $this->mergeConfigFrom($configPath, static::PACKAGE_NAMESPACE);

        // handle views
        $viewPath = __DIR__ . '/resources/views';
        $this->loadViewsFrom($viewPath, static::PACKAGE_NAMESPACE);

        // publish
        $this->publishes([
            $viewPath => resource_path('views/vendor/' . static::PACKAGE_NAMESPACE),
            $configPath => config_path('flash-messages.php'),
        ]);

        // load logic
        require __DIR__ . '/helpers.php';
        $this->app->singleton(FlashMessages::class, function() {
            return new FlashMessages(
                config('flash-messages.session_key'),
                config('flash-messages.transform_errors') ? new ErrorToFlashMessageTransformer() : null
            );
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
