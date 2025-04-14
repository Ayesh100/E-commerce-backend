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
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
      
        <div class="card">
          <div class="card-body p-4">
              <h5 class="card-title">Add New Category</h5>
              <hr/>
              <form action="{{route('category.store')}}" method="POST">
                @csrf
               <div class="form-body mt-4">
                <div class="row">
                   <div class="col-lg-8">
                   <div class="border border-3 p-4 rounded">
                    <div class="mb-3">
                        <label for="cat_name" class="form-label">Category Name</label>
                        <input type="text" name="cat_name" value="{{old('cat_name')}}" class="form-control @error('cat_name') is-invalid @enderror " id="cat_name" placeholder="Enter Category Name">
                        <span class="text-danger">{{$errors->first('cat_name')}}</span>
                      </div>    
                      <div class="mb-3">
                        <label for="cat_slug" class="form-label">Category Slug</label>
                        <input type="text" name="cat_slug" value="{{old('cat_slug')}}" class="form-control @error('cat_slug') is-invalid @enderror" id="cat_slug" placeholder="Enter Category Slug">
                        <span class="text-danger">{{$errors->first('cat_slug')}}</span>

                      </div>
                      <div class="mb-3">
                        <label for="cat_dscp" class="form-label">Category Description</label>
                        <textarea class="form-control @error('cat_dscp') is-invalid @enderror" id="cat_dscp" name="cat_dscp" rows="3">{{old('cat_dscp')}}</textarea>
                        <span class="text-danger">{{$errors->first('cat_dscp')}}</span>

                      </div>
                      <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Save Category</button>
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