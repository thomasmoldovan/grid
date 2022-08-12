<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    public $user = null;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory(1)->create()[0];
    }

    public function test_guest_cannot_access_categories()
    {
        $response = $this->get('/admin/category/all');

        $response->assertRedirect('/login');
    }

    public function test_user_can_access_categories()
    {
        $this->actingAs($this->user);
        $response = $this->get('/admin/category/all');

        $response->assertStatus(200);
        $response->assertSee("Add new category");
    }

    public function test_user_can_add_categories()
    {
        $this->actingAs($this->user);
        $category = Category::factory()->make();

        $this->browse(function ($browser) use ($category) {
            $browser->visit('/admin/category/all')
            ->type('Parent category', 'category_name')
            ->type('fa fa-pen', 'category_icon')
            ->press('Add')
            ->seePageIs('/admin/category/all');

        });

        $this->assertDatabaseHas('categories', ['Parent Category']);
    }
}
