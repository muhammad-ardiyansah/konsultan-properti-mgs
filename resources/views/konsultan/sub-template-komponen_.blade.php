@foreach($subtemplatekomponens as $subtemplatekomponen)
        <ul>
            <li>{{ $subtemplatekomponen->no_komponen_pemeriksaan }} {{ $subtemplatekomponen->nama_komponen_pemeriksaan }}</li> 
            @if(count($subtemplatekomponen->subtemplatekomponen))
                @include('konsultan.sub-template-komponen_',['subtemplatekomponens' => $subtemplatekomponen->subtemplatekomponen])
            @endif
        </ul> 
@endforeach