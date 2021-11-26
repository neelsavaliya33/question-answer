@extends('layouts.main',['title' => 'question'])
@section('content')
    <div class="container mt-3">
        <a href="{{ route('question.create') }}" class="btn btn-primary">
            Add
        </a>

        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Question</th>
                        <th scope="col">Option 1</th>
                        <th scope="col">Option 2</th>
                        <th scope="col">Option 3</th>
                        <th scope="col">Option 4</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($questions as $question)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $question->question }}</td>
                            @foreach ($question->answers as $answer)
                                <td @if ($answer->is_correct)
                                    class="bg-success"
                                @endif>{{ $answer->answer }}</td>
                            @endforeach
                            <td>
                                <a href="{{ route('question.edit', $question->id) }}" class="btn btn-primary">Edit</a>
                                <form method="post" action="{{ route('question.destroy', $question->id) }}"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="6" class="text-center">N/A</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $questions->links() }}
        </div>
    </div>
@endsection
