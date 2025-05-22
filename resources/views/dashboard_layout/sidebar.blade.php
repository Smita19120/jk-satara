<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="{{ route('admin.dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#branch-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-diagram-3"></i><span>Manage Branches</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="branch-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('branch.index') }}">
            <i class="bi bi-circle"></i><span>Branches</span>
          </a>
        </li>
        <li>
          <a href="{{ route('sub_branch.index') }}">
            <i class="bi bi-circle"></i><span>Sub Branches</span>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#website-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Manage Website</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="website-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('admin.add_slider') }}">
            <i class="bi bi-circle"></i><span>Add Slider</span>
          </a>  
        </li>
      </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#trainer-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-people"></i><span>Manage Trainers</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="trainer-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('admin.trainer.list') }}">
            <i class="bi bi-circle"></i><span>Trainer List</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.trainer.add') }}">
            <i class="bi bi-circle"></i><span>Add Trainer</span>
          </a>
        </li>
      </ul>
    </li>

    <!-- New Gallery Section -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#gallery-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-images"></i><span>Manage Gallery</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="gallery-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('admin.gallery.index') }}">
            <i class="bi bi-circle"></i><span>Gallery Items</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.gallery.create') }}">
            <i class="bi bi-circle"></i><span>Add Gallery Item</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End Gallery Section -->

  </ul>

</aside>
<!-- End Sidebar-->