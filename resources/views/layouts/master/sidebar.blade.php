<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Rocker</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @hasanyrole('super-admin|admin')
            <li>
                <a href="/home">
                    <div class="parent-icon"><i class='bx bx-home-alt'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
        @endhasanyrole

        @canany(['view category', 'add category'])
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Categories</div>
                </a>
                <ul>
                    <li> <a href="{{ route('category') }}"><i class='bx bx-radio-circle'></i>View Categories</a>
                    </li>
                    <li> <a href="{{ route('category.create') }}"><i class='bx bx-radio-circle'></i>Add Category</a>
                    </li>

                </ul>
            </li>
        @endcanany


        @canany(['view brand', 'add brand'])
            <li>

                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Brands</div>
                </a>
                <ul>
                    <li> <a href="{{ route('brand') }}"><i class='bx bx-radio-circle'></i>View Brands</a>
                    </li>
                    <li> <a href="{{ route('brand.create') }}"><i class='bx bx-radio-circle'></i>Add Brand </a>
                    </li>

                </ul>
            </li>
        @endcanany


        @canany(['view product', 'add product'])
            <li>

                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Products</div>
                </a>
                <ul>
                    <li> <a href="{{ route('product') }}"><i class='bx bx-radio-circle'></i>View Products</a>
                    </li>
                    <li> <a href="{{ route('product.create') }}"><i class='bx bx-radio-circle'></i>Add Product</a>
                    </li>

                </ul>
            </li>
        @endcanany


       @can('view order')
           
       <li>
           
           <a href="javascript:;" class="has-arrow">
               <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Orders</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('orders') }}"><i class='bx bx-radio-circle'></i>View Orders</a>
                </li>
            </ul>
        </li>

        @endcan
        
        @can('view permission')
            
        <li>
            
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i></div>
                <div class="menu-title">Permissions</div>
            </a>
            <ul>
                <li><a href="/permissions"><i class='bx bx-radio-circle'></i>View Permissions</a></li>
            </ul>
        </li>
        @endcan

    {{-- Roles Section --}}
   @can('view role')
       
   <li>
       <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i></div>
                <div class="menu-title">Roles</div>
            </a>
            <ul>
                <li><a href="/roles"><i class='bx bx-radio-circle'></i>View Roles</a></li>
            </ul>
        </li>
        @endcan
        

    {{-- Users Section --}}
    @can('view user')
        
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i></div>
                <div class="menu-title">Users</div>
            </a>
            <ul>
                <li><a href="/users"><i class='bx bx-radio-circle'></i>View Users</a></li>
            </ul>
        </li>
            @endcan
   
</ul>
<!--end navigation-->
</div>
