<aside>
    <div class=" list-group">
        <a href="{{ route('page.home') }}" class=" list-group-item list-group-item-action">Home</a>
    </div>

    @notUser
        <p class=" mt-3 mb-2 "></p>
        <div class=" list-group">
            <a href="{{ route('auth.register') }}" class=" list-group-item list-group-item-action">
                Register
            </a>
            <a href="{{ route('auth.login') }}" class=" list-group-item list-group-item-action">
                Login
            </a>
        </div>
    @endnotUser
    @user
        <p class=" mt-3 mb-2 text-primary">Dashboard</p>
        <div class=" list-group">
            <a href="{{ route('dashboard.home') }}" class=" list-group-item list-group-item-action">
                Dashboard
            </a>

        </div>


        <p class=" mt-3 mb-2 text-primary">Manage Inventory</p>
        <div class=" list-group">
            <a href="{{ route('item.create') }}" class=" list-group-item list-group-item-action">
                Create Item
            </a>
            <a href="{{ route('item.index') }}" class=" list-group-item list-group-item-action">
                Item list
            </a>
        </div>

        <p class=" mt-3 mb-2 text-primary">Manage Category</p>
        <div class=" list-group">
            <a href="{{ route('category.create') }}" class=" list-group-item list-group-item-action">
                Create Category
            </a>
            <a href="{{ route('category.index') }}" class=" list-group-item list-group-item-action">
                Category list
            </a>
        </div>

        <p class=" mt-3 mb-2 text-primary">User Profile</p>
        <div class=" list-group">
            <a href="" class=" list-group-item list-group-item-action">
                Profile
            </a>
            <a href="{{ route('auth.passwordChange') }}" class=" list-group-item list-group-item-action">
                Change Password
            </a>
        </div>

        <form action="{{ route('auth.logout') }}">

            <button class=" btn btn-sm btn-primary mt-3 w-100">Logout</button>
        </form>
    @enduser
</aside>
