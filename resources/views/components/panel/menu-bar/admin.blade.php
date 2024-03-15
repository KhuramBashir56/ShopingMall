@can('admin')
    <x-panel.menu-bar.menu-title :title="__('Product Management')" />
    <x-panel.menu-bar.sub-menu :title="__('Categories')" :icon="__('category')" :active="__('admin/categories/create admin/categories/list admin/categories/*/details admin/categories/*/edit')">
        <x-panel.menu-bar.sub-menu-item :title="__('Create New Category')" href="{{ route('admin.categories.create') }}" :active="__('admin/categories/create')" />
        <x-panel.menu-bar.sub-menu-item :title="__('Categories List')" href="{{ route('admin.categories.list') }}" :active="__('admin/categories/list')" />
    </x-panel.menu-bar.sub-menu>
    <x-panel.menu-bar.sub-menu :title="__('Brands')" :icon="__('brand_family')" :active="__('admin/brands/create admin/brands/list admin/brands/*/details admin/brands/*/edit')">
        <x-panel.menu-bar.sub-menu-item :title="__('Ad New Brand')" href="{{ route('admin.brands.create') }}" :active="__('admin/brands/create')" />
        <x-panel.menu-bar.sub-menu-item :title="__('Brands List')" href="{{ route('admin.brands.list') }}" :active="__('admin/brands/list')" />
    </x-panel.menu-bar.sub-menu>
    <x-panel.menu-bar.sub-menu :title="__('Products')" :icon="__('inventory_2')" :active="__('admin/products/list admin/products/create')">
        <x-panel.menu-bar.sub-menu-item :title="__('Ad New Product')" href="{{ route('admin.products.create') }}" :active="__('admin/products/create')" />
        <x-panel.menu-bar.sub-menu-item :title="__('Products List')" href="{{ route('admin.products.list') }}" :active="__('admin/products/list')" />
    </x-panel.menu-bar.sub-menu>
    <x-panel.menu-bar.sub-menu :title="__('Stock Management')" :icon="__('inventory')" :active="__('')">
        <x-panel.menu-bar.sub-menu-item :title="__('Ad New Product')" href="{{ route('admin.products.create') }}" :active="__('admin/products/create')" />
        <x-panel.menu-bar.sub-menu-item :title="__('Products List')" href="{{ route('admin.products.list') }}" :active="__('admin/products/list')" />
    </x-panel.menu-bar.sub-menu>
    <x-panel.menu-bar.menu-title :title="__('Users Information')" />
    <x-panel.menu-bar.menu-item :title="__('Users List')" href="{{ route('dashboard') }}" :icon="__('groups')" :active="__('dashboard')" />
    <x-panel.menu-bar.menu-item :title="__('Newsletter Subscriptions')" href="{{ route('dashboard') }}" :icon="__('card_membership')" :active="__('dashboard')" />
@endcan
