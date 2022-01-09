<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientResource;
use App\Http\Requests\PatientRequest;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function index()
    {
        $patient = $this->patientService->getAllPatients();
        return PatientResource::collection($patient);
    }

    public function store(PatientRequest $request)
    {
        $patient = $this->patientService->makeCategory($request->all());
        return new PatientResource($patient);
    }

    public function show($id)
    {
        $patient = $this->patientService->getPatientById($id);
        return new PatientResource($patient);
    }

    public function update(PatientRequest $request, $id)
    {
        return $this->patientService->updatePatient($id,$request->all());
    }

    public function destroy($id)
    {
        $this->patientService->destroyPatient($id);
    }
}
