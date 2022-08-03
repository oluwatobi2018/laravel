<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManageController extends Controller
{

    public function index(Request $request)
    {
        $data = User::all();

        return view('admin.users.index', ['users' => $data]);
    }

    public function user_save(Request $request) {
        $data = $request->parms;
        $userId = $data[0];
        $user_check = User::where('id', $userId)->get();
        if(!$data[0])
        {
            User::create([
                'name' => $data[1],
                'email' => $data[2],
                'password' => Hash::make($data[3]),
                'password1' => $data[3],
                'approve' => '0'
            ]);
        }
        else
        {
            $userUpdate = [
                'name' => $data[1],
                'email' => $data[2],
                'password' => Hash::make($data[3]),
                'password1' => $data[3],
            ];
            User::where('id', $userId)->update($userUpdate);
        }

        return response()->json('success');
    }

    public function user_delete(Request $request) {
        User::where('id', $request->id)->delete();
    }

    public function approve(Request $request) {
        $user_id = $request->id;
        $approve_status = User::where('id', $user_id)->select('approve')->get();
        $status = $approve_status[0]->approve;
        if( $status == "0")
            $approveUpdate = [
                'approve' => "1"
            ];
        else
            $approveUpdate = [
                'approve' => "0"
            ];
        User::where('id', $user_id)->update($approveUpdate);
        return response()->json($approveUpdate);
    }

    public function getUsers() {
    }

}