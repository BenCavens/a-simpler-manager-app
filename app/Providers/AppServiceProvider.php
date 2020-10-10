<?php

namespace App\Providers;

use App\Quote;
use App\Article;
use App\QuoteManager;
use App\ArticleManager;
use Illuminate\Support\ServiceProvider;
use Thinktomorrow\Chief\Modules\Presets\TextModule;
use Illuminate\Database\Eloquent\Relations\Relation;
use Thinktomorrow\Chief\Modules\Presets\PagetitleModule;
use Thinktomorrow\Chief\Managers\Register\RegisterManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
//            'text'      => TextModule::class,
//            'pagetitle' => PagetitleModule::class,

            'article' => Article::class,
            'quote' => Quote::class,
        ]);

        $this->app->make(RegisterManager::class)(ArticleManager::class);
        $this->app->make(RegisterManager::class)(QuoteManager::class);
    }
}
