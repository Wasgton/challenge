<?php

namespace App\Services;

use App\Repositories\PatientRepository;

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
        return $this->patientRepository->createPatient($patient);
    }

    public function updatePatient(int $id, array $patients)
    {
        $Patient = $this->patientRepository->getPatientById($id);
        if(!$Patient){
            return response()->json(['message'=>'Patient not found'],404);
        }

        $this->patientRepository->updatePatient($Patient,$patients);
        return response()->json(['massage'=>'Patient updated']);
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