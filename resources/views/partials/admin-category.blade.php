<li><a href="{{ route('search.lawyers.bycategory', ['name' => $category->name]) }}">{{ $category->name}}</a><strong>{{ $category->id}}</strong><button class="btn-xs btn-danger"><a href="{{ route('category.delete', ['id' => $category->id]) }}"> X</a></button></li>
	@if (count($category->children) > 0)
	    <ul>
	    @foreach($category->children as $category)
	        @include('partials.category', $category)
	    @endforeach
	    </ul>
	@endif