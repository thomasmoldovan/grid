@extends('../../home')

@section('main')
    <aside id="sidebar" class="pt-3">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                @forelse ($all_categories as $key => $category)
                    @if ($category->id == $category->parent_id)
                        <a 
                            {{-- data-bs-target="#components-nav{{ $category->parent_id }}" data-bs-toggle="collapse"  --}}
                            href="/browse/{{ $category->name }}"
                            class="nav-link {{ Request::segment(2) == $category->name ? 'active' : 'collapsed' }}"
                            style="background: {{ $category->color }}"
                            
                            {{ Request::segment(2) == $category->name ? "class='nav-link active' aria-expanded=true" : "class='nav-link collapsed' aria-expanded=false" }}>

                            <i class="{{ $category->icon }}"></i>
                            <span>{{ $category->name }}</span>
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                    @endif
                    @if ($category->children()->count() > 0)
                        <ul id="components-nav{{ $category->parent_id }}" data-bs-parent="#sidebar-nav"
                            class="nav-content {{ Request::segment(2) == $category->name ? 'show active' : 'collapse' }}">
                            @foreach ($category->children()->get() as $child)
                                @if ($child->id != $child->parent_id)
                                    <li>
                                        <a href="/browse/{{ $child->name }}"
                                            class="{{ Route::is('categories.all') ? 'active' : '' }}">
                                            <i class="{{ $child->icon }}"></i><span>{{ $child->name }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                @empty
                    <div>No categories</div>
                @endforelse
            </li>

            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-blank.html">
                    <i class="bi bi-file-earmark"></i>
                    <span>Blank</span>
                </a>
            </li>
        </ul>
    </aside>
@endsection
