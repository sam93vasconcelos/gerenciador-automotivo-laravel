<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supply;
use App\Models\Vehicle;
use App\Models\User;

class SuppliesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'km' => 'required',
            'price' => 'required',
            'liters' => 'required',
            'total' => 'required',
            'date' => 'required',
            'vehicle_id' => 'required',
        ], 
        [
            'km.required' => 'Preencha a quilometragem!',
            'price.required' => 'Preencha o valor por litro!',
            'liters.required' => 'Preencha a quantidade de litros!',
            'total.required' => 'Preencha o total!',
            'date.required' => 'Preencha a data!',
            'vehicle_id.required' => 'Nenhum veículo selecionado!'
        ]);

        $user = new User;

        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        if(!$user->isOwner($vehicle)) {
            return response()
                ->json('', 401);
        }
        
        $supply = Supply::create($request->all());

        return response()->json($supply);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supply $supply)
    {
        $vehicle = Vehicle::findOrFail($supply->vehicle_id);
        
        $this->authorize('update', $vehicle);

        $supply->update($request->all());

        return response()->json('', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supply $supply)
    {
        $vehicle = Vehicle::findOrFail($supply->vehicle_id);
        
        $this->authorize('delete', $vehicle);

        $supply->delete();

        return response()->json('', 200);
    }
}
