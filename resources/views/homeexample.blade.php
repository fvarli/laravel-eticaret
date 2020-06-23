<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>E-commerce Project</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 40px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    @php $age = 25; @endphp

                    E-commerce Project <hr> {{ $first_name . ' ' .  $last_name  }} <hr> Your age is {{ $age }}.
                    <hr>

                    @if ($first_name == 'John')
                        Welcome Boss!
                        @else
                        Welcome!
                    @endif

                    <hr>

                    @switch($first_name)
                        @case ('John')
                        Welcome John
                        @break

                        @case('Test')
                        Welcom Test
                        @break

                        @default
                        Welcome
                    @endswitch

                    <hr>

                    @for($i =0; $i<=3; $i++)
                        For Loop Value {{ $i }} <br>
                    @endfor

                    <hr>

                    @php
                    $i =0;
                    @endphp
                    @while($i<=3)
                        While Loop Value {{ $i }} <br>
                        @php
                            $i++;
                        @endphp
                    @endwhile

                    <hr>

                    @foreach($names as $name)
                        {{ $name . ($name !==end($names) ? ',' : '') }}
                    @endforeach

                    <hr>

                    @foreach($users as $user)
                        @continue($user['id'] == 1)
                        <li>{{ $user['id'] . ' - ' . $user['user_name'] }} </li>
                        @break($user['id'] == 4)
                    @endforeach

                    {{-- Comment Line --}}

                    <hr>

                    @php
                    $html = "<b>Test</b>";
                    @endphp
                    {!! $html !!}
                </div>

            </div>
        </div>
    </body>
</html>
