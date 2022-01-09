<?php

namespace App\Repositories;

use App\Models\Patient;

class PatientRepository
{
    protected $entity;

    public function __construct(Patient $patient)
    {
        $this->entity = $patient;
    }

    public function getAllPatients()
    {
        return $this->entity->paginate(100);
    }

    public function getPatientById($id)
    {
        return $this->entity->where('id',$id)->first();
    }

    public function createPatient(array $patient)
    {
        return $this->entity->create($patient);
    }

    public function updatePatient(object $patient, array $patients)
    {
        return $patient->update($patients);
    }

    public function destroyPatient(object $patient)
    {
        return $patient->delete();
    }
}