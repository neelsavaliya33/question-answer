<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <title>
        @isset($title)
            {{ $title }}
        @endisset
    </title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @yield('css')
    <style>
        label.error {
            color: #DC3545;
        }

        input.error,
        select.error {
            border-color: #DC3545 !important;
        }

        .form-control.error:focus {
            box-shadow: 0 0 0 0.25rem rgb(220 53 62 / 25%);
        }

        .form-select.error:focus {
            box-shadow: 0 0 0 0.25rem rgb(220 53 62 / 25%);
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Question Answer</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link @if (request()->route()->getName() == 'home')
                            active
                        @endif"" aria-current="page" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->route()->getName() == 'category.index' || request()->route()->getName() == 'category.create' || request()->route()->getName() == 'category.edit')
                            active
                        @endif"
                            href="{{ route('category.index') }}">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->route()->getName() == 'question.index' || request()->route()->getName() == 'question.create' || request()->route()->getName() == 'question.edit')
                            active
                        @endif"" href="
                            {{ route('question.index') }}">Question</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    @yield('modal')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @if (Session::has('success'))
        <script>
            toastr.info("{{ Session::get('success') }}");
        </script>
    @endif
    @yield('js')
</body>

</html>
