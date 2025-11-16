@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Customer
                    <a href="{{ url('admin/dashboard/customer') }}" class="btn btn-danger float-end"> Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                    <div class="mb-3">
                        <label> Customer Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}"/>
                        @error('name') <span class="text-danger"> {{ $message}} </span>@enderror
                    </div>
                    <div class="mb-3">
                        <label> Customer Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $user->email }}"/>
                        @error('email') <span class="text-danger"> {{ $message}} </span>@enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection