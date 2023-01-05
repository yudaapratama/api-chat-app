<?php

namespace App\Http\Controllers\API;

use App\Events\PrivateChat;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Room;
use App\Traits\ResponseApi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    use ResponseApi;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Room $room)
    {
        try {

            if(!$room) {
                return $this->error('room not found', 404);
            }

            $chats = Chat::userChat()->where('room_id', $room->id)->get();
            
            return $this->success('chat messages', ChatResource::collection($chats));
            

        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Room $room)
    {
        try {

            $data = Validator::make($request->all(), [
                'message' => 'required'
            ]);

            if($data->fails()) {
                return $this->error($data->errors(), 400);
            }

            DB::transaction(function () use ($request, $room) {

                $message = Message::create([
                    'content' => $request->message
                ]);
        
                $forSender = Chat::create([
                    'room_id' => $room->id,
                    'user_id' => auth()->user()->id,
                    'message_id' => $message->id,
                    'type' => 0
                ]);
    
                $forReceiver = Chat::create([
                    'room_id' => $room->id,
                    'user_id' => $room->receiver,
                    'message_id' => $message->id,
                    'type' => 1
                ]);

                broadcast(new PrivateChat($message->content, $room->id));

            }, 3);

            return $this->success('send succesfully', []);
    
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
