@extends('master')
@section('title', 'Rooms')
@section('content')
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">Create</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Describe</th>
                    <th>Image</th>
                    <th>Is_Active</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                <tr>
                   
                    <td>{{$room->name}}</td>
                    <td>{{$room->describe}}</td>
                    <td>
                        @if ($room->image && Storage::exists($room->image))
                            <img src="{{ Storage::url($room->image) }}" alt="" style="width: 100px">
                        @endif
                    </td>
                    <td>
                        @if ($room->is_Active == 1)
                            <span class="badge bg-info">Active</span>
                        @else
                            <span class="badge bg-info">Inactive</span>
                        @endif
                    </td>
                    <td>{{$room->type->name}}</td>
                    <td>
                        <a href="{{route('rooms.edit',$room)}}" class="btn btn-warning">Edit</a>
                        <form action="{{route('rooms.destroy',$room)}}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xoá phòng với id là {{$room->id}}')">Delete</button>
                        </form>
                    </td>    
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $rooms->links() }}
    </div>
@endsection