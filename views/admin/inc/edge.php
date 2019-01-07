
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="/admin/about"><img src="/assets/images/icon/hlogo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                        <?php if(isset($title)&&($title=="About"||$title=="Personalinfo")):?>
                          <li class="active">
                        <?php else:?>
                          <li>
                        <?php endif;?>
                            <a href="#" aria-expanded="true">about</a>
                              <ul class="collapse">
                                <?php if(isset($subtitle)&&$subtitle=="about"):?>
                                <li class="active">
                                <?php else:?>
                                <li>
                                <?php endif; ?>
                                  <a href="/admin/about">about</a>
                                </li>
                                <?php if(isset($subtitle)&&$subtitle=="personalinfo"):?>
                                <li class="active">
                                <?php else:?>
                                <li>
                                <?php endif;?>
                                  <a href="/admin/personalinfo">Personal info</a>
                                </li>
                              </ul>

                        <?php if(isset($title)&&$title=="Skill"):?>
                          <li class="active">
                        <?php else:?>
                          <li>
                        <?php endif; ?>
                            <a href="/admin/skill" aria-expanded="true"><i class="fa fa-book"></i><span>skill</span></a>
                          </li>

                        <?php if(isset($title)&&$title=="Portfolio"):?>
                          <li class="active">
                        <?php else:  ?>
                          <li>
                        <?php endif;?>
                            <a href="/admin/portfolio" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Portfolio</span></a>
                          </li>


                        <?php if(isset($title)&&$title=="Q&A"):?>
                          <li class="active">
                        <?php else:?>
                          <li>
                        <?php endif;?>
                            <a href="/admin/qanda" aria-expanded="true"><i class="fa fa-question"></i><span>Q&A</span></a>
                          </li>
                        </ul>

                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>



                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left"><?php echo $title;?></h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span><?php echo $title;?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="/assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('id'); ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/admin/logout">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
        <!-- main content area end -->
        <!-- footer area start-->
