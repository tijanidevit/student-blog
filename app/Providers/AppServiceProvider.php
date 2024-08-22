<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\TopCategory;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Builder::macro('filterByStatus', function ($status) {
            if ($status) {
                return $this->where('status', $status);
            }
            return $this;
        });

        Builder::macro('filterBy', function ($column,$value) {
            if ($value) {
                return $this->where($column, $value);
            }
            return $this;
        });

        Builder::macro('search', function ($field, $data) {
            return $data ? $this->where($field, 'like', "%$data%") : $this;
        });

        Builder::macro('searchFullname', function ($data) {
            return $data ? $this->where(DB::raw("CONCAT(first_name, ' ', COALESCE(last_name, ''), ' ', COALESCE(middle_name, ''))"), 'LIKE', "%$data%") : $this;
        });

        Builder::macro('orSearch', function ($field, $data) {
            return $data ? $this->orWhere($field, 'like', "%$data%") : $this;
        });

        Builder::macro('orSearchFullname', function ($data) {
            return $data ? $this->orWhere(DB::raw("CONCAT(first_name, ' ', COALESCE(last_name, ''), ' ', COALESCE(middle_name, ''))"), 'LIKE', "%$data%") : $this;
        });

        Builder::macro('filterByDate', function ($dateFrom, $dateTo, $column='created_at') {
            if ($dateFrom && $dateTo) {
                return $this->whereBetween($column, [
                    Carbon::parse($dateFrom)->startOfDay(),
                    Carbon::parse($dateTo)->endOfDay()
                ]);
            }
            return $this;
        });

        View::composer('*', function ($view) {
            // Cache the categories for 60 minutes
            $categories = Cache::remember('navbar_categories', 60, function () {
                return TopCategory::with('category')->oldest('order')->get(); // Adjust the query as per your needs
            });

            // Share the cached categories with all views
            $view->with('navBarCategories', $categories);
        });
    }
}
