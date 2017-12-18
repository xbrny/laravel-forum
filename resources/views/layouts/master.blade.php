<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ config('app.name') }} - @yield('title')</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/atom-one-dark.min.css" />
        
        {{-- Toastr --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    </head>
    <body>

        @include('shared.header')

        <div class="container mb-5">
            <div class="row">
                <div class="col-md-4">
                    @auth
                        @if(auth()->user()->admin)
                            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                <a class="btn btn-outline-primary" href="{{ route('topics.create') }}" role="button">Create a new Topic</a>
                                <a class="btn btn-outline-primary btn-block" href="{{ route('topics.index') }}" role="button">List all Topic</a>
                            </div>
                        @endif

                        <a class="btn btn-primary btn-block mb-4" href="{{ route('discussions.create') }}" role="button">Create a new discussion</a>
                    @endauth
                    <ul class="list-group mb-4">
                        <li class="list-group-item">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                    </ul>
                    <ul class="list-group">
                        <li class="list-group-item bg-light">Topic</li>
                        @if($topics->count() > 0)
                            @foreach($topics as $topic)
                                <li class="list-group-item">
                                    <a href="{{ route('topics.show', ['topic' => $topic->id]) }}">{{ $topic->name }}</a>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">
                                <h6 class="text-muted">There is no topic to display</h6>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>
        </div> {{-- container --}}

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>
        
        {{-- Toastr --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            @if(session('success'))
                toastr.success('{{ session('success') }}');
            @elseif(session('error'))
                toastr.error('{{ session('error') }}');
            @elseif(session('warning'))
                toastr.warning('{{ session('warning') }}');
            @endif
        </script>
    </body>
</html>