
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-heading">Administrator</li>


      <li class="nav-item">
        <a class="nav-link " href="index.php" style="color: #57d8cd;">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="order-requisition.php">
          <i class="bi bi-journal-check"></i><span>Order Requisitions</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clipboard"></i><span>Purchase Requisitions</span>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
          <li class="nav-heading">Budget</li>

            <a href="budget-request.php">
              <i class="bi bi-circle"></i><span>Budget Request</span>
            </a>
          </li>

          <li>
            <li class="nav-heading">Vendor</li>
            <a href="vendor-request.php">
              <i class="bi bi-circle"></i><span>Request Vendor</span>
            </a>

            <a href="vendor.php">
              <i class="bi bi-circle"></i><span>Vendors</span>
            </a>
          </li>

          
        </ul>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#project-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clipboard"></i><span>Project</span>
        </a>
        <ul id="project-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
          <li class="nav-heading">Request</li>
            <a href="project-request.php">
              <i class="bi bi-circle"></i><span>Project Request</span>
            </a>
          </li>

          <li>
            <li class="nav-heading">Projects</li>
            <a href="project.php">
              <i class="bi bi-circle"></i><span>Projects</span>
            </a>

            <a href="vendor.php">
              <i class="bi bi-circle"></i><span>Ongoing Projects</span>
            </a>

              <a href="vendor.php">
              <i class="bi bi-circle"></i><span>Rejected Project</span>
            </a>
          </li>

          
        </ul>
      </li>
      

      <!-- warehouse -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#warehouse" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clipboard"></i><span>Warehouse</span>
        </a>
        <ul id="warehouse" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
          <li class="nav-heading">Warehousing</li>
            <a href="department-request.php">
              <i class="bi bi-circle"></i><span>Department Request</span>
            </a>

          </li>

          <!-- <li>
            <li class="nav-heading">Projects</li>
            <a href="project.php">
              <i class="bi bi-circle"></i><span>Projects</span>
            </a>

            <a href="vendor.php">
              <i class="bi bi-circle"></i><span>Ongoing Projects</span>
            </a>

              <a href="vendor.php">
              <i class="bi bi-circle"></i><span>Rejected Project</span>
            </a>
          </li> -->

          
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-bag"></i><span>Purchased Orders</span>
        </a>
      </li>

      <li class="nav-heading">ACCOUNT</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="myprofile.php">
          <i class="bi bi-person"></i><span>My Profile</span>
        </a>
      </li>
    </ul>

  </aside>
  