<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1"
     m-menu-scrollable="1" m-menu-dropdown-timeout="500">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <li class="m-menu__item " aria-haspopup="true">
            <a href="{{ route('admin.index') }}" class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-line-graph"></i>
                <span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">Dashboard</span>
										</span>
									</span>
            </a>
        </li>

        <!-- Ngôn ngữ -->
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon fa fa-language"></i>
                <span class="m-menu__link-text">Ngôn ngữ</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ route('admin.languages.index') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Danh sách</span>
                        </a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ route('admin.languages.create') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Thêm</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Khách sạn -->
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon fa fa-building"></i>
                <span class="m-menu__link-text">Khách sạn</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <!-- Cơ sở-->
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="javascript:;" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Cơ sở</span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="m-menu__submenu ">
                            <span class="m-menu__arrow"></span>
                            <ul class="m-menu__subnav">
                                <li class="m-menu__item " aria-haspopup="true">
                                    <a href="{{ route('admin.locations.index') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Danh sách</span>
                                    </a>
                                </li>
                                <li class="m-menu__item " aria-haspopup="true">
                                    <a href="{{ route('admin.locations.create') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Thêm</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Phòng -->
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="javascript:;" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Phòng</span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="m-menu__submenu ">
                            <span class="m-menu__arrow"></span>
                            <ul class="m-menu__subnav">
                                @foreach ($sidebar_locations as $location)
                                    <li class="m-menu__item" aria-haspopup="true">
                                        <a href="{{ route('admin.rooms.index', $location->id) }}" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot  ">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">{{ $location->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    <!-- Tên phòng -->
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="{{ route('admin.roomNames.index') }}" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Hạng phòng</span>
                        </a>
                    </li>

                    <!-- Dịch vụ -->
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="javascript:;" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Dịch vụ</span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="m-menu__submenu ">
                            <span class="m-menu__arrow"></span>
                            <ul class="m-menu__subnav">
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.services.categories.index') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot  ">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Danh mục</span>
                                    </a>
                                </li>
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.units.index') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot  ">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Đơn vị</span>
                                    </a>
                                </li>
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.services.index') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot  ">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Danh sách</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Tiện nghi -->
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="{{ route('admin.properties.index') }}" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Tiện nghi</span>
                        </a>
                    </li>

                    <!-- Đánh giá -->
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="{{ route('admin.comments.index') }}" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Đánh giá</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Bài viết -->
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon fa fa-book-open"></i>
                <span class="m-menu__link-text">Bài viết</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <!-- Danh mục-->
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="javascript:;" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Danh mục</span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="m-menu__submenu ">
                            <span class="m-menu__arrow"></span>
                            <ul class="m-menu__subnav">
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.category.postView') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Thêm</span>
                                    </a>
                                </li>
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.category.list') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Danh sách</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Bài viết-->
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="javascript:;" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Bài viết</span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="m-menu__submenu ">
                            <span class="m-menu__arrow"></span>
                            <ul class="m-menu__subnav">
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.post.addView') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Thêm</span>
                                    </a>
                                </li>
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.post.list') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Danh sách</span>
                                    </a>
                                </li>

                                @if(Auth::user()->role_id <= config('common.roles.admin'))
                                    <li class="m-menu__item" aria-haspopup="true">
                                        <a href="{{ route('admin.post.approveList') }}" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Duyệt bài viết</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Hóa đơn -->
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon fa fa-money-bill"></i>
                <span class="m-menu__link-text">Hóa đơn</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <!-- Phòng-->
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="javascript:;" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Hóa đơn phòng</span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="m-menu__submenu ">
                            <span class="m-menu__arrow"></span>
                            <ul class="m-menu__subnav">
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.invoices.create') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Thêm</span>
                                    </a>
                                </li>
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.invoices.index') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Danh sách</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Thu chi-->
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="javascript:;" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Thu chi</span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="m-menu__submenu ">
                            <span class="m-menu__arrow"></span>
                            <ul class="m-menu__subnav">
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.bill.postView') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Thêm</span>
                                    </a>
                                </li>
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.bill.list') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
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
        </li>

        <!-- Người dùng -->
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon fa fa-users"></i>
                <span class="m-menu__link-text">Người dùng</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <!-- Người dùng -->
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="javascript:;" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Nguời dùng</span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="m-menu__submenu ">
                            <span class="m-menu__arrow"></span>
                            <ul class="m-menu__subnav">
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.users.create') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Thêm</span>
                                    </a>
                                </li>
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.users.index') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Danh sách</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Quyền -->
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="javascript:;" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Quyền</span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="m-menu__submenu ">
                            <span class="m-menu__arrow"></span>
                            <ul class="m-menu__subnav">
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.roles.create') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Thêm</span>
                                    </a>
                                </li>
                                <li class="m-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.roles.index') }}" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">Danh sách</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Liên hệ -->

                    <li class="m-menu__item" aria-haspopup="true">
                        <a href="{{ route('admin.contact.index') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Liên hệ</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Cấu hình -->
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon fa fa-cogs"></i>
                <span class="m-menu__link-text">Cấu hình</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <!-- Cơ bản -->
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="{{ route('admin.settings.edit') }}" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Cơ bản</span>
                        </a>
                    </li>

                    <!-- Modules -->
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="{{ route('admin.routes.index') }}" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">Modules</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- Chat -->
        <li class="m-menu__item " aria-haspopup="true">
            <a href="{{ route('admin.chat.index', 'room') }}" class="m-menu__link ">
                <i class="m-menu__link-icon fa fa-comment"></i>
                <span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">Chat</span>
										</span>
									</span>
            </a>
        </li>
    </ul>
</div>
