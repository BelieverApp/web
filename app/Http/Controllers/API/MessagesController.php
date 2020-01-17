<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Message;
use App\Models\MessageUser;
use App\Models\Follower;
use Carbon\Carbon;
use App\Utility;
use App\Models\Client;

class MessagesController extends Controller
{
    public $ip;

    public function __construct(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $this->ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $this->ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $this->ip = $_SERVER['REMOTE_ADDR'];
        }
    }

    public function index(Request $request)
    {
        \Log::info('API\MessagesController@index: ' . PHP_EOL .
        "IP: " . $this->ip . PHP_EOL . 
        $request . 
        PHP_EOL . " -------------");

        $messages = MessageUser::where('user_id', $request->user_id)->orderByDesc('created_at')->get()
                            ->each(function ($message) {
                                $messageDetail = Message::find($message->message_id);
                                $message->subject = $messageDetail->subject;
                                $message->trunc_body = Utility::truncateHtml(strip_tags($messageDetail->body));

                                $message->prettyCreatedAt = Utility::getTimePastSinceToday($message->created_at);
                                $message->client = Client::where('id', $messageDetail->brand_id)
                                 ->select('name', 'logo')
                                 ->first();
                            });
        return ($messages);
    }

    public function show(Request $request)
    {
        \Log::info('API\MessagesController@show: ' . PHP_EOL . 
        "IP: " . $this->ip . PHP_EOL . 
        $request . 
        PHP_EOL . " -------------");

        $message = Message::where('messages.id', $request->message_id)
                    ->join('brands', 'brands.id', '=', 'messages.brand_id')
                    ->select('messages.*', 'brands.name as brand_name', 'brands.logo as brand_logo')
                    ->first();
        return ($message);
    }

    public function delete(Request $request)
    {
        \Log::info('API\MessagesController@delete: ' . PHP_EOL . 
        "IP: " . $this->ip . PHP_EOL . 
        $request . 
        PHP_EOL . " -------------");

        $message = MessageUser::where('message_id', $request->message_id)
                                ->where('user_id', $request->user_id)
                                ->delete();
        if ($message){
            $data=['status'=>'1','msg'=>'success'];
        } else {
            $data=['status'=>'0','msg'=>'user/message was not found'];
        }

        return response()->json($data);
    }
}




