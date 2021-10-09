@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div class="row mt-4">
                        <h5>Binding account</h5>

                        <table class="table table-borderless">
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Facebook</td>
                                <td>
                                    @if ($facebookAccount)
                                        <p>Ada akun</p>
                                    @else
                                        <a href="{{ route('oauth', ['driver' => 'facebook']) }}">Connect Now</a>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>Google</td>
                                <td>
                                    @if ($googleAccount)
                                        <p>{{ $googleAccount['email'] }}</p>
                                    @else
                                        <a href="{{ route('oauth', ['driver' => 'google']) }}">Connect Now</a>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
