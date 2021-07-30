<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        if (Schema::hasTable('categories') && Schema::hasTable('posts') && Schema::hasTable('users')) {
            // view框架传入所有category
            View::share([
                'categories' => Category::all(),
                'user_amount' => User::count(),
                'post_amount' => Post::where('is_top', 1)->count(),
            ]);
        }

        // 注册自定义的markdown解析函数
        Blade::directive('markdown', function ($expression) {
            return "<?php echo Illuminate\Mail\Markdown::parse($expression); ?>";
        });

    }
}
