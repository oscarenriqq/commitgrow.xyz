<?php

namespace App\Http\Controllers\Todoist;

use App\Http\Controllers\Controller;
use App\Models\Streak;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WebhookManagement extends Controller
{
    private $today;
    public function __construct() {
        $this->today = Carbon::today();
    }
    
    public function process(Request $request) {

        Storage::append('testing_webhook_'. time() .'.txt', json_encode($request->all()));
        abort(200);

        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'event_data' => 'required',
        ]);

        if ($validator->fails()) {
            Storage::append('webhook_log.txt', $validator->errors()->messages());
            abort(400);
        }

        $eventName = $request->event_name;
        $eventData = $request->event_data;
        $taskId = $eventData['id'];

        if ($eventName == 'item:updated') {
            $this->updateTask($taskId);
        }

    }

    public function updateTask($taskId) {
        $streak = Streak::where('task_id', $taskId)
                        ->where('day', $this->today)
                        ->first();

        $streak->completed = 1;
        $streak->save();
    }
}
