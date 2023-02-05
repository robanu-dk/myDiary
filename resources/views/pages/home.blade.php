@extends('layout.navbar')

@section('diary_content')
    <div class="container flex-wrap flex-md-nowwrap pt-2" style="height: auto">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

       @if ($diaries->count())
        <div class="pt-4">
            <div class="card text-center" style="width: 18rem;">
                <button class="btn" data-bs-toggle="modal" data-bs-target="#createModal">
                    <div class="card-body">
                        <img src="{{ asset('icon/Add new.png') }}" alt=""  style="height: 50%; width:50%;">
                        <h5 class="card-title">Create New Diary</h5>
                    </div>
                </button>
            </div>
        </div>

        <div class="row">
            @foreach ($diaries as $diary)
                <div class="col-sm-6  pt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">{{ $diary->title }}</h5>
                            <div class="card-text" style="height:1.4em;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                {!! $diary->content !!}
                            </div>
                            <div class="btn-toolbar pt-4" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#readModal{{ $loop->iteration }}">Read</button>
                                </div>
                                <div class="btn-group ps-2" role="group" aria-label="Second group">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $loop->iteration }}">Edit</button>
                                </div>
                                <div class="btn-group ps-2" role="group" aria-label="Third group">
                                    <form action="/{{ $diary->id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Delete Diary \'{{ $diary->title }}\'?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Read Modal -->
                <div class="modal fade" id="readModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="readModal{{ $loop->iteration }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content"  style="width: auto">
                            <div class="modal-header">
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $loop->iteration }}">Edit</button>
                                    </div>
                                    <div class="btn-group ps-2" role="group" aria-label="Second group">
                                        <form action="/{{ $diary->id }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger" onclick="return confirm('Delete Diary \'{{ $diary->title }}\'?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <h3 class="modal-title" id="readModal{{ $loop->iteration }}Label">{{ $diary->title }}</h3>
                                <p class="fs-6 text-muted">Last Update at {{ $diary->updated_at }}</p>
                                <p>
                                    {!! $diary->content !!}
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Modal -->
                <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="editModal{{ $loop->iteration }}Label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog">
                        <form action="/{{ $diary->id }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModal{{ $loop->iteration }}Label">Edit Diary "{{ $diary->title }}"</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="title" class="col-form-label">Title:</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $diary->title }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="content" class="form-label">Content:</label>
                                        <input class="@error('content') is-invalid @enderror" id="content{{ $loop->iteration }}" type="hidden" name="content" value="{{ $diary->content }}" required>
                                        <trix-editor input="content{{ $loop->iteration }}" style="background-color: white"></trix-editor>
                                        @error('content')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Update Diary?')">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            @endforeach
       @else
       <div class="position-absolute top-50 start-50 translate-middle">
            There is no diary. <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Click here</button> to make a diary!
        </div>
       @endif

        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <form action="/" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Create New Diary</h5>
                            <h5>{{ date('d/m/Y') }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="col-form-label">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content:</label>
                                <input class="@error('content') is-invalid @enderror" id="content" type="hidden" name="content" required>
                                <trix-editor input="content" style="background-color: white"></trix-editor>
                                @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Save Diary?')">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
