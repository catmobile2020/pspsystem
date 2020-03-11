<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use App\User;

class PatientController extends Controller
{

    /**
     *
     * @SWG\Get(
     *      tags={"patients"},
     *      path="/patients/{patient}",
     *      summary="get single patient",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="patient",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param User $patient
     * @return UserResource
     */
    public function show(User $patient)
    {
        return UserResource::make($patient);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"patients"},
     *      path="/patients/{patient}/orders",
     *      summary="get single patient orders paginated",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="patient",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param User $patient
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function patientOrders(User $patient)
    {
       $rows = $patient->patientOrders()->latest()->paginate($this->api_paginate_num);
        return OrderResource::collection($rows);
    }
}
