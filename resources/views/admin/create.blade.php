@extends('layouts.admin.app')

@section('title')
    Create Admin User
@endsection

@section('content')
    <div class="card mt-3">
        <div class="card-body">
            <form id="create-form" action="{{ route('dashboard.admins.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control" name="name" />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" />
                </div>
                <button type="submit" class="btn btn-success btn-lg">Create</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\AdminUserStoreRequest', '#create-form') !!}
@endsection
