<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Jenssegers\Agent\Facades\Agent;

class UserController extends Controller
{

    public const USERS_PER_PAGE = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    public function datatable()
    {
        return datatables(User::query())
            ->addColumn('actions', 'user.actions')
            ->editColumn('user_agent', function ($each) {
                $user_agent = $each->user_agent;
                if (!$user_agent) return null;
                $platform =  Agent::platform($user_agent);
                $browser = Agent::browser($user_agent);
                return "$browser $platform";
            })
            ->rawColumns(['actions'])->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        return view('admin.edit')->with('user', $User);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        $data = $request->only(['name', 'email']);
        if ($request->password) {
            $data['password'] = $request->password;
        }
        $User->update($data);

        return redirect()->route('dashboard.admins.index')->with('message', 'User successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        $User->delete();
        return response(true, 200);
    }
}
