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
                            <li class="breadcrumb-item active" aria-current="page">Orders</li>
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
                        <form method="GET" action="{{ route('orders.search') }}">
                            <div class="position-relative">
                                <div class="input-group mb-3">
                                    <input type="text" name="search" class="form-control ps-5 radius-30"
                                        placeholder="Search by Order ID" value="{{ request('search') }}">
                                    <button class="btn btn-danger radius-30" type="submit">
                                        <i class="bx bx-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if ($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>View Complete Order</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <input class="form-check-input me-3" type="checkbox" value=""
                                                            aria-label="...">
                                                    </div>
                                                    <div class="ms-2">
                                                        <h6 class="mb-0 font-14">{{ $order->id }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>
                                                @can('update order')
                                                    <div class="d-flex justify-content-center">
                                                        <!-- Badge Display -->
                                                        <div id="status-badge-{{ $order->id }}" class="w-50 m-1">
                                                            @php
                                                                $badgeClasses = [
                                                                    'completed' => 'text-success bg-light-success',
                                                                    'pending' => 'text-warning bg-light-warning',
                                                                    'processing' => 'text-primary bg-light-primary',
                                                                    'cancelled' => 'text-danger bg-light-danger',
                                                                ];
                                                                $statusClass =
                                                                    $badgeClasses[$order->status] ??
                                                                    'text-secondary bg-light';
                                                            @endphp
                                                            <div class="{{ $statusClass }} p-2">
                                                                <i class='bx bxs-circle me-1'></i>{{ ucfirst($order->status) }}
                                                            </div>
                                                        </div>

                                                        <!-- Status Dropdown -->
                                                        <select style="font-size: 13px"
                                                            class="form-select m-1 w-50 status-select"
                                                            data-order-id="{{ $order->id }}">
                                                            <option value="pending"
                                                                {{ $order->status == 'pending' ? 'selected' : '' }}>🟡 Pending
                                                            </option>
                                                            <option value="processing"
                                                                {{ $order->status == 'processing' ? 'selected' : '' }}>🔵
                                                                Processing</option>
                                                            <option value="completed"
                                                                {{ $order->status == 'completed' ? 'selected' : '' }}>🟢
                                                                Completed</option>
                                                            <option value="cancelled"
                                                                {{ $order->status == 'cancelled' ? 'selected' : '' }}>🔴
                                                                Cancelled</option>
                                                        </select>
                                                    </div>
                                                @else
                                                    <!-- Only the badge (no flex) -->
                                                    @php
                                                        $badgeClasses = [
                                                            'completed' => 'text-success bg-light-success',
                                                            'pending' => 'text-warning bg-light-warning',
                                                            'processing' => 'text-primary bg-light-primary',
                                                            'cancelled' => 'text-danger bg-light-danger',
                                                        ];
                                                        $statusClass =
                                                            $badgeClasses[$order->status] ?? 'text-secondary bg-light';
                                                    @endphp
                                                    <div id="status-badge-{{ $order->id }}">
                                                        <div class="{{ $statusClass }} p-2 text-center">
                                                            <i class='bx bxs-circle me-1'></i>{{ ucfirst($order->status) }}
                                                        </div>
                                                    </div>
                                                @endcan
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary view-order-btn" data-bs-toggle="modal"
                                                    data-bs-target="#orderModal" data-order='@json($order)'>
                                                    View Complete Order
                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Order ID:</strong> <span id="modal-order-id"></span></p>
                                            <p><strong>Name:</strong> <span id="modal-order-name"></span></p>
                                            <p><strong>Email:</strong> <span id="modal-order-email"></span></p>
                                            <p><strong>Phone:</strong> <span id="modal-order-phone"></span></p>
                                            <p><strong>Address:</strong> <span id="modal-order-address"></span></p>
                                            <hr>
                                            <h6>Items</h6>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="modal-order-items">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">

                            {!! $orders->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                </div>
            @else
                <div class="alert alert-danger">No records found</div>
                @endif



            </div>


        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Attach a click event listener to all "view order" buttons
            const viewOrderButtons = document.querySelectorAll('.view-order-btn');
            viewOrderButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Get the order data from the data attribute; ensure the data is properly parsed from JSON
                    const order = JSON.parse(this.getAttribute('data-order'));
                    console.log(order);
                    // Update the modal content dynamically
                    document.getElementById('modal-order-id').textContent = order.id;
                    document.getElementById('modal-order-name').textContent = order.name;
                    document.getElementById('modal-order-email').textContent = order.email;
                    document.getElementById('modal-order-phone').textContent = order.phone;
                    document.getElementById('modal-order-address').textContent = order.address;

                    // Now update the order items list
                    const itemsContainer = document.getElementById('modal-order-items');
                    itemsContainer.innerHTML = ''; // Clear previous items

                    // Loop through the order_items array in the JSON object
                    if (order.order_items && order.order_items.length > 0) {
                        order.order_items.forEach(item => {
                            const row = document.createElement('tr');
                            // Use the related product data from the item, if available
                            const productName = item.product ? item.product.product_name :
                                'N/A';
                            row.innerHTML = `<td>${productName}</td>
                                             <td>${item.price}</td>
                                             <td>${item.quantity}</td>
                                            `;
                            itemsContainer.appendChild(row);
                        });
                    } else {
                        itemsContainer.innerHTML = '<tr><td colspan="3">No items found</td></tr>';
                    }
                });
            });
        });

        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', function() {
                const orderId = this.dataset.orderId;
                const newStatus = this.value;

                if (newStatus === 'none') return;

                fetch(`/admin/orders/${orderId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const badge = document.getElementById(`status-badge-${orderId}`);
                        let badgeHtml = '';

                        switch (newStatus) {
                            case 'completed':
                                badgeHtml =
                                    `<div class="text-success bg-light-success p-2"><i class='bx bxs-circle me-1'></i>Completed</div>`;
                                break;
                            case 'pending':
                                badgeHtml =
                                    `<div class="text-warning bg-light-warning p-2"><i class='bx bxs-circle me-1'></i>Pending</div>`;
                                break;
                            case 'processing':
                                badgeHtml =
                                    `<div class="text-primary bg-light-primary p-2"><i class='bx bxs-circle me-1'></i>Processing</div>`;
                                break;
                            case 'cancelled':
                                badgeHtml =
                                    `<div class="text-danger bg-light-danger p-2"><i class='bx bxs-circle me-1'></i>Cancelled</div>`;
                                break;
                            default:
                                badgeHtml =
                                    `<div class="text-secondary bg-light p-2"><i class='bx bxs-circle me-1'></i>None</div>`;
                        }

                        badge.innerHTML = badgeHtml;
                        alert(data.message);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to update status.');
                    });
            });
        });
    </script>

    <!--end page wrapper -->
@endsection
