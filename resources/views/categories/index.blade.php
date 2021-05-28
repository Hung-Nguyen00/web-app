    <div class="container">
        @if($categories->count() > 0)
        @foreach($categories as $key => $category)
            @if($category->descendants->count() > 0)
                <div class="dropdown pr-2">
                    <button class="dropbtn">
                        <a  class="text-light" href="{{ route('category.show', $category->id) }}">{{ $category->name}}</a>
                    </button>
                    <div class="dropdown-content">
                        @foreach($category->descendants as $item)
                            <a class=""  href="{{ route('category.show', $item->id) }}">{{ $item->name}}</a>
                         @endforeach
                    </div>
                </div>
            @elseif($category->ancestors->count() == 0)
                <div class="dropdown pr-2">
                    <button class="dropbtn">
                        <a  class="text-light"  href="{{ route('category.show', $category->id) }}">{{ $category->name}}</a>
                    </button>
                 </div>
            @endif
         @endforeach
        @endif
    </div>
