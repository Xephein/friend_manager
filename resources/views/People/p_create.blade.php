<!DOCTYPE html>
<html lang = "hu">
    <head>
        <title>Friend Manager</title>
        <meta charset="utf-8">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ url('/css/overhaul.css') }}" />
    </head>
    <body>

        <!-- Navigációs csík -->
        <nav class="navbar navbar-expand-sm">
            <div class="container-fluid">
                <ul class="navbar nav">
                    <li class="nav_item">
                        <p class="nav-link-here" href="{{ route('People.Create') }}">Ember hozzáadása</p>
                    </li>
                    <li class="nav_item">
                        <a class="nav-link-custom" href="{{ route('People.Manage') }}">Ember szerkesztése</a>
                    </li>
                    <li class="nav_item">
                        <a class="nav-link-custom" href="{{ route('Group.Manage') }}">Barátcsoportok szerkesztése</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div style="height:20px"></div>

        {{-- ROW 1 --}}
        <div class="row">

            <div class="col-3"></div>

            <div class="col-6">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    <p>{{ session()->get('message') }}</p>
                </div>
                @endif
            </div>

            <div class="col-3"></div>
        </div>

        <form action="{{ route('People.Store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-3">
                    <div>
                        @if ($errors->any())
                            <div style="margin-left:5px" class="alert alert-warning">Valami nem sikerült... </div>
                            <ul style="margin-left:5px" class="alert alert-warning">
                            @foreach ($errors->all(); as $error)
                                <li style="margin-left:10px"> {{ $error }} </li>
                            @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="col-3">
                    <label for="lname" class="form-label text-custom">Vezetéknév: </label>
                    <input type="text" class="form-control" id="lname" placeholder="Vezetéknév" name="lastname">
                </div>

                <div class="col-3">
                    <label for="fname" class="form-label text-custom">Utónév: </label>
                    <input type="text" class="form-control" id="fname" placeholder="Utónév" name="firstname">
                </div>

                <div class="col-3"></div>
            </div>
            
            <div class="row" style="height:20px"></div>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <button type="submit" class="btn btn-success">Új adat rögzítése</button>
                </div>
                <div class="col-4"></div> 
            </div>
        </form>
    </body>
</html>
