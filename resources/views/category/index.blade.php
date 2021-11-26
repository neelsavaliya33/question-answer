@extends('layouts.main',['title' => 'category'])
@section('content')
    <div class="container mt-3">
        <a href="{{ route('category.create') }}" class="btn btn-primary">
            Add
        </a>

        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                                <form method="post" action="{{ route('category.destroy', $category->id) }}"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="3" class="text-center">N/A</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
@endsection
