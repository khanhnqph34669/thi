@extends('master')
@section('title', 'Edit Rooms')
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

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        <form action="{{ route('rooms.update',$room) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$room->name}}">
            </div>
            <div class="form-group">
                <label for="describe">Describe</label>
                <textarea name="describe" id="describe" cols="30" rows="10" class="form-control">
                    {{$room->describe}}
                </textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @if ($room->image && Storage::exists($room->image))
                    <img src="{{ Storage::url($room->image) }}" alt="" style="width: 100px">
                @endif
            </div>
            <div class="form-group">
                <label for="is_Active">Is Active</label>
                <select name="is_Active" id="is_Active" class="form-control">
                    @if ($room->is_Active == 1)
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    @endif
                    @if ($room->is_Active == 0)
                        <option value="1">Active</option>
                        <option value="0" selected>Inactive</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control mb-3" id="type_id" name="type_id">
                    <option value="">Choose Type</option>
                    @foreach ($type as $id => $name)
                        <option value="{{ $id }}" 
                            @if ($room->type_id == $id)
                                selected
                            @endif
                        >{{ $name }}</option>
                    @endforeach    
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection