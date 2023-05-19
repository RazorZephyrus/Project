<?php

namespace App\Http\Controllers;

use App\Http\Modules\BaseWebCrud;
use App\Models\Asramas;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\Attendence;
use App\Models\Booking;
use App\Models\RewardHistory;
use App\Models\Room;

class LandingPageController extends BaseWebCrud
{
    public $viewPath = 'front.landing';
    public function landingPages(Request $request)
    {
        $asrama = Asramas::get();
        $room = Room::limit(4)->inRandomOrder()->get();
        return view($this->viewPath . '.landing', [
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
    public function asramaDetail($uuid, Request $request)
    {
        $asrama = Asramas::where('uuid', $uuid)->firstOrFail();
        $kamar = Room::with(['RoomFasilitas'])->where('asrama_id', $asrama->id);
        if ($request->get('room_type') != null) {
            $kamar = $kamar->where('room_type_id', RoomType::getId($request->get('room_type')));
        }
        if ($request->get('q') != null) {
            $kamar = $kamar->where('title', 'like', '%' . $request->get('q') . '%');
        }
        $kamar = $kamar->get();
        return view('front.asrama.detail-asrama', [
            'row' => $asrama,
            'room' => $kamar
        ]);
    }

    public function RoomBooking(Request $request)
    {
        $input = $request->all();
        if ($input['start_date'] == null) {
            return redirect(url()->previous());
        }
        if ($input['type_harga'] == null) {
            return redirect(url()->previous());
        }
        $room = Room::where('uuid', $input['room_id'])->first();
        $input['room_id'] = $room->id;
        $input['user_id'] = auth()->user()->id;
        $lengthOfStay = (int) $input['lenght_of_stay'];
        $totalHarga = $room[$input['type_harga']];
        $input['total_price'] = $totalHarga * $lengthOfStay;
        $input['length_of_stay'] = (int) $input['lenght_of_stay'];
        if ($lengthOfStay == 0) {
            return redirect(url()->previous());
        }
        //    if($input['type_harga'] == 'perhari') {
        //         $input['end_date'] = date('Y-m-d',strtotime($input['start_date'] . "+1 days"));
        //     } elseif($input['type_harga'] == 'perbulan') {
        //         $input['end_date'] = date('Y-m-d',strtotime($input['start_date'] . "+30 days"));
        //     } elseif($input['type_harga'] == 'persemester') {
        //         $input['end_date'] = date('Y-m-d',strtotime($input['start_date'] . "+180 days"));
        //     }


        $check = Booking::where('room_id', $input['room_id'])->where('user_id', $input['user_id'])->first();
        unset($input['_token']);
        if ($check == null) {
            Booking::create($input);
        } else {
            $check->update($input);
        }

        return redirect(url()->previous());
    }
}