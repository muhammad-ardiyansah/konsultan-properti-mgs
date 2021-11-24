@foreach($subtemplatekomponens as $subtemplatekomponen) 

    <option value="{{ $subtemplatekomponen->id }}" {{ $subtemplatekomponen->id == old('parent_id') ? "selected" : "" }}>{{ $dash }} {{ $subtemplatekomponen->no_komponen_pemeriksaan }} {{ $subtemplatekomponen->nama_komponen_pemeriksaan }}</option>

    @if(count($subtemplatekomponen->subtemplatekomponen))
        @php
            $dash .= "-";
        @endphp
        @include('konsultan.sub-list-select_',['subtemplatekomponens' => $subtemplatekomponen->subtemplatekomponen, 'dash'=>$dash])
    @endif
@endforeach