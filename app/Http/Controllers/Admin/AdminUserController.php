<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\AdminUserUpdateRequest;
use Jenssegers\Agent\Facades\Agent;

class AdminUserController extends Controller
{

    public const USERS_PER_PAGE = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    public function datatable()
    {
        return datatables(AdminUser::query())
            ->addColumn('actions', 'layouts.admin.actions')
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserStoreRequest $request)
    {
        AdminUser::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('dashboard.admins.index')->with('message', 'User successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function show(AdminUser $adminUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminUser $adminUser)
    {
        return view('admin.edit')->with('user', $adminUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserUpdateRequest $request, AdminUser $adminUser)
    {
        $data = $request->only(['name', 'email']);
        if ($request->password) {
            $data['password'] = $request->password;
        }
        $adminUser->update($data);

        return redirect()->route('dashboard.admins.index')->with('message', 'User successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminUser $adminUser)
    {
        $adminUser->delete();
        return response(true, 200);
    }
}
