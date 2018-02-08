<?php
namespace langs\langssystem;

use langs\langssystem\Models\Lang;
use DB;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class LangsSystemServiceProvider extends ServiceProvider
{

    public function boot(Dispatcher $events)
    {

        $this->loadViewsFrom(__DIR__ . '/views', 'langs');

        $this->publishes([
            __DIR__ . '/assets' => resource_path('lang'),
        ], 'langs-assets');

        $this->publishes([
            __DIR__ . '/views' => resource_path('views/vendor/langs'),
        ], 'langs-views');
        
        $this->publishes([
            __DIR__ . '/migrations' => database_path('migrations'),
        ], 'langs-migrations');
        
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        if ((DB::connection()->getDatabaseName()) && Schema::hasTable('langs')) {

                $langsIds = lang::getLangsIds();
                $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
                    $event->menu->add([
                        'text'        => 'Languajes',
                        'url'         => route('admin.languages.index'),
                        'icon'        => 'file',
                        'label_color' => 'success',
                    ]);

                });

                $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

                    $items = Lang::all()->map(function (Lang $lang) {
                        return [
                            'text' => 'langss-' . $lang['name'],
                            'url'  => route('admin.langs', $lang['iso_code']),
                        ];
                    });

                    $event->menu->add(...$items);

                });

            if (Schema::hasTable('langs')) {
                $langscount = Lang::getLangsCountdos();
                $langsIds   = lang::getLangsIds();

            } else {
                $langscount = null;
                $langsIds   = null;
            }
                        // Set to 'global' app variables
            app()->global = [
                'langscount'       => $langscount,
                'langsIds'         => $langsIds,

            ];

            // Also share $categories, langcount and Ids to all views
            view()->share(compact('langscount', 'langsIds'));


        }
    }

    public function register()
    {

        $this->app->make('langs\langssystem\LangsController');
        $this->app->make('langs\langssystem\LanguagesController');


    }
}
