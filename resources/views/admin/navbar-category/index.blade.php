@extends('admin.layout.app')

@section('title')
NavBar Categories
@endsection

@section('body')
<div class="br-mainpanel br-profile-page">

    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <a class="breadcrumb-item" href="{{route('admin.category.index')}}">Categories</a>
          <a class="breadcrumb-item active" href="#">Nav bar Categories</a>
        </nav>
    </div><!-- br-pageheader -->
    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Nav bar Categories</h4>
        <p class="mg-b-0">Manage the categories you want people to see on the nabvar.</p>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper">

            @if (session('success'))
                <div class="alert mb-2 alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @error('categories')
                <div class="alert mb-2 alert-warning">
                    {{ $message }}
                </div>
            @enderror

            <form class="" method="POST" action="{{route('admin.navbar-category.store')}}">
                @csrf
                <div class="row mb-5">

                    <div class="col-md-4">
                        <h6 class="mb-2">All Categories</h6>
                        @forelse ($categories as $category)
                            <div>
                                <label for="category_{{ $category->id }}">
                                    {{ $category->name }}
                                    <input data-order='{{$category->navBarCategory->order ?? null}}' type="checkbox" name="categories" id="category_{{ $category->id }}"
                                        @checked($category->navBarCategory) value="{{ $category->id }}">
                                </label>
                            </div>
                        @empty
                            <p>No category added yet</p>
                        @endforelse
                    </div>


                    <div class="col-md-6">
                        <h6 class="mb-2">Selected NavBar Categories</h6>
                        <div id="sortable-left" class="list-group col">
                            <!-- This area will be populated with checked categories -->
                        </div>
                    </div>

                    <input type="hidden" name="categories" id="sorted-categories">

                </div>


                <div class="form-layout-footer">
                    <button class="btn btn-info">Submit</button>
                </div>
            </form>
        </div><!-- br-section-wrapper -->
    </div>
@endsection

@section('extra-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            console.log('"object" :>> ', "object");
            const sortableList = document.getElementById('sortable-left');
            // Get all checked categories and sort them by their 'data-order' attribute
            const checkedCategories = Array.from(document.querySelectorAll('input[type="checkbox"][name="categories"]:checked'));
            const sortedCheckedCategories = checkedCategories.sort((a, b) => {
                const orderA = parseInt(a.getAttribute('data-order')) || 0;
                const orderB = parseInt(b.getAttribute('data-order')) || 0;
                return orderA - orderB;
            });

            // Prefill the sortable list with sorted checked categories
            sortedCheckedCategories.forEach(function (checkbox) {
                const categoryName = checkbox.parentNode.textContent.trim();
                const categoryId = checkbox.value;

                // Add checked category to the sortable-left area
                const newItem = document.createElement('div');

                newItem.className = 'list-group-item';
                newItem.setAttribute('data-id', categoryId);
                newItem.textContent = categoryName;
                newItem.insertAdjacentHTML('afterbegin', '<i class="fa fa-arrows-alt handle"></i> ');
                sortableList.appendChild(newItem);

                console.log('newItem :>> ', newItem);
            });
            let sortedIds = Array.from(sortableList.children).map(item => item.getAttribute('data-id'));
            document.getElementById('sorted-categories').value = sortedIds.join(',');

            console.log('sortableList :>> ', sortableList);

            // Initialize SortableJS on the sortable-left area
            const sortable = new Sortable(sortableList, {
                animation: 150,
                ghostClass: 'sortable-add',
                onEnd: function () {
                    // Update hidden input with the new order
                    const sortedIds = Array.from(sortableList.children).map(item => item.getAttribute('data-id'));
                    document.getElementById('sorted-categories').value = sortedIds.join(',');
                }
            });

            // Handle checkbox changes
            document.querySelectorAll('input[type="checkbox"][name="categories"]').forEach(function (checkbox) {
                console.log('checkbox :>> ', checkbox);
                checkbox.addEventListener('change', function () {
                    const categoryName = this.parentNode.textContent.trim();
                    const categoryId = this.value;

                    console.log('categoryName :>> ', categoryName);

                    if (this.checked) {
                        // Move checked category to the sortable-left area
                        const newItem = document.createElement('div');
                        newItem.className = 'list-group-item';
                        newItem.setAttribute('data-id', categoryId);
                        newItem.textContent = categoryName;
                        newItem.insertAdjacentHTML('afterbegin', '<i class="fa fa-arrows-alt handle"></i> ');
                        sortableList.appendChild(newItem);
                    } else {
                        // Remove unchecked category from sortable-left
                        const itemToRemove = sortableList.querySelector(`[data-id="${categoryId}"]`);
                        if (itemToRemove) {
                            sortableList.removeChild(itemToRemove);
                        }
                    }

                    // Update hidden input with the new order
                    sortedIds = Array.from(sortableList.children).map(item => item.getAttribute('data-id'));
                    document.getElementById('sorted-categories').value = sortedIds.join(',');
                });
            });
        });
    </script>
@endsection
