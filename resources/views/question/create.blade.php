@extends('layouts.main',['title' => 'category'])

@section('content')
    <div class="container">
        <form id="questionForm" data-id="0">
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" aria-label="Default select example">
                    <option selected value="">Select category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="mb-3">
                <label for="question" class="form-label">Question</label>
                <input type="text" class="form-control" autocomplete="off" name="question" id="question"
                    aria-describedby="question">
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="option1" class="form-label">Option 1</label>
                        <input type="text" class="form-control" autocomplete="off" name="option[0]" id="option1"
                            aria-describedby="question">
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" checked name="isCorrectAnswer"
                                id="isCorrectAnswer1">
                            <label class="form-check-label" for="isCorrectAnswer1">
                                is correct answer
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="option3" class="form-label">Option 2</label>
                        <input type="text" class="form-control" autocomplete="off" name="option[1]" id="option2"
                            aria-describedby="question">
                        <div class="form-check">
                            <input class="form-check-input" value="2" type="radio" name="isCorrectAnswer"
                                id="isCorrectAnswer2">
                            <label class="form-check-label" for="isCorrectAnswer2">
                                is correct answer
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="option3" class="form-label">Option 3</label>
                        <input type="text" class="form-control" autocomplete="off" name="option[2]" id="option3"
                            aria-describedby="question">
                        <div class="form-check">
                            <input class="form-check-input" value="3" type="radio" name="isCorrectAnswer"
                                id="isCorrectAnswer3">
                            <label class="form-check-label" for="isCorrectAnswer3">
                                is correct answer
                            </label>
                        </div>

                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="option4" class="form-label">Option 4</label>
                        <input type="text" class="form-control" autocomplete="off" name="option[3]" id="option4"
                            aria-describedby="question">
                        <div class="form-check">
                            <input class="form-check-input" value="4" type="radio" name="isCorrectAnswer"
                                id="isCorrectAnswer4">
                            <label class="form-check-label" for="isCorrectAnswer4">
                                is correct answer
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('js')

    <script>
        $(document).ready(function() {
            validator = $("#questionForm").validate({
                rules: {
                    category_id: {
                        required: true
                    },
                    question: {
                        required: true
                    },
                    'option[0]': {
                        required: true
                    },
                    "option[1]": {
                        required: true
                    },
                    "option[2]": {
                        required: true
                    },
                    "option[3]": {
                        required: true
                    },
                    isCorrectAnswer: {
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
                        type: "POST",
                        url: "{{ route('question.store') }}",
                        data: $("#questionForm").serializeArray(),
                        dataType: "json",
                        statusCode: {
                            200: function(resp) {
                                if (resp.status) {
                                    toastr.info(resp.message)
                                    setTimeout(() => {
                                        window.location.href =
                                            "{{ route('question.index') }}"
                                    }, 2000);
                                } else toastr.error('some thing went wrong');
                            },
                            422: function(resp) {
                                setTimeout(() => {
                                    toastr.error('some thing went wrong');
                                    window.location.href =
                                        "{{ route('question.index') }}"
                                }, 2000);
                            },
                        }
                    });
                }
            });
        });
    </script>
@endsection
