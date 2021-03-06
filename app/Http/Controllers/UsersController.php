<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getAll(Request $request)
    {
        if ($request->isJson()) {
            return User::all();
        } else {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
    }

    public function createUser(Request $request)
    {
        if ($request->isJson()) {
//            $data = $request->json()->all();

            $data = $this->validate($request, [
                'name' => 'required|max:255',
                'username' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'api_token' => str_random(60)
            ]);
            return response()->json($user, 201);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
    }

    public function updateUserStatus(Request $request, $id)
    {
        if ($request->isJson()) {
            try {
                $user = User::findOrFail($id);

                $data = $this->validate($request, [
                    'status' => 'required'
                ]);

                $user->status = $data['status'];
                $user->save();
                return response()->json($user, 200);
            } catch (ModelNotFoundException $e) {
                return response()->json(['error' => 'No content'], 406);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
    }

    public function updateUser(Request $request, $id)
    {
        if ($request->isJson()) {
            try {
                $user = User::findOrFail($id);
//                $data = $request->json()->all();

                $data = $this->validate($request, [
                    'name' => 'required|max:255',
                    'username' => 'required',
                    'email' => 'required',
                    'password' => 'required',
                ]);

                $user->name = $data['name'];
                $user->username = $data['username'];
                $user->email = $data['email'];
                $user->password = Hash::make($data['password']);
                $user->save();
                return response()->json($user, 200);
            } catch (ModelNotFoundException $e) {
                return response()->json(['error' => 'No content'], 406);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
    }

    public function getUser(Request $request, $id)
    {
        if ($request->isJson()) {
            try {
                $user = User::with(['issues_assigned_to_me', 'issues_reported_to_me'])->findOrFail($id);
                return response()->json($user, 200);
            } catch (ModelNotFoundException $e) {
                return response()->json(['error' => 'No content'], 406);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
    }

    public function deleteUser(Request $request, $id)
    {
        if ($request->isJson()) {
            try {
                $user = User::findOrFail($id);
                $user->delete();
                return response()->json($user, 200);
            } catch (ModelNotFoundException $e) {
                return response()->json(['error' => 'No content'], 406);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
    }

    public function getUserId(Request $request)
    {
        return Auth::user()->id;
    }

    public function getToken(Request $request)
    {
        if ($request->isJson()) {
            try {
                $data = $request->json()->all();
                $user = User::where('username', $data['username'])->first();

                if ($user && Hash::check($data['password'], $user->password)) {
                    return response()->json($user, 200);
                } else {
                    return response()->json(['error' => 'No content'], 406);
                }
            } catch (ModelNotFoundException $e) {
                return response()->json(['error' => 'No content'], 406);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
    }
}
