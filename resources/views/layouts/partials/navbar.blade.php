<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="/img/logo.png">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-left" action="{{route('search_product')}}" method="post">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" name="search_product" id="navbar-search" class="form-control" placeholder="Ara"
                           value="{{old('search_product')}}">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-shopping-cart"></i> Sepet <span class="badge badge-theme">5</span></a>
                </li>

                @guest
                    <li><a href="{{ route('user.login') }}">Login</a></li>
                    <li><a href="{{ route('user.sign_up') }}">Sign Up</a></li>
                @endguest

                @auth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"> Profile <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Orders</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout_form').submit();">Logout</a></li>
                            <form action="{{ route('user.logout') }}" method="post" id="logout_form" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<?php
?>
