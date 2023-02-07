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
                        <a class="nav-link" href="{{ route('Group.Manage') }}">Barátcsoportok szerkesztése</a>
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
                <form action="{{ route('Group.Store') }}" method="POST">
                @csrf
                    <label for="text" class="form-label">Csoport név: </label>
                    <input type="text" class="form-control" id="group_name" placeholder="Csoport elnevezése" name="groupname">
                    <button style="margin:15px 0px 0px 0px" type="submit" class="btn btn-success">Létrehozás</button>
                </form>
            </div>
            {{-- COL 3 --}}
            <div class="col"></div>
        </div>
    </body>