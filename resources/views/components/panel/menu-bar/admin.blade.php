@can('admin')
    <x-panel.menu-bar.menu-title :title="__('Product Management')" />
    <x-panel.menu-bar.sub-menu :title="__('Categories')" :icon="__('category')" :active="__('admin/categories/create admin/categories/list admin/categories/*/details admin/categories/*/edit')">
        <x-panel.menu-bar.sub-menu-item :title="__('Create New Category')" href="{{ route('admin.categories.create') }}" :active="__('admin/categories/create')" />
        <x-panel.menu-bar.sub-menu-item :title="__('Categories List')" href="{{ route('admin.categories.list') }}" :active="__('admin/categories/list')" />
    </x-panel.menu-bar.sub-menu>
    <x-panel.menu-bar.sub-menu :title="__('Brands')" :icon="__('brand_family')" :active="__('admin/brands/create admin/brands/list admin/brands/*/details admin/brands/*/edit')">
        <x-panel.menu-bar.sub-menu-item :title="__('Add New Brand')" href="{{ route('admin.brands.create') }}" :active="__('admin/brands/create')" />
        <x-panel.menu-bar.sub-menu-item :title="__('Brands List')" href="{{ route('admin.brands.list') }}" :active="__('admin/brands/list')" />
    </x-panel.menu-bar.sub-menu>
    <x-panel.menu-bar.sub-menu :title="__('Products Units')" :icon="__('donut_small')" :active="__('admin/products/units/list admin/products/units/create admin/products/units/*/edit admin/products/units/*/details')">
        <x-panel.menu-bar.sub-menu-item :title="__('Add New Units')" href="{{ route('admin.products.units.create') }}" :active="__('admin/products/units/create')" />
        <x-panel.menu-bar.sub-menu-item :title="__('Products Units List')" href="{{ route('admin.products.units.list') }}" :active="__('admin/products/units/list')" />
    </x-panel.menu-bar.sub-menu>
    <x-panel.menu-bar.sub-menu :title="__('Products')" :icon="__('inventory_2')" :active="__('admin/products/list admin/products/create admin/products/*/details admin/products/*/edit')">
        <x-panel.menu-bar.sub-menu-item :title="__('Add New Product')" href="{{ route('admin.products.create') }}" :active="__('admin/products/create')" />
        <x-panel.menu-bar.sub-menu-item :title="__('Products List')" href="{{ route('admin.products.list') }}" :active="__('admin/products/list')" />
    </x-panel.menu-bar.sub-menu>
    <x-panel.menu-bar.menu-title :title="__('Stock Management')" />
    <x-panel.menu-bar.sub-menu :title="__('Stock')" :icon="__('inventory')" :active="__('admin/stock-management/history admin/stock-management/new-stock admin/stock-management/*/details admin/stock-management/available-stock')">
        <x-panel.menu-bar.sub-menu-item :title="__('Add New Stock')" href="{{ route('admin.stock-management.new-stock') }}" :active="__('admin/stock-management/new-stock')" />
        <x-panel.menu-bar.sub-menu-item :title="__('Available Stock')" href="{{ route('admin.stock-management.available-stock') }}" :active="__('admin/stock-management/available-stock')" />
        <x-panel.menu-bar.sub-menu-item :title="__('Stock History')" href="{{ route('admin.stock-management.history') }}" :active="__('admin/stock-management/history')" />
    </x-panel.menu-bar.sub-menu>
    <x-panel.menu-bar.sub-menu :title="__('invoicing')" :icon="__('receipt_long')" :active="__('admin/stock-management/invoicing/create admin/stock-management/invoicing/paid-invoices admin/stock-management/invoicing/pending-invoices')">
        <x-panel.menu-bar.sub-menu-item :title="__('Generate New Invoice')" href="{{ route('admin.stock-management.invoicing.create') }}" :active="__('admin/stock-management/invoicing/create')" />
        <x-panel.menu-bar.sub-menu-item :title="__('Paid Invoices')" href="{{ route('admin.stock-management.invoicing.paid-invoices') }}" :active="__('admin/stock-management/invoicing/paid-invoices')" />
        <x-panel.menu-bar.sub-menu-item :title="__('Pending Invoices')" href="{{ route('admin.stock-management.invoicing.pending-invoices') }}" :active="__('admin/stock-management/invoicing/pending-invoices')" />
    </x-panel.menu-bar.sub-menu>
    <x-panel.menu-bar.menu-title :title="__('Users Information')" />
    <x-panel.menu-bar.menu-item :title="__('Users List')" href="{{ route('dashboard') }}" :icon="__('groups')" :active="__('')" />
    <x-panel.menu-bar.menu-item :title="__('Newsletter Subscriptions')" href="{{ route('dashboard') }}" :icon="__('card_membership')" :active="__('')" />
    <x-panel.menu-bar.menu-item :title="__('User Activities Log')" href="{{ route('dashboard') }}" :icon="__('card_membership')" :active="__('')" />
@endcan
