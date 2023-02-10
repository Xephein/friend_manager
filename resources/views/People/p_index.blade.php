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
                        <a class="nav-link-custom" href="{{ route('People.Create') }}">Ember hozzáadása</a>
                    </li>
                    <li class="nav_item">
                        <p class="nav-link-here " href="{{ route('People.Manage') }}">Ember szerkesztése</p>
                    </li>
                    <li class="nav_item">
                        <a class="nav-link-custom" href="{{ route('Group.Manage') }}">Barátcsoportok szerkesztése</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div style="height:20px"></div>

        <form>

        </form>
        <div class="row">
            <div class="col-4"></div>

            <div class="col-4">
                @if (session()->has('message'))
                    <div class="alert alert-danger">
                        <h4>Figyelem!</h4>
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if (count($people) != 0)
                <table class="table table-borderless table-custom">
                    <tr>
                        {{-- <th>ID</th> --}}
                        <th>Vezetéknév</th>
                        <th>Utónév</th>
                        <th><a href="{{ route('People.Create') }}"><button style="float:right" class="badge bg-primary">Ember hozzáadása</button></a></th>
                    </tr>
                    @foreach ($people as $person)
                        <tr>
                            {{-- <th>{{ $person->id }}</th> --}}
                            <td>{{ $person->lastname }}</td>
                            <td>{{ $person->firstname }}</td>
                            <td>
                                <form action="{{ route('People.Destroy', $person->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                        <button style="float:right" type="submit" class="badge bg-danger">Törlés</button>
                                    </form>
                                <a href="{{ route('People.Edit', $person->id) }}"><button class="badge bg-warning" style="float:left">Szerkesztés</button></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                @else
                <div>
                <h4 class="h4-custom">Még nincsenek emberek az adatbázisban...</h4>
                <p class="custom-text">Adj hozzá <a href="{{ route('People.Create') }}">itt</a>!</p>
                </div>

                @endif
            </div>

            <div class="col-4"></div>

        </div>
    </body>