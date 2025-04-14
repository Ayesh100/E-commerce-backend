@extends('layouts.master.body')
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">eCommerce</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Brands</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                        <button type="button"
                            class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                                href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                                link</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Add New Brand</h5>
                    <hr />
                    <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body mt-4">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Select Category</label>
                                            <div class="row border border-3 p-2 rounded">
                                                @foreach ($categories as $category)
                                                    <div class="form-check col-md-4">
                                                        <input type="checkbox" class="form-check-input @error('category_ids') is-invalid @enderror"
                                                            name="category_ids[]" value="{{ $category->id }}" 
                                                            {{ is_array(old('category_ids')) && in_array($category->id, old('category_ids')) ? 'checked' : '' }}>
                                                        <label
                                                            class="form-check-label">{{ $category->category_name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <span class="text-danger">{{ $errors->first('category_ids') }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="brand_name" class="form-label">Brand Name</label>
                                            <input id="brand_name" value="{{ old('brand_name') }}" name="brand_name"
                                                type="text"
                                                class="form-control @error('brand_name') is-invalid @enderror"
                                                placeholder="Enter Brand Name">
                                            <span class="text-danger">{{ $errors->first('brand_name') }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="brand_slug" class="form-label">Brand Slug</label>
                                            <input id="brand_slug" value="{{ old('brand_slug') }}" name="brand_slug"
                                                type="text"
                                                class="form-control @error('brand_slug') is-invalid @enderror"
                                                placeholder="Enter Brand Slug">
                                            <span class="text-danger">{{ $errors->first('brand_slug') }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="brand_logo" class="form-label">Brand Logo</label>
                                            <input id="brand_logo" name="brand_logo" type="file"
                                                class="form-control @error('brand_logo') is-invalid @enderror">
                                            <span class="text-danger">{{ $errors->first('brand_logo') }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100" type="submit">Save Brand</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end row-->
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    <!--end page wrapper -->
@endsection
