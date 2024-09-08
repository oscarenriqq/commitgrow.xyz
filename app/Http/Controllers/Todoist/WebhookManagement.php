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

        Storage::append('request'.time().'.json', json_encode($request->all()). '\n');

        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'event_data' => 'required',
        ]);

        if ($validator->fails()) {
            Storage::append('webhook_log.txt', json_encode($validator->errors()->messages()));
            abort(400);
        }

        $eventName = $request->event_name;
        $eventData = $request->event_data;
        $updatedAt = Carbon::parse($eventData['updated_at'])->toDateString();
        $taskId = $eventData['id'];
        
        if ($eventName == 'item:completed') {
            $this->completeTask($taskId, $updatedAt);
        }
    }

    public function completeTask($taskId, $updatedAt) {
        $streak = Streak::where('task_id', $taskId)
                        ->where('day', $updatedAt)
                        ->first();

        $streak->completed = 1;
        $streak->save();
    }
}
