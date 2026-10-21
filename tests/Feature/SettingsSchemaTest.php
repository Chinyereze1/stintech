<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SettingsSchemaTest extends TestCase
{
    public function test_settings_table_contains_expected_columns_for_filament_form(): void
    {
        $this->assertTrue(Schema::hasColumn('settings', 'site_name'));
        $this->assertTrue(Schema::hasColumn('settings', 'logo_light'));
        $this->assertTrue(Schema::hasColumn('settings', 'logo_dark'));
        $this->assertTrue(Schema::hasColumn('settings', 'favicon'));
        $this->assertTrue(Schema::hasColumn('settings', 'accent_color'));
        $this->assertTrue(Schema::hasColumn('settings', 'template_style'));
        $this->assertTrue(Schema::hasColumn('settings', 'whatsapp_number'));
        $this->assertTrue(Schema::hasColumn('settings', 'contact_email'));
        $this->assertTrue(Schema::hasColumn('settings', 'linkedin_url'));
        $this->assertTrue(Schema::hasColumn('settings', 'github_url'));
        $this->assertTrue(Schema::hasColumn('settings', 'enable_blog'));
        $this->assertTrue(Schema::hasColumn('settings', 'enable_quote'));
    }
}
