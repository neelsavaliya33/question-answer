@extends('layouts.main',['title' => 'category | edit'])
@section('content')
    <div class="container">
        <form id="categoryForm" data-id="0">
            <div class="mb-3">
                <label for="category_name" class="form-label">Category</label>
                <input type="text" class="form-control" value="{{ $category->category_name }}" autocomplete="off"
                    name="category_name" id="category_name" aria-describedby="category_name">
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('js')

    <script>
        $(document).ready(function() {
            validator = $("#categoryForm").validate({
                rules: {
                    category_name: {
                        required: true
                    }
                },
                submitHandler: function(form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "PUT",
                        url: "{{ route('category.update', $category->id) }}",
                        data: $("#categoryForm").serializeArray(),
                        dataType: "json",
                        statusCode: {
                            200: function(resp) {
                                if (resp.status) {
                                    toastr.info(resp.message)
                                    setTimeout(() => {
                                        window.location.href =
                                            "{{ route('category.index') }}"
                                    }, 2000);
                                } else toastr.error('some thing went wrong');
                            },
                            422: function(resp) {
                                setTimeout(() => {
                                    toastr.error('some thing went wrong');
                                    window.location.href =
                                        "{{ route('category.index') }}"
                                }, 2000);
                            },
                        }
                    });
                }
            });
        });
    </script>
@endsection
