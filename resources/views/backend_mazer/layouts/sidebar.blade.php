 <div id="sidebar" class="active">
     <div class="sidebar-wrapper active">
         <div class="sidebar-header">
             <div class="d-flex justify-content-between">
                 <div class="logo">
                     <a href="index.html"><img src="{{ asset('backend_mazer/images/logo/logo.png') }}" alt="Logo"
                             srcset=""></a>
                 </div>
                 <div class="toggler">
                     <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                 </div>
             </div>
         </div>
         <div class="sidebar-menu">
             <ul class="menu">
                 <li class="sidebar-title">Menu</li>

                 <li class="sidebar-item {{ Route::currentRouteNamed('admin.dashboard') ? 'active' : '' }}">
                     <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                         <i class="bi bi-grid-fill"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>

                 {{-- active --}}
                 <li class="sidebar-item {{ Route::currentRouteNamed('admin.inventory.table') ? 'active' : '' }}">
                     <a href="{{ route('admin.inventory.table') }}" class='sidebar-link'>
                         <i class="bi bi-grid-fill"></i>
                         <span>Inventory</span>
                     </a>
                 </li>

                 {{-- <li class="sidebar-item  has-sub">
                     <a href="#" class='sidebar-link'>
                         <i class="bi bi-stack"></i>
                         <span>Components</span>
                     </a>
                     <ul class="submenu ">
                         <li class="submenu-item ">
                             <a href="component-alert.html">Alert</a>
                         </li>
                         <li class="submenu-item ">
                             <a href="component-badge.html">Badge</a>
                         </li>
                     </ul>
                 </li> --}}

                 <li class="sidebar-item">
                     <form action="{{ route('logout') }}" method="POST">
                         @csrf
                         <button type="submit" class="sidebar-link" style="border: 0pt;">
                             <i class="bi bi-box-arrow-left"></i>
                             <span>Logout</span>
                         </button>
                     </form>
                 </li>
             </ul>
         </div>
         <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
     </div>
 </div>
