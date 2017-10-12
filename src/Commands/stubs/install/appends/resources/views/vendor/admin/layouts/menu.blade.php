{{-- Media --}}
<li id="menu-media">
    <a class="parent"><i class="fa fa-newspaper-o fa-fw"></i><span>@Lang('admin::media.heading.catalog')</span></a>
    <ul>
        <li><a href="{{ route('admin.media.category.index') }}">@Lang('admin::mediaCategory.heading.index')</a></li>
        <li><a href="{{ route('admin.media.index') }}">@Lang('admin::media.heading.index')</a></li>
    </ul>
</li>