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
                            <li class="breadcrumb-item active" aria-current="page">Products</li>
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
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                            <a class="dropdown-item" href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:;">Separated link</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Add New Product</h5>
                    <hr />
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body mt-4">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Select Category</label>
                                            <select name="category_id" id="category_id"
                                                class="form-select @error('category_id') is-invalid @enderror">
                                                <option value="">Choose Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="brand_id" class="form-label">Select Brand</label>
                                            <select name="brand_id" id="brand_id"
                                                class="form-select @error('brand_id') is-invalid @enderror" disabled>
                                                <option value="" >Choose Brand</option>
                                            </select>
                                            <small class="text-muted">Please select a category to enable brand selection.</small>
                                            <span class="text-danger">{{ $errors->first('brand_id') }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="product_name" class="form-label">Product Name</label>
                                            <input type="text"
                                                value="{{ old('product_name') }}"
                                                class="form-control @error('product_name') is-invalid @enderror"
                                                name="product_name" id="product_name" placeholder="Enter product name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="product_img" class="form-label">Product Image</label>
                                            <input id="product_img" name="product_img" type="file"
                                                class="form-control @error('product_img') is-invalid @enderror">
                                            <span class="text-danger">{{ $errors->first('product_img') }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="product_dscp" class="form-label">Product Description</label>
                                            <textarea class="form-control @error('product_dscp') is-invalid @enderror" name="product_dscp" id="product_dscp"
                                                rows="3">{{ old('product_dscp') }}</textarea>
                                            <span class="text-danger">{{ $errors->first('product_dscp') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="mb-3">
                                                <label for="product_slug" class="form-label">Product Slug</label>
                                                <input type="text" value="{{ old('product_slug') }}"
                                                    class="form-control @error('product_slug') is-invalid @enderror"
                                                    name="product_slug" id="product_slug" placeholder="Enter product slug">
                                                <span class="text-danger">{{ $errors->first('product_slug') }}</span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="product_price" class="form-label">Product Price</label>
                                                <input type="number" value="{{ old('product_price') }}"
                                                    class="form-control @error('product_price') is-invalid @enderror"
                                                    name="product_price" id="product_price"
                                                    placeholder="Enter product price">
                                                <span class="text-danger">{{ $errors->first('product_price') }}</span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="product_qty" class="form-label">Product Quantity</label>
                                                <input type="number" value="{{ old('product_qty') }}"
                                                    class="form-control @error('product_qty') is-invalid @enderror"
                                                    name="product_qty" id="product_qty"
                                                    placeholder="Enter product quantity">
                                                <span class="text-danger">{{ $errors->first('product_qty') }}</span>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Save Product</button>
                                                </div>
                                            </div>
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

    <script>
       $(document).ready(function () {
    const oldBrandId = "{{ old('brand_id') }}"; // Retrieve the old selected brand ID

    $('#category_id').on('change', function () {
        const categoryId = $(this).val();

        if (categoryId) {
            // AJAX call to fetch brands based on selected category
            $.ajax({
                url: "{{ url('/api/product') }}/" + categoryId, // Adjust URL as needed
                type: "GET",
                success: function (data) {
                    // Clear and enable the brand dropdown
                    $('#brand_id').empty().append('<option value="">Select Brand</option>');
                    $('#brand_id').prop('disabled', false);  // Ensure it's enabled

                    // Populate the brand dropdown with fetched brands
                    $.each(data.brands, function (index, brand) {
                        $('#brand_id').append('<option value="' + brand.id + '"' + (oldBrandId == brand.id ? ' selected' : '') + '>' + brand.brand_name + '</option>');
                    });
                },
                error: function () {
                    // Optionally handle error if brands couldn't be fetched
                    alert('Error fetching brands for the selected category.');
                }
            });
        } else {
            // Reset and disable the brand dropdown if no category is selected
            $('#brand_id').empty().append('<option value="">Select Brand</option>');
            $('#brand_id').prop('disabled', true); // Disable if no category is selected
        }
    });

    // Trigger change event on page load to populate brands for the old category
    if ("{{ old('category_id') }}") {
        $('#category_id').val("{{ old('category_id') }}").trigger('change');
    }
});

    </script>

    <!--end page wrapper -->
@endsection
