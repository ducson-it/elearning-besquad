<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\CategoryBlog;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Notification;
use App\Models\Permission;
use App\Models\Post;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\Slider;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\Order;
use App\Models\User;
use App\Models\UserVoucher;
use App\Models\Voucher;
use App\Models\Status;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->count(10)->create();
        Permission::factory()->count(10)->create();
        RolePermission::factory()->count(10)->create();
        Category::factory()->count(2)->create();
        User::factory()->count(10)->create();
        Voucher::factory()->count(10)->create();
        UserVoucher::factory()->count(10)->create();
        Course::factory()->count(10)->create();
        Module::factory()->count(10)->create();
        Lesson::factory()->count(10)->create();
        Slider::factory()->count(10)->create();
        CategoryBlog::factory()->count(10)->create();
        Blog::factory()->count(10)->create();
        Comment::factory()->count(10)->create();
        Tag::factory()->count(10)->create();
        Post::factory()->count(10)->create();
        Taggable::factory()->count(10)->create();
        Order::factory()->count(10)->create();
        Status::factory()->count(10)->create();
        // Notification::factory()->count(10)->create();
        $this->call([
            UsersSeeder::class
        ]);
    }
}
