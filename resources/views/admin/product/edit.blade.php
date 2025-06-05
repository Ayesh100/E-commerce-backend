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
                    <h5 class="card-title">Edit Product</h5>
                    <hr />
                    <form action="/admin/product/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-body mt-4">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        {{-- Category dropdown --}}
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Select Category</label>
                                            <select name="category_id" id="category_id"
                                                class="form-select @error('category_id') is-invalid @enderror">
                                                <option value="">Choose Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                        </div>

                                        {{-- Brand dropdown (initially enabled if product already has a category) --}}
                                        <div class="mb-3">
                                            <label for="brand_id" class="form-label">Select Brand</label>
                                            <select name="brand_id" id="brand_id"
                                                class="form-select @error('brand_id') is-invalid @enderror"
                                                {{ old('category_id', $product->category_id) ? '' : 'disabled' }}>
                                                <option value="">Choose Brand</option>
                                            </select>
                                            <small class="text-muted">Please select a category to enable brand
                                                selection.</small>
                                            <span class="text-danger">{{ $errors->first('brand_id') }}</span>
                                        </div>

                                        {{-- Other product fields --}}
                                        <div class="mb-3">
                                            <label for="product_name" class="form-label">Product Name</label>
                                            <input type="text" value="{{ old('product_name', $product->product_name) }}"
                                                class="form-control @error('product_name') is-invalid @enderror"
                                                name="product_name" id="product_name" placeholder="Enter product name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="product_img" class="form-label">Product Image</label>
                                            <input id="product_img" name="product_img" type="file"
                                                class="form-control @error('product_img') is-invalid @enderror">
                                            <span class="text-danger">{{ $errors->first('product_img') }}</span>
                                            <p class="mt-3 text-success">Current Logo</p>
                                            <img src="/uploads/{{ $product->product_img }}" width="100" height="100"
                                                alt="Current product image">
                                        </div>
                                        <div class="mb-3">
                                            <label for="product_dscp" class="form-label">Product Description</label>
                                            <textarea class="form-control @error('product_dscp') is-invalid @enderror" name="product_dscp" id="product_dscp"
                                                rows="3">{{ old('product_dscp', $product->product_dscp) }}</textarea>
                                            <span class="text-danger">{{ $errors->first('product_dscp') }}</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Right column --}}
                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="mb-3">
                                                <label for="product_slug" class="form-label">Product Slug</label>
                                                <input type="text"
                                                    value="{{ old('product_slug', $product->product_slug) }}"
                                                    class="form-control @error('product_slug') is-invalid @enderror"
                                                    name="product_slug" id="product_slug" placeholder="Enter product slug">
                                                <span class="text-danger">{{ $errors->first('product_slug') }}</span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="product_price" class="form-label">Product Price</label>
                                                <input type="number"
                                                    value="{{ old('product_price', $product->product_price) }}"
                                                    class="form-control @error('product_price') is-invalid @enderror"
                                                    name="product_price" id="product_price"
                                                    placeholder="Enter product price">
                                                <span class="text-danger">{{ $errors->first('product_price') }}</span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="product_qty" class="form-label">Product Quantity</label>
                                                <input type="number"
                                                    value="{{ old('product_qty', $product->product_qty) }}"
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
        $(document).ready(function() {
            // Retrieve old (or current) category and brand IDs
            const oldCategoryId = "{{ old('category_id', $product->category_id) }}";
            const oldBrandId = "{{ old('brand_id', $product->brand_id) }}";

            function loadBrands(categoryId, selectedBrandId = null) {
                if (categoryId) {
                    $.ajax({
                        url: `/api/category/${categoryId}/brands`, // ← correct endpoint
                        type: "GET",
                        success: function(data) {
                            // 'data' is an array of brand objects, not { brands: [...] }
                            $('#brand_id').empty().append('<option value="">Select Brand</option>');
                            $('#brand_id').prop('disabled', false);

                            // Iterate over 'data' directly
                            $.each(data, function(index, brand) {
                                $('#brand_id').append(
                                    `<option value="${brand.id}" ${selectedBrandId == brand.id ? 'selected' : ''}>
                                        ${brand.brand_name}
                                    </option>`
                                );
                            });
                        },
                        error: function() {
                            console.error('Could not fetch brands for category', categoryId);
                            $('#brand_id').empty().append('<option value="">Select Brand</option>').prop('disabled', true);
                        }
                    });
                } else {
                    // No category selected → reset and disable brand dropdown
                    $('#brand_id').empty().append('<option value="">Select Brand</option>');
                    $('#brand_id').prop('disabled', true);
                }
            }

            // 1) On page load, if a category is already selected (edit scenario), load its brands:
            if (oldCategoryId) {
                $('#category_id').val(oldCategoryId); // ensure the category <select> is set
                loadBrands(oldCategoryId, oldBrandId);
            }

            // 2) When the user changes category, reload the brand list:
            $('#category_id').on('change', function() {
                loadBrands($(this).val());
            });
        });
    </script>

    <!--end page wrapper -->
@endsection
