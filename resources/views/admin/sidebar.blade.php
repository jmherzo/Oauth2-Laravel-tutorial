<div class="col-md-3">
    <div class="card" id="sidebarCard">
        <div class="card-header">
            Sidebar
        </div>

        <div class="card-body">
            <ul  role="tablist">
                <li role="presentation">
                    <a href="{{ url('/home') }}">
                        Home
                    </a>
                </li>
                <li role="presentation">
                    <a href="{{ url('/admin/section') }}">
                        Sections
                    </a>
                </li>
                <li role="presentation">
                    <a href="{{ url('/admin/privileges') }}">
                        Roles
                    </a>
                </li>
                <li role="presentation">
                    <a href="{{ url('/admin/policies') }}">
                        Policies
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
