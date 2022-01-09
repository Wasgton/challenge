<?php

namespace App\Console\Commands;

use App\Services\PatientService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

CONST timeOutConnection = 60;
CONST URL = "https://randomuser.me/api/?results=";

class RemoteData extends Command
{
    protected $signature = 'remote_data:get';
    protected $description = 'Get patients data from remote server';
    protected $patientService;

    protected $max_imports = 2000;
    protected $return_per_request = 100;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
        parent::__construct();
    }

    public function handle()
    {
        $this->info('--------- Starting importation ---------');

        $maxIteration = $this->max_imports/$this->return_per_request;

        for($countRequest=1; $countRequest<=$maxIteration;$countRequest++){

            try {
                $response = Http::get(URL.$this->return_per_request);
                $data = $response->json();

                foreach($data['results'] as $data){

                    $handledData = $this->handleData($data);
                    $photos = [
                        'large'=>$handledData['picture_large'],
                        'medium'=>$handledData['picture_medium'],
                        'thumbnail'=>$handledData['picture_thumbnail']
                    ];

                    $photoPath = $this->handlePhotos($photos,$handledData['uuid']);

                    $handledData['picture_large'] = $photoPath['large'];
                    $handledData['picture_medium'] = $photoPath['medium'];
                    $handledData['picture_thumbnail'] = $photoPath['thumbnail'];

                    $response = $this->patientService->createPatient($handledData);

                }

                $this->info('Imported: '.$countRequest*$this->return_per_request);
                $this->info('---------------------------------------------');

            }catch (\Exception $e){
                Log::error('Error store',[
                    'message'=>$e->getMessage(),
                    'trace'=>$e->getTrace()
                ]);
                return ['error'=>$e->getMessage()];
            }

        }
        $this->info('Data importing finished');
    }

    private function handleData($data)
    {
        return [
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
            "nat" =>$data['nat'],
            "title"=>$data['name']['title'],
            "first_name" =>$data['name']['first'],
            "last_name"=>$data['name']['last'],
            "gender" =>$data['gender'],
            "phone" =>$data['phone'],
            "cell" =>$data['cell'],
            "email" =>$data['email'],
            "registered" => Carbon::create($data['registered']['date'])->toDateTimeString(),
            "uuid" =>$data['login']['uuid'],
            "username" =>$data['login']['username'],
            "dob" => Carbon::create($data['dob']['date'])->toDateTimeString(),
            "picture_large" =>$data['picture']['large'],
            "picture_medium" =>$data['picture']['medium'],
            "picture_thumbnail" =>$data['picture']['thumbnail'],
            "imported_t" =>Carbon::now()->toDateTimeString(),
            "status" =>"published",
        ];
    }

    private function handlePhotos($data,$uuid){

        $arrPhotos = [];

        foreach($data as $key => $photo){

            try
            {
                $contents = file_get_contents($photo);
                $extension = substr($photo, strrpos($photo, '/') + 1);
                $name = "patients/{$uuid}/{$key}/";
                Storage::disk('public')->put($name.$extension, $contents);
                $arrPhotos[$key]=$name.$extension;
            }
            catch (\Exception $e){
                Log::error('Error to download image',[
                    'message'=>$e->getMessage(),
                    'trace'=>$e->getTrace()
                ]);
                return false;
            }

        }

        return $arrPhotos;

    }

}
