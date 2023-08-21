 <!-- Navbar -->
 <style>
.navbar {

    font-size: 22px;
    padding: 5px 10px;
}

/* Define what each icon button should look like */
.button {
    color: #7f7f7f;
    display: inline-block;
    /* Inline elements with width and height. TL;DR they make the icon buttons stack from left-to-right instead of top-to-bottom */
    position: relative;
    /* All 'absolute'ly positioned elements are relative to this one */
    padding: 2px 5px;
    /* Add some padding so it looks nice */
}

/* Make the badge float in the top right corner of the button */
.button__badge {
    background-color: #fa3e3e;
    border-radius: 2px;
    color: white;

    padding: 1px 3px;
    font-size: 10px;

    position: absolute;
    /* Position the badge within the relatively positioned button */
    top: 0;
    right: 0;
}
 </style>
 <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
         </li>

     </ul>
     <ul class="navbar-nav ml-auto">
         <!-- Notifications Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 
                 <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                 <!-- <i class="fa fa-users"></i> --> <span class="btn btn-primary btn-sm">Logout</span>
                 </a>

                 <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                     <?php echo csrf_field(); ?>
                 </form>
             </a>
             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                
             </div>

         </li>
     </ul>
 </nav>
 <!-- /.navbar -->


