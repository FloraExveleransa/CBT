<?php 
  $uri = service('uri');

  ?>
<style>
  #logo-image {
    width: 50px;
    height: auto;
  }

  .app-brand.demo {
    display: flex;
    justify-content: ;
    align-items: right;
    height: 100%; /* Ensure it takes the full height of the menu */
  }
  body {
      margin: 0;
      font-family: "Times New Roman", Times, serif;
      color: #000; /* Set text color to black */
    }

    .main {
      position: relative;
      width: 100%;
      height: auto;
      overflow: hidden;
    }

    .col-md-12 {
      position: relative;
      width: 200%;
      height: auto;
      display: flex;
      animation: slideImages 10s linear infinite; /* Change duration to 20s */
      transition: transform 0.01s ease; /* Smooth transition */
    }

    .col-md-12 img {
      width: 50%;
      max-height: 700px;
      margin-top: 50px;
      user-select: none; /* Prevent images from being selected */
      pointer-events: none; /* Disable pointer events on images */
    }

    
    
  
</style>

  </style>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
  
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
        <h4><?= $satu->nama_Logo ?></h4>

  </a>

  <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
    <i class="bx bx-chevron-left bx-sm align-middle"></i>
  </a>
</div>


<div class="menu-inner-shadow"></div>

<ul class="menu-inner py-1">
  <!-- Dashboard -->
  
  <li class="menu-item <?php if($uri->getSegment(2) == "Site"){echo "active";}?> <?php if($uri->getSegment(2) == "PagePelajaran"){echo "active";}?><?php if($uri->getSegment(2) == "PageUjian"){echo "active";}?>">
    <a href="<?= base_url("Home/Site") ?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-home-circle"></i>
      <div data-i18n="Analytics">Dashboard</div>
    </a>
</li>


  <!-- Layouts -->
  <li class="menu-item">
  
   
   <?php
 $userLevel = session()->get('Level');
 $allowedLevels = ['admin'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
    <li class="menu-item <?php if($uri->getSegment(2) == "admin"){echo "active";}?><?php if($uri->getSegment(2) == "guru"){echo "active";}?> <?php if($uri->getSegment(2) == "Siswa"){echo "active";}?> <?php if($uri->getSegment(2) == "t_user"){echo "active";}?>">
  <a href="<?= base_url("Home/admin")?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-user
"></i>

      <div data-i18n="Layouts">User </div>
    </a>
    </li>
    <?php } ?>
    
    <li class="menu-item <?php if($uri->getSegment(2) == "calender"){echo "active";}?>">
    <a href="<?= base_url("Home/calender") ?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-calendar"></i>
      <div data-i18n="Analytics">calender</div>
    </a>
</li>
<?php
 $userLevel = session()->get('Level');
 $allowedLevels = ['admin'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
     <li class="menu-item <?php if($uri->getSegment(2) == "activity_log"){echo "active";}?>">
  <a href="<?= base_url("Home/activity_log")?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-notepad"></i>
      <div data-i18n="Layouts">Activity Log</div>
    </a>
    </li>
    <?php } ?>
    <?php
 $userLevel = session()->get('Level');
 $allowedLevels = ['admin'];

 if (in_array($userLevel, $allowedLevels)) {
?> 
    <li class="menu-item <?php if($uri->getSegment(2) == "setting"){echo "active";}?> ">
  <a href="<?= base_url("home/setting/1")?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-cog
"></i>

      <div data-i18n="Layouts">Setting</div>
    </a>
    </li>
    <?php } ?>
    <li class="menu-item">
  <a href="<?= base_url("home/logout")?>" class="menu-link">
      <i class="menu-icon tf-icons bx bx-log-in-circle"></i>
      <div data-i18n="Layouts">Log out</div>
    </a>
    </li>
</ul>
</aside>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
            
              <ul class="navbar-nav flex-row align-items-center ms-auto">


               
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->