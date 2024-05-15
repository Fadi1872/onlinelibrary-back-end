@extends('layouts.master')

@section('title')
    Categories
@endsection

@section('navone')
    Categories
@endsection

@section('navtwo')
    {{ isset($category) ? 'edit' : 'add' }}
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card card-primary card-outline mb-4">
            <!--begin::Form-->
            <form method="POST"
                action="{{ isset($category) ? route('categories.update', $category[0]->id) : route('categories.store') }}">
                <!--begin::Body-->
                @csrf
                @if (isset($category))
                    @method('put')
                @endif
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row align-items-center g-3">
                        <!--begin::Col-->
                        <label for="validationCustom01" class="form-label col-lg-2">Category Name</label>
                        <input type="text" class="form-control col-lg @error('name') is-invalid @enderror"
                            id="validationCustom01" value="{{ isset($category) ? $category[0]->name : '' }}"
                            name="name" />
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
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
