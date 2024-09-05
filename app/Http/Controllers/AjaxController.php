<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    public function fetchUsers(Request $request)
    {
        $response = Http::get('https://randomuser.me/api/', [
            'results' => 9,
            'page' => $request->page,
            'seed' => 'kwanso',  // Use seed for consistent results for pagination
        ]);

        $data = $response->json();
        $users = collect($data['results']);
        $pagination = $data['info'];

        if($request->search){
            $users = collect($users)->filter(function($user) use ($request){
                return Str::contains($user['name']['first'], $request->search, true) || Str::contains($user['name']['last'], $request->search, true);
            });
            $users = array_values($users->toArray());
        }

        if($request->gender){
            $users = collect($users)->filter(function($user) use ($request){
                return Str::lower($user['gender']) == Str::lower($request->gender);
            });
            $users = array_values($users->toArray());
        }

        if($request->page > $pagination['page']){
            return $this->render_error([], 'No more users to show');
        }

        $storedUsers = Session::get('users', []);
        foreach ($users as $user) {
            $storedUsers[$user['login']['uuid']] = $user;
        }
        Session::put('users', $storedUsers);

        return $this->render_success($users);
    }
}
