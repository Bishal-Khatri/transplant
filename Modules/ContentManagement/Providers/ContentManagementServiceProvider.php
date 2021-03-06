<?php

namespace Modules\ContentManagement\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\ContentManagement\Entities\Menu;
use Modules\ContentManagement\Entities\MenuPage;
use Modules\ContentManagement\Entities\Theme;

class ContentManagementServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'ContentManagement';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'contentmanagement';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

        view()->composer('*', function ($view) {
            $first_theme = Theme::first();
            if(!$first_theme){
                $active_theme = new Theme();
                $active_theme->name = 'Default';
                $active_theme->is_active = 1;
                $active_theme->save();
            }
            $active_theme = Theme::where('is_active', 1)->first();
            if (!$active_theme OR blank($active_theme)){
                // dd($active_theme);
                return abort(404, 'Theme not activated');
            }
            $nav_menu_id = $active_theme->nav_menu_id;
            $nav_menu = MenuPage::where('menu_id',$nav_menu_id)->where('parent_id', 0)->with('children', 'children.children')->orderBy('order')->get();

//            $nav_menu->map(function($item) {
//                switch ($item->type){
//                    case 'url':
//                        $link = $item->url;
//                        break;
//                    case 'page':
//                        $link = $item->getPageLink();
//                        break;
//                    case 'category':
//                        $link = $item->getCategoryLink();
//                        break;
//                    default:
//                        $link = '/link-broken';
//                }
//
//                return collect([
//                    'id' => $item->id,
//                    'display_name' => $item->display_name,
//                    'order' => $item->order,
//                    'parent_id' => $item->parent_id,
//                    'alt_text' => $item->alt_text,
//                    'target' => $item->target,
//                    'custom_css' => $item->custom_css,
//                    'children' => $item->children,
//                    'link' => $link,
//                ]);
//            });

//            dd($nav_menu);

            $view->with(compact('active_theme', 'nav_menu'));
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
