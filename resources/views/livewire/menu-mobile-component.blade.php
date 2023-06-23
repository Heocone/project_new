{{-- <ul>
    @foreach ($category as $categoryitem)
    <li class="has-children" {{ count($categoryitem->subCategories) > 0 ? 'has-child-cate':'' }}>
        <a href="{{ route('product.category',['slug'=>$categoryitem->slug]) }}"><i class="surfsidemedia-font-dress"></i>{{ $categoryitem->name }}</a>
        <div class="dropdown-menu">
            <ul class="mega-menu d-lg-flex">
                @if (count($categoryitem->subCategories) > 0)
                <li class="mega-menu-col col-lg-7">
                    <ul class="d-lg-flex">
                        @foreach ($categoryitem->subCategories as $scategory)
                            <li class="mega-menu-col col-lg-6">
                                <ul>
                                    <li><span class="submenu-title">Hot & Trending</span></li>
                                    <li><a class="dropdown-item nav-link nav_item" href="{{ route('product.category',['slug'=>$categoryitem->slug,'scategory_slug'=>$scategory->slug]) }}">{{ $scategory->name }}</a></li>
                                </ul>
                            </li>    
                            @if ($scategory->popular == 1)
                                <li class="mega-menu-col col-lg-6">
                                    <ul>
                                        <li><span class="submenu-title">Bottoms</span></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="#">{{ $scategory->name }}</a></li>
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                @endif
            </ul>
        </div>
        @endforeach
    </li>
    
    <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Danh mục</a>
        @foreach ($category as $categoryitem)
        <ul class="dropdown">
            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('product.category',['slug'=>$categoryitem->slug]) }}">{{ $categoryitem->name }}</a>
                @if (count($categoryitem->subCategories) > 0)
                    <ul class="dropdown">
                        @foreach ($categoryitem->subCategories as $scategory)
                        <li><a href="{{ route('product.category',['slug'=>$categoryitem->slug,'scategory_slug'=>$scategory->slug]) }}">{{ $scategory->name }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </li>
        </ul>
        @endforeach
    </li>
    
</ul> --}}

<li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Danh mục</a>
    @foreach ($category as $categoryitem)
    <ul class="dropdown">
        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('product.category',['slug'=>$categoryitem->slug]) }}">{{ $categoryitem->name }}</a>
            @if (count($categoryitem->subCategories) > 0)
                <ul class="dropdown">
                    @foreach ($categoryitem->subCategories as $scategory)
                    <li><a href="{{ route('product.category',['slug'=>$categoryitem->slug,'scategory_slug'=>$scategory->slug]) }}">{{ $scategory->name }}</a></li>
                    @endforeach
                </ul>
            @endif
        </li>
    </ul>
    @endforeach
</li>
