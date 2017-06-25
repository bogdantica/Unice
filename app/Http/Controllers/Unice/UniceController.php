<?php

namespace App\Http\Controllers\Unice;

use App\Http\Controllers\Controller;
use App\Models\Unice\Device;
use App\Models\Unice\Unice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UniceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function all()
    {
        $unices = Unice::with('type')
            ->withCount('devices')
            ->get();

        return view('unices.all.all', compact('unices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  Unice $unice
     * @return mixed
     */
    public function unice(Unice $unice)
    {
        $unice->load([
            'type',
            'devices',
            'devices.type',
            'devices.state'
        ]);

        return view('unices.unice.unice', compact('unice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {

    }


    public function updateState(Request $request)
    {
        $this->validate($request, [
            'device' => 'required|exists:devices,id',
            'newTarget' => 'required'
        ]);

        $device = Device::with(['state', 'type'])->where('id', $request->device)->first();


        //todo make a method or class in order to handle new state based on device type
        // todo and send new state_target to device via communication class

//        if ($request->newTarget != $device->state->state_target) {
//        }

        $device->state->state_target = $request->newTarget;
        $device->state->state_target_real = $request->newTarget; //todo remove
        $device->state->save();

        //todo
        return new JsonResponse([
            'messages' =>
                [
                    'success' => [
                        'Changes should be visible in short time.'
                    ]

                ]
        ]);
    }
}

?>