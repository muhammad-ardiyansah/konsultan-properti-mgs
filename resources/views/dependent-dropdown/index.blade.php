@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dependent Dropdown Demo
                </div>

                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label">Province</label>

                            <div class="col-md-6">
                                <select name="province" id="province" class="form-control">
                                    <option value="">== Select Province ==</option>
                                    @foreach ($provinces as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label">City</label>

                            <div class="col-md-6">
                                <select name="city" id="city" class="form-control">
                                    <option value="">== Select City ==</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
window.addEventListener('DOMContentLoaded', function() {
    $(function () {

        // $.ajaxSetup({
        //     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        // });        

        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

        $('#province').on('change', function () {
            // alert($(this).val());
            $.ajax({
            url: "{{ route('dependent-dropdown.store') }}",
            // url : "/dependent-dropdown/store",
            method: 'POST',
            headers: headers,
            data: {code: $(this).val()},
            success: function (response) {
                // alert(response);
                $('#city').empty();

                $.each(response, function (code, name) {
                    $('#city').append(new Option(name, code))
                    // alert(name);
                })
            }
            })            
        });
    });
});
</script>
@endpush