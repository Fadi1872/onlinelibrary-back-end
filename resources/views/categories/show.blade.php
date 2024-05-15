@extends('layouts.master')

@section('title')
    Categories
@endsection

@section('navone')
    Categories
@endsection

@section('navtwo')
    show
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">All Categories</h3>
                    <a href="{{route('categories.create')}}" class="btn btn-primary">Add Category</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th style="width: 15%">created_at</th>
                            <th style="width: 15%">updated_at</th>
                            <th style="width: 15%">processes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                            <tr class="align-middle">
                                <td>{{$loop->index + 1}}.</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td>
                                    <a href="{{route('categories.edit', $item->id)}}" class="btn btn-primary">edit</a>
                                    <form method="POST" action="{{route('categories.destroy', $item->id)}}" class="d-inline">
                                        @csrf
                                        @method('delete')
                                    <button type="submit" class="btn btn-danger">delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
