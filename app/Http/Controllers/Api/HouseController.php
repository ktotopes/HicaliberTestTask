<?php

namespace App\Http\Controllers\Api;

use App\Models\House;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\HouseResource;

class HouseController extends Controller
{
    public function index()
    {


        return response()->json([
            'houses' => HouseResource::collection(House::all()),
        ]);
    }

    public function filtered(Request $request)
    {
        $filter = $request->input('filter');


        return response()->json([
            'houses' => HouseResource::collection(
                House::query()
                    ->where(
                        fn($query) => $query
                            ->where(function ($query) use ($filter) {
                                return $filter['names'] ? $query->where('name','like',"%" . $filter['names']. "%") : $query;
                            })
                            ->where(function ($query) use ($filter) {
                                return $filter['bedrooms'] ? $query->where('bedrooms','=',$filter['bedrooms']) : $query;
                            })
                            ->where(function ($query) use ($filter) {
                                return $filter['bathrooms'] ? $query->where('bathrooms','=',$filter['bathrooms']) : $query;
                            })
                            ->where(function ($query) use ($filter) {
                                return $filter['storeys'] ? $query->where('storeys','=',$filter['storeys']) : $query;
                            })
                            ->where(function ($query) use ($filter) {
                                return $filter['garages'] ? $query->where('garages','=',$filter['garages']) : $query;
                            })
                            ->where(function ($query) use ($filter) {
                                return $filter['min_price'] ? $query->where('price','>',$filter['min_price']) : $query;
                            })
                            ->where(function ($query) use ($filter) {
                                return $filter['max_price'] ? $query->where('price','<',$filter['max_price']) : $query;
                            })
                    )
                    ->get()
            ),
        ]);
    }
}
