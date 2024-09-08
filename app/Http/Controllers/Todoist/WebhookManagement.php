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

        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'event_data' => 'required',
            'updated_at' => 'required',
        ]);

        if ($validator->fails()) {
            Storage::append('webhook_log.txt', $validator->errors()->messages());
            abort(400);
        }

        $eventName = $request->event_name;
        $eventData = $request->event_data;
        $updatedAt = $request->updated_at;
        $taskId = $eventData['id'];
        
        // Storage::append('data.txt', json_encode([
        //     'task_id' => $taskId,
        //     'updated_at' => $updatedAt,
        //     'event_name' => $eventName,
        //     'event_data' => $eventData
        // ]));

        if ($eventName == 'item:completed') {
            $this->completeTask($taskId, $updatedAt);
        }
    }

    public function completeTask($taskId, $updatedAt) {
        $streak = Streak::where('task_id', $taskId)
                        ->where('day', Carbon::parse($updatedAt)->toDateString())
                        ->first();

        $streak->completed = 1;
        $streak->save();
    }
}
