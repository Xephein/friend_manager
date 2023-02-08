<!DOCTYPE html>
<html lang = "hu">
    <head>
        <title>Friend Manager</title>
        <meta charset="utf-8">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>

        <!-- Navigációs csík -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <ul class="navbar nav">
                    <li class="nav_item">
                        <a class="nav-link" href="{{ route('People.Create') }}">Ember hozzáadása</a>
                    </li>
                    <li class="nav_item">
                        <a class="nav-link disabled" href="{{ route('People.Manage') }}">Ember szerkesztése</a>
                    </li>
                    <li class="nav_item">
                        <a class="nav-link" href="{{ route('Group.Manage') }}">Barátcsoportok szerkesztése</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div style="height:20px"></div>

        <form>

        </form>
        <div class="row">
            <div class="col"></div>

            <div class="col">
                @if (session()->has('message'))
                    <div class="alert alert-danger">
                        <h4>Figyelem!</h4>
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if (count($people) != 0)
                <table class="table table-dark table-striped table-borderless">
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
                <h4>Még nincsenek emberek az adatbázisban...</h4>
                <p>Adj hozzá <a class="nav-link" href="{{ route('People.Create') }}">itt</a>

                @endif
            </div>

            <div class="col"></div>

        </div>
    </body>