<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1"
     m-menu-scrollable="1" m-menu-dropdown-timeout="500">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <!-- Language -->
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon fa fa-cubes"></i>
                <span class="m-menu__link-text">Quản lý ngôn ngữ</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="{{ route('admin.languages.create') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet fa fa-plus">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Thêm</span>
                        </a>
                    </li>
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="{{ route('admin.languages.index') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet fa fa-list">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Danh sách</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Locations -->
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon fa fa-building"></i>
                <span class="m-menu__link-text">Quản lý cơ sở</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="{{ route('admin.locations.create') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet fa fa-plus">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Thêm</span>
                        </a>
                    </li>
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="{{ route('admin.locations.index') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet fa fa-list">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Danh sách</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>


        <!-- Rooms -->
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon fa fa-home"></i>
                <span class="m-menu__link-text">Quản lý phòng</span>

        <!-- Users -->
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon la la-user"></i>
                <span class="m-menu__link-text">Quản lý người dùng</span>

                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">

                    @foreach ($sidebar_locations as $location)
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.rooms.index', $location->id) }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet fa fa-plus">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">{{ $location->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>

        <!-- Properties -->
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="{{ route('admin.properties.index') }}" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon fa fa-cubes"></i>
                <span class="m-menu__link-text">Quản lý tiện nghi</span>
            </a>
        </li>

                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="{{ route('admin.users.create') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet fa fa-plus">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Thêm</span>
                        </a>
                    </li>
                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="{{ route('admin.users.index') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet fa fa-list">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Danh sách</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

    </ul>
</div>
