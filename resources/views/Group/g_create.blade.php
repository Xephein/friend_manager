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
            {{-- COL 1 --}}
            <div class="col-4"></div>
            {{-- COL 2 --}}
            <div class="col-4">
                <form action="{{ route('Group.Store') }}" method="POST">
                @csrf
                    <label for="text" class="form-label text-custom">Csoport név: </label>
                    <input type="text" class="form-control" id="group_name" placeholder="Csoport elnevezése" name="groupname">
                    <button style="margin:15px 0px 0px 0px" type="submit" class="btn btn-success">Létrehozás</button>
                </form>
            </div>
            {{-- COL 3 --}}
            <div class="col-4"></div>
        </div>
    </body>