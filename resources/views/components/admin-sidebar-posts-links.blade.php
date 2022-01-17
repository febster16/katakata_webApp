<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-rss fa-cog"></i><span>&nbsp;Post</span>
    </a>
    <div id="collapseTwo" class="collapse {{ (request()->is('admin/posts*')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Posts</h6>
            <a class="collapse-item {{ (request()->is('admin/posts/create')) ? 'active' : '' }}" href="{{route('post.create')}}">Create a Post</a>
            <a class="collapse-item {{ (request()->is('admin/posts')) ? 'active' : '' }}" href="{{route('post.index')}}">View All Posts</a>
        </div>
    </div>
</li>

