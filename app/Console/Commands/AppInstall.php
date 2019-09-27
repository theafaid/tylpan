<?php

namespace App\Console\Commands;

use App\Eloquent\Countries;
use App\Models\AdditionalSetting;
use App\Models\Country;
use App\Models\GeneralSetting;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class AppInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install our application requirements';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('cache:clear');

        Artisan::call('migrate:fresh', [
            '--force' => true
        ]);
        // First of all we will store all countries in database and cache
        // All countries are marked as allowed to travel from it
        // No country marked as allowed to travel to it
        $this->storeCountires();

        // Create application general settings
        $this->createSiteGeneralSettings();

        // Create site additional settings
        $this->createSiteAdditionalSettings();

        // Create site default super admins
        $this->createDefaultUsers();

        $this->info('Ok. Done');

    }

    protected function storeCountires()
    {
        $data = json_decode(file_get_contents('https://restcountries.eu/rest/v2/all'));

        foreach($data as $country) {
            Country::forceCreate([
                'name' => $country->name,
                'alpha2_code' => $country->alpha2Code,
                'region' => $country->region,
                'calling_codes' => json_encode($country->callingCodes),
                'timezones' => json_encode($country->timezones),
                'currencies' => json_encode($country->currencies),
                'languages' => json_encode(collect($country->languages)->pluck('name')->toArray()),
                'flag' => $country->flag,
                'travel_from' => true,
                'travel_to' => false,
            ]);
        }

        $this->setAllowTravelToCountries();

        Cache::rememberForever('allowed_travel_from_countries', function (){
            return Country::all();
        });

        Cache::rememberForever('allowed_travel_to_countries', function (){
            return (new Countries)->allowedTravelTo();
        });
    }

    protected function setAllowTravelToCountries()
    {
        Country::whereIn('alpha2_code', ['UA', 'RU'])->update(['travel_to' => true]);
    }

    protected function createSiteGeneralSettings()
    {
        $settings = GeneralSetting::forceCreate([
            'site_name' => 'Tylpan',
            'site_description' => 'Travel Agency.',
            'site_keywords' => 'travel, agency, russia',
            'site_open' => true
        ]);

        Cache::rememberForever('site.general_settings', function () use ($settings) {
            return $settings;
        });
    }

    protected function createSiteAdditionalSettings()
    {
        AdditionalSetting::forceCreate([
            'site_slogan' => 'Just Travel Now',
            'site_email' => 'tylpan@support.com',
        ]);
    }

    protected function createDefaultUsers()
    {
        User::create([
            'first_name' => 'Abdulrahman',
            'middle_name' => '',
            'last_name' => 'Faid',
            'email' => 'abdurrhmanfaid@gmail.com',
            'password' => bcrypt('hguhf lk hgkj1088'),
            'email_verified_at' => now(),
            'role' => 'super_admin',
            'country_id' => Country::where('alpha2_code', 'eg')->first()->id,
        ]);
    }
}
