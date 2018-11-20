<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Setting::set('automatic-activation-after-registe', 'false');
        Setting::set('activation-type', '{"default":"email","selected":"email","options":{"email":"Email","manual":"Manual"}}');
        Setting::set('activation-type', '{"default":"email","selected":"email","options":{"email":"Email","manual":"Manual"}}');
        Setting::set('activation-availability', 'true');
        Setting::set('forgot-password-avalilability', 'true');
        Setting::set('backend-entry-point', 'admin.dashboard.index');
        Setting::set('app-name', 'Laravel 5');
        Setting::set('app-lang', 'en');
        Setting::set('app-timezone', 'Europe/Tirane');
        Setting::set('app-date-format', 'd-m-Y');
        Setting::set('app-time-format', 'H:i A');
        Setting::set('app-first-day-of-week', '1');
        Setting::set('app-accepted-file-format', 'jpeg,png');
        Setting::set('app-rows-per-page', '10');
        Setting::set('app-decimal-separator', '.');
        Setting::set('app-thousands-separator', '.');


    }
}
