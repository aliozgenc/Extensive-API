<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Website;
use App\Models\Category;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminCanAddWebsite()
    {
        // Admin kullanıcısı oluştur
        $admin = User::factory()->create(['role' => 'admin']);

        // Admin kullanıcısı ile oturum aç
        $this->actingAs($admin);

        // Website eklemesi yapılabilir mi?
        $response = $this->postJson('/api/websites', [
            'name' => 'Example Website',
            'url' => 'https://example.com',
        ]);

        $response->assertStatus(201); // Başarılı bir şekilde eklenmişse 201 Created döner
    }

    public function testUserCannotAddWebsite()
    {
        // Normal kullanıcı oluştur
        $user = User::factory()->create(['role' => 'user']);

        // Normal kullanıcı ile oturum aç
        $this->actingAs($user);

        // Website eklemesi yapılabilir mi?
        $response = $this->postJson('/api/websites', [
            'name' => 'Example Website',
            'url' => 'https://example.com',
        ]);

        $response->assertStatus(403); // Yetkisiz erişim (403 Forbidden)
    }

    public function testAdminCanAddCategoryToWebsite()
    {
        // Admin kullanıcısı ve bir website oluştur
        $admin = User::factory()->create(['role' => 'admin']);
        $website = Website::factory()->create();

        // Admin kullanıcısı ile oturum aç
        $this->actingAs($admin);

        // Kategori ekleme işlemi yapılabilir mi?
        $response = $this->postJson("/api/websites/{$website->id}/categories", [
            'categories' => [1, 2, 3], // Kategori ID'leri
        ]);

        $response->assertStatus(200); // Başarılı bir şekilde eklenmişse 200 OK döner
    }

    public function testUserCannotAddCategoryToWebsite()
    {
        // Normal kullanıcı ve bir website oluştur
        $user = User::factory()->create(['role' => 'user']);
        $website = Website::factory()->create();

        // Normal kullanıcı ile oturum aç
        $this->actingAs($user);

        // Kategori ekleme işlemi yapılabilir mi?
        $response = $this->postJson("/api/websites/{$website->id}/categories", [
            'categories' => [1, 2, 3], // Kategori ID'leri
        ]);

        $response->assertStatus(403); // Yetkisiz erişim (403 Forbidden)
    }
}
