@extends('layouts.master')

@section('title')
    Books
@endsection

@section('navone')
    Books
@endsection

@section('navtwo')
    {{ isset($book) ? 'edit' : 'add' }}
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card card-primary card-outline mb-4">
            <!--begin::Form-->
            <form method="POST"
                action="{{ isset($book) ? route('books.update', $book[0]->id) : route('books.store') }}">
                <!--begin::Body-->
                @csrf
                @if (isset($book))
                    @method('put')
                @endif
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row align-items-center g-3 mb-3">
                        <!--begin::Col-->
                        <label for="validationCustom01" class="form-label col-lg-2">Book Name</label>
                        <input type="text" class="form-control col-lg @error('name') is-invalid @enderror"
                            id="validationCustom01" value="{{ isset($_GET['name']) ? $_GET['name'] : (isset($book) ? $book[0]->name : old('name')) }}"
                            name="name" />
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row  g-3 mb-3">
                        <!--begin::Col-->
                        <label for="textArea" class="form-label col-lg-2">Description</label>
                        <textarea class="form-control col-lg @error('description') is-invalid @enderror" id="textArea" rows="3"
                            name="description">{{ isset($_GET['description']) ? $_GET['description'] : (isset($book) ? $book[0]->description :  old('description')) }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <div class="row align-items-center g-3">
                        <!--begin::Col-->
                        <label for="validationCustom04" class="form-label col-lg-2">Category</label>
                        <select id="mySelect" class="form-select col-lg @error('category') is-invalid @enderror"
                            id="validationCustom04" name="category">
                            @foreach ($categories as $item)
                                <option {{ $sub_categories[0]->category_id == $item['id'] ? 'selected' : '' }}
                                    value="{{ $item['id'] }}" data-link="{{ isset($book) ? route('books.edit_book', ['category' => $item['id'], 'id' => $book[0]->id ]) : route('books.create_book', $item['id']) }}">
                                    {{ $item['name'] }}
                                </option>
                            @endforeach
                        </select>
                        <select class="form-select col-lg @error('sub_category_id') is-invalid @enderror" id="validationCustom04"
                            name="sub_category_id">
                            @foreach ($sub_categories as $item)
                                <option value="{{ $item['id'] }}" {{isset($book) && ($book[0]->sub_category_id == $item['id']) ? 'selected': '' }}>{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                        @error('sub_category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <!--end::Col-->
                    </div>
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">
                        {{ isset($book) ? 'Save' : 'Add' }}
                    </button>
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>

    <script>
        document.getElementById('mySelect').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var link = selectedOption.getAttribute('data-link');
            var descriptionValue = document.getElementById('textArea').value;
            var nameValue = document.getElementById('validationCustom01').value;
            link += '?description=' + encodeURIComponent(descriptionValue) + '&name=' + encodeURIComponent(nameValue);
            // Redirect or perform action based on the retrieved link
            window.location.href = link;
        });
    </script>
@endsection
