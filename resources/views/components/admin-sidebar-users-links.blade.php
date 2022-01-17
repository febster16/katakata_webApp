<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-users fa-cog"></i><span>User</span>
    </a>
    <div id="collapseUsers" class="collapse {{ (request()->is('admin/users*')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Users</h6>
            <a class="collapse-item {{ (request()->is('admin/users/create')) ? 'active' : '' }}" href="{{route('user.create')}}">Create a User</a>
            <a class="collapse-item {{ (request()->is('admin/users')) ? 'active' : '' }}" href="{{route('user.index')}}">View All Users</a>
        </div>
    </div>
</li>