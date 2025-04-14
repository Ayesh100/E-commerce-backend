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
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                        <div class="position-relative">
                            <input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span
                                class="position-absolute top-50 product-show translate-middle-y"><i
                                    class="bx bx-search"></i></span>
                        </div>
                        <div class="ms-auto"><a href="{{ route('brand.create') }}"
                                class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New
                                Brand</a></div>
                    </div>
                    @if ($brands->count() > 0)
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Logo</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <input class="form-check-input me-3" type="checkbox" value=""
                                                            aria-label="...">
                                                    </div>
                                                    <div class="ms-2">
                                                        <h6 class="mb-0 font-14">{{ $brand->id }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $brand->brand_name }}</td>
                                            <td>{{ $brand->brand_slug }}</td>
                                            <td>
                                                <img src="/uploads/{{$brand->brand_logo}}" alt="Logo" width="50" height="50">
                                            </td>
                                            @if ($brand->status == 'ACTIVE')
                                                <td>
                                                    <div
                                                        class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                                        <i class='bx bxs-circle me-1'></i>ACTIVE</div>
                                                </td>
                                            @else
                                                <td>
                                                    <div
                                                        class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                                        <i class='bx bxs-circle me-1'></i>DEACTIVE</div>
                                                </td>
                                            @endif
                                            <td>
                                                <div class="d-flex order-actions">
                                                    <a href="/admin/brand/{{ $brand->id }}/edit"><i
                                                            class='bx bxs-edit'></i></a>
                                                    <form action="/admin/brand/{{$brand->id}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button style="border: solid 1px #EEECEC;padding: 5px 9px;border-radius:7px;" type="submit" class="ms-3"><i class='bx bxs-trash'></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">

                            {!! $brands->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                </div>
            @else
                <div class="alert alert-danger">No records found</div>
                @endif


            </div>


        </div>
    </div>
    <!--end page wrapper -->
@endsection
