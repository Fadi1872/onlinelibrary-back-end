@extends('layouts.master')

@section('title')
    Sub Categories
@endsection

@section('navone')
    Sub Categories
@endsection

@section('navtwo')
    {{ isset($category) ? 'edit' : 'add' }}
@endsection

@section('content')
    @if (isset($error))
        <div class="alert alert-warning">hello{{ $error }}</div>
    @endif
    <div class="col-md-12">
        <div class="card card-primary card-outline mb-4">
            <!--begin::Form-->
            <form method="POST"
                action="{{ isset($category) ? route('subcategories.update', $category[0]->id) : route('subcategories.store') }}">
                <!--begin::Body-->
                @csrf
                @if (isset($category))
                    @method('put')
                @endif
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row align-items-center g-3 mb-3">
                        <!--begin::Col-->
                        <label for="validationCustom01" class="form-label col-lg-2">SubCategory Name</label>
                        <input type="text" class="form-control col-lg @error('name') is-invalid @enderror"
                            id="validationCustom01" value="{{ isset($category) ? $category[0]->name : '' }}"
                            name="name" />
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <div class="row align-items-center g-3">
                        <!--begin::Col-->
                        <label for="validationCustom04" class="form-label col-lg-2">Category</label>
                        <select class="form-select col-lg @error('category') is-invalid @enderror" id="validationCustom04"
                            name="category">
                            <option {{ isset($category) ? '' : 'selected' }} disabled value="">Choose...</option>
                            @foreach ($categories as $item)
                                <option {{ isset($category) && $category[0]->category_id == $item['id'] ? 'selected' : '' }}
                                    value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <!--end::Col-->
                    </div>
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">
                        {{ isset($category) ? 'Save' : 'Add' }}
                    </button>
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
@endsection
