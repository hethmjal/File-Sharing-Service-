<?php

namespace App\Listeners;

use App\Events\FileDownloaded;
use App\Models\Log;
use App\Services\Geolocation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostInLog
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FileDownloaded $event): void
    {

        $key = config('services.geolocation.key');
        $ip = request()->ip();
        $geolocation = new Geolocation($key);
        $data = $geolocation->getGeoLocation($ip);
      
        $geo = [
            'country_name' => $data['country_name'],
            'country_code' => $data['country_code2'],
            'city' => $data['city'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'languages' => $data['languages'],
            'country_flag' => $data['country_flag'],
            "currency" => [
            "code" => $data['currency']['code'],
            "name" => $data['currency']['name'],
            "symbol" => $data['currency']['symbol'],
            ],
            'time_zone' => $data['time_zone']['name']
        ];
        //dd($geo);
        $log = Log::create([
            'time' => now(),
            'ip' => request()->ip(),
            'user_agent' => request()->header('user-agent'),
            'file_id' => $event->file->id,
            'geolocation' => $geo, 
        ]);


       // dd($event,request()->ip(),request()->header('user-agent'));
    }
}
