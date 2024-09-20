<?php

namespace App\Livewire\Pages;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('layouts.app')]
class TodoistCallbackPage extends Component
{
    #[Url]
    public $code = '';
    #[Url]
    public $state = '';

    public function render()
    {

        $accessToken = auth()->user()->todoist_access_token;

        if (!isset($accessToken)) {
            $response = Http::post('https://todoist.com/oauth/access_token', [
                'client_id' => config('app.todoist_client_id'),
                'client_secret' => config('app.todoist_client_secret'),
                'code' => $this->code
            ])->json();
    
            $currentUser = auth()->user();
    
            $user = User::where('id', $currentUser->id)->first();
            $user->todoist_access_token = $response['access_token'];
            $user->save();
    
            return view('livewire.pages.todoist-callback-page');
        }
        
        return $this->redirect(url: '/dashboard', navigate: true);
    }
}
