<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Journal</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url('assets/img/favicon.png'); ?>" rel="icon">
  <link href="<?= base_url('assets/img/apple-touch-icon.png'); ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/quill/quill.snow.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/quill/quill.bubble.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/remixicon/remixicon.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/simple-datatables/style.css'); ?>" rel="stylesheet">
  <script src="https://cdn.ckeditor.com/4.22.1/basic/ckeditor.js"></script>

  <link href="<?= base_url('assets/css/component-chosen.min.css'); ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="<?= base_url('assets/img/logo.png'); ?>" alt="">
        <span class="d-none d-lg-block">&nbsp;&nbsp;Journal</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <!-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div> -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <!-- <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li> -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?php echo site_url(); ?>assets/images/users/<?php echo $this->session->userdata('profile_pic'); ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $this->session->userdata('complete_name')?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $this->session->userdata('complete_name')?></h6>
              <span>
                <?php if ($this->session->userdata('role') == 1):?>
                  Admin
                <?php elseif ($this->session->userdata('role') == 2):?>
                  Author
                <?php else:?>
                  Contributor
                <?php endif;?>
              </span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= base_url('logout')?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <?php if ($this->session->userdata('role') == 1) : ?>
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(2) == '') ? '' : 'collapsed' ?>" href="<?= base_url('admin') ?>">
            <i class="bi bi-person"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (($this->uri->segment(2) == 'users') || ($this->uri->segment(2) == 'edit-user') || ($this->uri->segment(2) == 'user-detail') || ($this->uri->segment(2) == 'add-user')) ? '' : 'collapsed' ?>" href="<?= base_url('admin/users') ?>">
            <i class="bi bi-person"></i>
            <span>Users</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= (($this->uri->segment(2) == 'authors') || ($this->uri->segment(2) == 'edit-author')) || ($this->uri->segment(2) == 'author-detail') || ($this->uri->segment(2) == 'add-author') ? '' : 'collapsed' ?>" href="<?= base_url('admin/authors') ?>">
            <i class="bi bi-people"></i>
            <span>Authors</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= (($this->uri->segment(2) == 'articles') || ($this->uri->segment(2) == 'edit-article') || ($this->uri->segment(2) == 'article-detail') || ($this->uri->segment(2) == 'add-article') ) ? '' : 'collapsed' ?>" href="<?= base_url('admin/articles') ?>">
            <i class="bi bi-book"></i>
            <span>Articles</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (($this->uri->segment(2) == 'volumes') || ($this->uri->segment(2) == 'add-volume') || ($this->uri->segment(2) == 'edit-volume') ) ? '' : 'collapsed' ?>" href="<?= base_url('admin/volumes') ?>">
            <i class="bi bi-journal-bookmark"></i>
            <span>Volumes</span>
          </a>
        </li>
      <?php endif; ?>

    </ul>
  </aside>