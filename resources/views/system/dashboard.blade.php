<div id="dashboard" class="dashboard">
    <div class="columns">
        <h2>Charts</h2>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatibus ratione excepturi eligendi ad quam
            obcaecati, atque suscipit consectetur consequatur molestiae odit velit repudiandae itaque quis quae quaerat
            accusantium impedit facilis error ipsum perspiciatis. Deserunt dignissimos reiciendis aspernatur corrupti
            voluptatum iste delectus voluptate excepturi! Nemo pariatur recusandae minus reprehenderit laboriosam odit!
        </p>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatibus ratione excepturi eligendi ad quam
            obcaecati, atque suscipit consectetur consequatur molestiae odit velit repudiandae itaque quis quae quaerat
            accusantium impedit facilis error ipsum perspiciatis. Deserunt dignissimos reiciendis aspernatur corrupti
            voluptatum iste delectus voluptate excepturi! Nemo pariatur recusandae minus reprehenderit laboriosam odit!
        </p>
    </div>

    <div class="columns">
        <h2>Actions</h2>

        @if (checkAdmin() || checkSuperAdmin())
        <div class="collapseable">
            <label for="" class="click">Setting<span><i class="fa-solid fa-chevron-down"></i></span></label>
            <div class="content">
                <ul>
                    <li><a href="{{ route('settings.index') }}">Index</a></li>
                </ul>
            </div>
        </div>
        @endif

        @if (checkSuperAdmin())
        <div class="collapseable">
            <label for="" class="click">Shop<span><i class="fa-solid fa-chevron-down"></i></span></label>
            <div class="content">
                <ul>
                    <li><a href="{{ route('shops.index') }}">Index</a></li>
                    <li><a href="{{ route('shops.create') }}">Create</a></li>
                </ul>
            </div>
        </div>
        @endif

        @if (checkSuperAdmin() || checkAdmin() || checkManager())
        <div class="collapseable">
            <label for="" class="click">Accounts<span><i class="fa-solid fa-chevron-down"></i></span></label>
            <div class="content">
                <ul>
                    <li><a href="{{ route('accounts.index') }}">Index</a></li>
                    @if (checkSuperAdmin() || checkAdmin())
                    <li><a href="{{ route('accounts.create') }}">Create</a></li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="collapseable">
            <label for="" class="click">Transaction<span><i class="fa-solid fa-chevron-down"></i></span></label>
            <div class="content">
                <ul>
                    <li><a href="{{ route('transactions.index') }}">Index</a></li>
                    <li><a href="{{ route('transactions.create') }}">Create</a></li>
                </ul>
            </div>
        </div>

        <div class="collapseable">
            <label for="" class="click">Users<span><i class="fa-solid fa-chevron-down"></i></span></label>
            <div class="content">
                <ul>
                    <li><a href="{{ route('users.index') }}">Index</a></li>
                    <li><a href="{{ route('users.create') }}">Create</a></li>
                </ul>
            </div>
        </div>
        @endif

        <div class="collapseable">
            <label for="" class="click">Category<span><i class="fa-solid fa-chevron-down"></i></span></label>
            <div class="content">
                <ul>
                    <li><a href="{{ route('categories.index') }}">Index</a></li>
                    @if (checkSuperAdmin() || checkAdmin() || checkManager())
                    <li><a href="{{ route('categories.create') }}">Create</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="collapseable">
            <label for="" class="click">Product<span><i class="fa-solid fa-chevron-down"></i></span></label>
            <div class="content">
                <ul>
                    <li><a href="{{ route('products.index') }}">Index</a></li>
                    @if (checkSuperAdmin() || checkAdmin() || checkManager())
                    <li><a href="{{ route('products.create') }}">Create</a></li>
                    @endif
                </ul>
            </div>
        </div>

        @if (checkSuperAdmin() || checkAdmin() || checkManager())
        <div class="collapseable">
            <label for="" class="click">Purchase<span><i class="fa-solid fa-chevron-down"></i></span></label>
            <div class="content">
                <ul>
                    <li><a href="{{ route('purchases.index') }}">Index</a></li>
                    <li><a href="{{ route('purchases.create') }}">Create</a></li>
                </ul>
            </div>
        </div>

        <div class="collapseable">
            <label for="" class="click">Purchase Order<span><i class="fa-solid fa-chevron-down"></i></span></label>
            <div class="content">
                <ul>
                    <li><a href="{{ route('purchase-orders.index') }}">Index</a></li>
                    <li><a href="{{ route('purchase-orders.create') }}">Create</a></li>
                </ul>
            </div>
        </div>
        @endif

        @if (checkSuperAdmin() || checkAdmin() || checkManager() || checkSeller())
        <div class="collapseable">
            <label for="" class="click">Sell<span><i class="fa-solid fa-chevron-down"></i></span></label>
            <div class="content">
                <ul>
                    <li><a href="{{ route('sells.index') }}">Index</a></li>
                    <li><a href="{{ route('sells.create') }}">Create</a></li>
                </ul>
            </div>
        </div>

        <div class="collapseable">
            <label for="" class="click">Sell Order<span><i class="fa-solid fa-chevron-down"></i></span></label>
            <div class="content">
                <ul>
                    <li><a href="{{ route('sell-orders.index') }}">Index</a></li>
                    <li><a href="{{ route('sell-orders.create') }}">Create</a></li>
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>
