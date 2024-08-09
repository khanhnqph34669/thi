<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Throwable;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with("type")->paginate(2);
        return view("Room.index", compact("rooms"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = Type::pluck("name","id");
        return view("Room.create", compact("type"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        try{
            $data = [
                "name"=> $request->name,
                "describe"=> $request->describe,
                "type_id"=> $request->type_id,
                ];

                if($request->hasFile("image")){
                    $data['image'] = Storage::put('rooms', $request->image);
                }
                 Room::query()->create($data);
                 return redirect()->route('rooms.index')->with('success','Add success!');
        }catch(Throwable $e){
            return redirect()->back()->with("error", "Error: ".$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $room->load("type");
        $type = Type::pluck("name","id");
        return view("Room.edit", compact("room","type"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        try{
            $data = [
                "name"=> $request->name,
                "describe"=> $request->describe,
                "is_active"=> $request->is_Active,
                "type_id"=> $request->type_id,
                ];

                if($request->hasFile("image")){
                    $data['image'] = Storage::put('rooms', $request->image);
                }
                $room->update( $data);
                 return redirect()->back()->with('success','Update success!');
        }catch(Throwable $e){
            return redirect()->back()->with("error", "Error: ".$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        if($room->image && Storage::exists($room->image)){
            Storage::delete($room->image);
        }
        $room->delete();
        return redirect()->route("rooms.index")->with("success","Delete Success!");
    }
}
