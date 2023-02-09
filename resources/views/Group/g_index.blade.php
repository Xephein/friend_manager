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
                        <a class="nav-link" href="{{ route('People.Manage') }}">Ember szerkesztése</a>
                    </li>
                    <li class="nav_item">
                        <a class="nav-link disabled" href="{{ route('Group.Manage') }}">Barátcsoportok szerkesztése</a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div style="height:20px"></div>
        {{-- ROW 1 --}}
        <div class="row">
            {{-- COL 1 --}}
            <div class="col"></div>

            {{-- COL 2 --}}
            <div class="col">
                @if (count($groups) != 0)
                <table class="table table-dark table-striped">
                    <tr>
                        <th>Csoport neve</th>
                        <th>Létszám</th>
                        <th>
                            <a href="{{ route('Group.Create') }}"><button style="float:right" type="button" class="badge bg-primary" style="">Csoport létrehozása</button></a>
                        </th>
                    </tr>
                @foreach ($groups as $group)
                    <tr>
                        <td>{{ $group->group_name }}</td>
                        <td>{{ DB::table('group_person')->where('group_id', $group->id)->count('people_id') }}</td>
                        <td>
                            <a href="{{ route('Group.Edit', $group->id) }}"><button style="float:left" type="button" class="badge bg-warning">Szerkesztés</button></a>
                            <form action="{{ route('Group.Destroy', $group->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button style="float:right" type="submit" class="badge bg-danger">Törlés</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </table>
                @else
                <div class="d-flex justify-content">
                    <h4>Egyelőre nincsenek csoportok...</h4>
                    <a href="{{ route('Group.Create') }}"><button style="margin-left:10px" type="button" class="badge bg-primary">Csoport létrehozása</button></a>
                </div>
                @endif
            </div>

            <div class="col">
            </div>

        </div>
    </body>