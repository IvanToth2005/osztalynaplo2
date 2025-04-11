@extends('layout')

@section('content')
<h1>{{ __('messages.class') }}</h1>

<div>
    @include('success')

    <a href="{{ route('school-class.create') }}" title="Új">{{ __('messages.new_class') }}</a>

    @foreach($classes as $class)
        <div class="row {{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
            <div class="col id">{{ $class->id }}</div>
            <div class="col">{{ $class->name }}</div>
            <div class="col">{{ $class->year }}</div>
            <div class="right">
                <div class="col">
                    <a href="{{ route('school-class.show', $class->id) }}">
                        <button><i class="fa fa-binoculars" title="Mutat"></i></button>
                    </a>
                </div>

                @if(auth()->check())
                    <div class="col">
                        <a href="{{ route('school-class.edit', $class->id) }}">
                            <button><i class="fa fa-edit edit" title="Modify"></i></button>
                        </a>
                    </div>
                    <div class="col">
                        <form action="{{ route('school-class.destroy', $class->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="btn-del-fuel">
                            <i class="fa-solid fa-trash trash" title="Delete"></i>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
