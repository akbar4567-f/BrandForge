@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="container mt-4">

    <div class="card mb-4">
        <div class="card-header">
            Profile
        </div>

        <div class="card-body">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            Password
        </div>

        <div class="card-body">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Hapus Akun
        </div>

        <div class="card-body">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>

@endsection