<?php

namespace App\Http\Controllers;

use App\Http\Modules\BaseWebCrud;
use App\Models\Asramas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\Attendence;
use App\Models\RewardHistory;
use App\Models\Room;

class LandingPageController extends BaseWebCrud
{
    public $viewPath = 'front.landing';
    public function landingPages(Request $request)
    {
        $asrama = Asramas::get();
        $room = Room::limit(4)->inRandomOrder()->get();
        return view($this->viewPath.'.landing', [
            'asrama' => $asrama,
            'room' => $room
        ]);
    }

    public function roomDetail($uuid, Request $request)
    {
       $room = Room::where('uuid', $uuid)->firstOrFail();
        return view('front.rooms.detail-room', [
            'row' => $room,
        ]);
    }
}