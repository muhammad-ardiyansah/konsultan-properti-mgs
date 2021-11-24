
@if ($paginator->hasPages())
<nav>
    <ul class="pagination pagination-rounded mb-0 justify-content-end">
       
        @if ($paginator->onFirstPage())
            {{-- <li class="disabled"><span>← Previous</span></li> --}}

            <li class="page-item disabled">
                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

        @else
            {{-- <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></li> --}}

            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>            
        
        @endif


      
        @foreach ($elements as $element)
           
            @if (is_string($element))
                {{-- <li class="disabled"><span>{{ $element }}</span></li> --}}

                <li class="page-item">
                    <span aria-hidden="true">{{ $element }}</span>
                </li>

            @endif


           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        
                        {{-- <li class="active my-active"><span>{{ $page }}</span></li> --}}
                        
                        {{-- <li class="page-item active"><a class="page-link" href="javascript: void(0);">{{ $page }}</a></li> --}}
                        <li class="page-item active"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li> 

                    @else
                    
                        {{-- <li><a href="{{ $url }}">{{ $page }}</a></li> --}}
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    
                    @endif
                @endforeach
            @endif
        @endforeach


        
        @if ($paginator->hasMorePages())

            {{-- <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li> --}}
        
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>            
        
        @else
            
            {{-- <li class="disabled"><span>Next →</span></li> --}}
            <li class="page-item disabled">
                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>        
            
        
        @endif
    </ul>
</nav>    
@endif 