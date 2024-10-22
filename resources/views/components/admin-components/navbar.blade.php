<div class="navbar bg-base-100">
    <div class="flex-1">
        <a class="btn btn-ghost text-xl">Admin Dashboard</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            <li>
                <details>
                    <summary>Actions</summary>
                    <ul class="bg-base-100 rounded-t-none p-2">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="route('logout')"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">Log
                                    Out</a>
                            </form>
                        </li>
                    </ul>
                </details>
            </li>
        </ul>
    </div>
</div>
