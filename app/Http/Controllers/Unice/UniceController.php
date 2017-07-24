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
        $unices = Unice::with('type')
            ->withCount('devices')
            ->get();

        return view('unices.all.all', compact('unices'));
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

    public function updateState(Request $request)
    {
        $this->validate($request, [
            'device' => 'required|exists:devices,id',
            'target' => 'required|numeric'
        ]);

        Device::getById($request->device)
            ->updateTarget($request->target);

        return new JsonResponse([
            'messages' =>
                [
                    'success' => [
                        'Device Updated.'
                    ]
                ]
        ]);
    }
}