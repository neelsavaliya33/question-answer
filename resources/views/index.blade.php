@extends('layouts.main',['title' => 'question'])

@section('content')
    <div class="container">
        @forelse ($data as $k => $category)
            <div>
                <h2>{{ $category->category_name }}</h2>
                @forelse ($category->question as  $k2 => $item)
                    <div style="padding-left:20px">
                        <h3>{{ $k2 + 1 }} : {{ $item->question }}</h3>
                        @forelse($item->answers as  $k3 => $answer)
                            <div style="padding-left:20px">
                                <p>{{ $k3 + 1 }} :{{ $answer->answer }}  @if ( $answer->is_correct)
                                    (is correct)
                                @endif</p>
                            </div>
                        @empty
                            <h2>N/A</h2>
                        @endforelse
                    </div>
                @empty
                    <h2>N/A</h2>
                @endforelse
            </div>
        @empty
            <h2>N/A</h2>
        @endforelse

    </div>
@endsection
