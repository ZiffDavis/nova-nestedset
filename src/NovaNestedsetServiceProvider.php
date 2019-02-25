<?php

namespace ZiffDavis\Nova\Nestedset;

use App\Category;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class NovaNestedsetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-nestedset', __DIR__.'/../dist/js/field.js');
            Nova::style('nova-nestedset', __DIR__.'/../dist/css/field.css');
        });

        Route::get('/nova-vendor/nestedset/{resource}/{field}', function (NovaRequest $request) {
            $model = $request->model();

            /** @var \Illuminate\Database\Eloquent\Relations\BelongsTo $relationship */
            $relationship = $model->{$request->route('field')}();

            $options = $relationship->getRelated()
                ->with('ancestors')
                ->withDepth()
                ->get()
                ->toFlatTree()
                ->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'depth' => ($category->depth + 1),
                    ];
                });
            return $options;
        })->middleware('nova');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
