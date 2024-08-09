@extends('master')
@section('title', 'Create Rooms')
@section('content')
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                
            @endif
        <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="describe">Describe</label>
                <textarea name="describe" id="describe" cols="30" rows="10"  class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control mb-3" id="type_id" name="type_id">
                    <option value="">Choose Type</option>
                    @foreach ($type as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach    
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection