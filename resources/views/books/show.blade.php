@extends('layouts.master')

@section('title')
    Books
@endsection

@section('navone')
    Books
@endsection

@section('navtwo')
    show
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">All books</h3>
                    <a href="{{route('books.create_book', -1)}}" class="btn btn-primary">Add Book</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 15%">Name</th>
                            <th style="width: 30px">Sub_Category</th>
                            <th style="width: 30px">Category</th>
                            <th style="width: 30px">Total_Rate</th>
                            <th style="width: 15%">Created_at</th>
                            <th style="width: 15%">Updated_at</th>
                            <th style="width: 15%">processes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $item)
                            <tr class="align-middle">
                                <td>{{$loop->index}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->sub_category->name}}</td>
                                <td>{{$item->sub_category->category->name}}</td>
                                <td>{{$item->total_rate}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td>
                                    <a href="{{route('books.edit_book', ['category' => $item->sub_category->category->id, 'id' => $item->id])}}" class="btn btn-primary">edit</a>
                                    <form method="POST" action="{{route('books.destroy', $item->id)}}" class="d-inline">
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
