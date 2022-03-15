<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\GeneralController;
use App\Http\Resources\ShiftResource;
use App\Models\Shift;


class ShiftController extends GeneralController
{
    public function __construct(Shift $model)
    {
        parent::__construct($model);
    }

    public function shifts()
    {
        $id = auth('api')->user()->id;
        $user_shifts=$this->model::where('user_id',$id)->get();
        $user_shifts= (ShiftResource::collection($user_shifts));
        return $this->sendResponse($user_shifts,'تم اظهار بيانات الدوام بنجاح', 200);
    }
}
