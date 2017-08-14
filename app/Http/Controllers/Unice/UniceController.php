<?php

namespace App\Http\Controllers\Unice;

use App\Control\Unice\SDK\Device\Device;
use App\Http\Controllers\Controller;
use App\Models\Unice\Unice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UniceController extends Controller
{
    public function all()
    {
        $unices = Unice::withCount('devices')
            ->whereIsBase(false)
            ->get();

        return view('unices.all.all', compact('unices'));
    }

    public function byUid($uid)
    {
        $unice = \App\Models\Unice\Unice::where('uid', $uid)
            ->select('id', 'name', 'uid')
            ->with(
                [
                    'devices' => function ($query) {
                        $query->select('id', 'name', 'device_type', 'unice_id');
                    },
                    'devices.type' => function ($query) {
                        $query->select('name', 'device_type');
                    },
                    'devices.state' => function ($query) {
                        $query->select('device_id', 'state', 'target');
                    }
                ])
            ->first();

        if (!$unice) {
            return new JsonResponse(null, 404);
        }

        unset($unice['id']);

        $unice->devices->each(function (\App\Models\Unice\Device $device, $key) use ($unice) {
            unset($unice->devices[$key]['id']);
            unset($unice->devices[$key]['unice_id']);

            unset($device["state"]['device_id']);

        });

        return new JsonResponse($unice->toArray());
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
            'devices',
            'devices.type',
            'devices.state',
            'devices.stateHistory'
        ]);

        return view('unices.unice.unice', compact('unice'));
    }

    public function updateState(Request $request)
    {
        $this->validate($request, [
            'device' => 'required|exists:devices,id',
            'target' => 'required|numeric'
        ]);

        try {
            Device::getById($request->device)
                ->updateTarget($request->target);


        } catch (\Exception $e) {
            return new JsonResponse([
                'messages' =>
                    [
                        'error' => [
                            'There has an error.'
                        ]
                    ]
            ]);
        }
        return new JsonResponse([
            'messages' =>
                [
                    'success' => [
                        'Device updated.'
                    ]
                ]
        ]);


    }
}