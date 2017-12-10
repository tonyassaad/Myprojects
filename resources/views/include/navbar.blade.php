<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">        
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a   class="dropdown-toggle" href="">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Account First Name</strong>
                            </span> </span> </a>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <!--TODO create seperate template START--->
            <li class="">
                <a href="{{URL('/domain/')}}"><i class="fa fa-table"></i> <span class="nav-label"> Create domain </span></a>
            </li>
     <li class=" ">
                <a href="{{URL('/page/')}}"><i class="fa fa-table"></i> <span class="nav-label"> Create Page </span></a>
            </li>
          <li class=" ">
                <a href="{{URL('/domain/list')}}"><i class="fa fa-table"></i> <span class="nav-label"> List Domain</span></a>
            </li>
        </ul>

    </div>
</nav>

