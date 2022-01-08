<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetUserData extends Command
{

    protected $signature = 'GetUserData:cron';

    protected $description = 'Get patients data from remote server';
    private $maxImports = 2000;
    private $maxImportsPerRequest = 1;
    private $timeOutConnection = 60;
    private $url = "https://randomuser.me/api/?results=";
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $countRequest = 0;

        for($countRequest = 0; $countRequest<($this->maxImports/$this->maxImportsPerRequest);$countRequest++){

            $response = Http::get($this->url.$this->maxImportsPerRequest);
            $data = $response->json();

            dd($this->handleData($data['results'][$countRequest]));
        }

    }

    public function handleData($data)
    {
        $address = [
            "street"=>$data['location']['street']['name'],
            "number"=>$data['location']['street']['number'],
            "city"=>$data['location']['city'],
            "state"=>$data['location']['state'],
            "country"=>$data['location']['country'],
            "postcode"=>$data['location']['postcode'],
            "latitude"=>$data['location']['coordinates']['latitude'],
            "longitude"=>$data['location']['coordinates']['longitude'],
            "timezone"=>$data['location']['timezone']['offset'],
            "timezone_description"=>$data['location']['timezone']['description'],
        ];
        $personal_data = [
            "title"=>$data['name']['title'],
            "name" =>$data['name']['first'],
            "last_name"=>$data['name']['last'],
            "gender" =>$data['gender'],
            "phone" =>$data['phone'],
            "cell" =>$data['cell'],
            "email" =>$data['email'],
        ];
        $system_data = [
            "registered" =>$data['registered']['date'],
            "uuid" =>$data['login']['uuid'],
            "username" =>$data['login']['username'],
            "dob" =>$data['dob']['date'],
            "status" =>"published",
            "picture_large" =>$data['picture']['large'],
            "picture_medium" =>$data['picture']['medium'],
            "picture_thumbnail" =>$data['picture']['thumbnail'],
            "nat" =>$data['nat'],
            "imported_t" =>Carbon::now()->toDateTimeString(),
        ];

        return [$personal_data,$address,$system_data];
    }
}
