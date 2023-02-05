@extends('layout.main')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container flex-wrap flex-md-nowwrap" style="height: auto">
      <div>
        <a class="navbar-brand" href="{{ asset('logo/Logo.png') }}"><img src="{{ asset('logo/Logo.png') }}" alt="" width="50px" height="50px"></a>
        <a class="navbar-brand" href="{{ asset('logo/My Diary.png') }}"><img src="{{ asset('logo/My Diary.png') }}" alt="" width="130px" height="50px"></a>
      </div>
      <button class="btn rounded-pill btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#logoutModal">Welcome, {{ Auth::user()->name }}</button>

        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirmation</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout Diary?
                </div>
                <div class="modal-footer">
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group" role="group" aria-label="First group">
                            <button type="button" class="btn btn-second" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="btn-group ps-2" role="group" aria-label="Second group">
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="btn btn-danger">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

    </div>
  </nav>
  @yield('diary_content')
@endsection
