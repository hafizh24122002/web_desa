@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                {{-- menu yang di atas --}}
                @include('partials.adminTopMenu')

                {{-- content --}}
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="row justify-content-center mt-5">
                    <div class="col-6 align-items-center">
                        <div class="card text-center p-4 rounded">
                            <div class="card-image fs-1 mx-2">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fs-4">Email Verification Required</h5>
                                <p class="card-text">To continue, please verify your email address by clicking the link in the mail we just sent you. Thanks!</p>
                                <!-- <h6 class="card-text mb-1 fs-6">Can't find the email?</h6> -->
                                <a href="/verify-email/request" class="btn btn-secondary">Resend verification email</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.commonScripts')

@endsection