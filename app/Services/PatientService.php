<?php

namespace App\Services;

use App\Repositories\PatientRepository;
use Carbon\Carbon;

class PatientService
{
    protected $patientRepository;

    public function __construct(PatientRepository $PatientRepository)
    {
        $this->patientRepository = $PatientRepository;
    }

    public function getAllPatients()
    {
        return $this->patientRepository->getAllPatients();
    }

    public function getPatientById(int $id)
    {
        return $this->patientRepository->getPatientById($id);
    }

    public function createPatient(array $patient)
    {
        $this->patientRepository->createPatient($patient);
        return response()->json(['message'=>'Patient created'],201);
    }

    public function updatePatient(int $id, array $patients)
    {
        $Patient = $this->patientRepository->getPatientById($id);
        if(!$Patient){
            return response()->json(['message'=>'Patient not found'],404);
        }

        $patients['dob'] = Carbon::create($patients['dob'])->toDateTimeString();
        $patients['registered'] = Carbon::create($patients['registered'])->toDateTimeString();

        $this->patientRepository->updatePatient($Patient,$patients);
        return response()->json(['message'=>'Patient updated']);
    }

    public function destroyPatient(int $id)
    {
        $Patient = $this->patientRepository->getPatientById($id);
        if(!$Patient){
            return response()->json(['message'=>'Patient not found'],404);
        }

        $this->patientRepository->destroyPatient($Patient);
        return response()->json(['message'=>'Patient deleted']);
    }

}