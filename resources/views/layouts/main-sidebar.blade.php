<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="#" class="brand-link">
      <!--begin::Brand Image-->
      <img
        src={{ asset('assets/assets/img/AdminLTELogo.png') }}
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
      />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">AdminLTE 4</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="menu"
        data-accordion="false"
      >
        <li class="nav-header">Books</li>
        {{-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-circle-fill"></i>
            <p>Level 1</p>
          </a>
        </li> --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-circle-fill"></i>
            <p>
              Books
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('books.index')}}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Show</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('books.create_book', -1)}}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Add New</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>
                  Level 2
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-record-circle-fill"></i>
                    <p>Level 3</p>
                  </a>
                </li>
              </ul>
            </li> --}}
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-circle-fill"></i>
            <p>
              Categories
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('categories.index')}}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Show</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('categories.create')}}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Add New</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-circle-fill"></i>
            <p>
              Sub Categories
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('subcategories.index')}}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Show</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('subcategories.create')}}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Add New</p>
              </a>
            </li>
          </ul>
        </li>

        {{-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-circle-fill"></i>
            <p>Level 1</p>
          </a>
        </li> --}}
      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
