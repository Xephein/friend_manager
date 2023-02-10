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
        <div class="row" style="margin:0px 15px 0px 15px">

            {{-- COL 1 --}}
            <div class="col-2">
                {{-- Szerkesztéshez gyorsnavigációs lista jöhetne ide --}}
            </div>

            {{-- COL 2 --}}
            <div class="col-4">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <p><h4>Figyelem!</h4>
                        <p>{{ session()->get('message') }}
                    </div>
                @endif
                <form action="{{ route('People.Update', $person->id) }}" method="POST">
                @csrf
                @method('PATCH')
                @if ($errors->any())
                    <div style="margin-left:5px" class="alert alert-warning">Valami nem sikerült...</div>
                    <ul style="margin-left:5px" class="alert alert-warning">
                    @foreach ($errors->all(); as $error)
                        <li style="margin-left:10px"> {{ $error }} </li>
                    @endforeach
                    </ul>
                @endif
                    
                    <label for="lname" class="form-label text-custom">Vezetéknév: </label>
                    <input type="text" class="form-control" id="lname" name="lastname" value = "{{ $person->lastname }}">
                    
                    <div style="height:10px"></div>

                    <label for="fname" class="form-label text-custom">Utónév: </label>
                    <input type="text" class="form-control" id="fname" name="firstname" value = "{{ $person->firstname }}">
                    
                    <div style="height:20px"></div>
                
                    
                    <button type="submit" class="btn btn-warning text-custom">Módosítás</button>
                </form>
            </div>

            {{-- COL 3 --}}
            <div class="col-4">
            @if (count($friendgroups) == 0)
            <h4 class="h4-custom">{{ $person->firstname }} nem tagja egy barátcsoportnak sem.</h4>
            @else
            <h4 class="h4-custom">Barátcsoportok</h4>
            <table class="table table-custom table-borderless">
                <tr>
                    <th>Csoport neve</th>
                    <th></th>
                </tr>
            @foreach ($friendgroups as $fgroup)
                <form action="{{ route('Grpmbr.Destroy', [$fgroup->id, $person->id])  }}" method="POST">
                @csrf
                @method('DELETE')
                <tr>
                    <input type="hidden" value="{{ $person->id }}">
                    <td>{{ $fgroup->group_name }}</td>
                    <td><button style="float:right" class="badge bg-danger">Kilépés</button></td>
                </tr>
                </form>
            @endforeach
            </table>
            @endif
            </div>
            {{-- COL 4 --}}
            <div class="col-2">
                {{-- Elérhető csoportokhoz csatlakozási lehetőség --}}
            </div>
        </div>
        
        {{-- ROW 2 --}}
        <div class="row" style="margin:30px 15px 0px 15px">
            {{-- COL 1 --}}
            <div class="col-2"></div>
            {{-- COL 2 --}}
            <div class="col-4"> 
                @if (count($friends) != 0)
                <h4 class="h4-custom"> {{ $person->firstname }} barátai</h4>
                <table class="table table-custom table-borderless">
                    <tr>
                        <th>Vezetéknév</th>
                        <th>Utónév</th>
                        <th></th>
                    </tr>
                @foreach ($friends as $friend)
                    <tr>
                        <form action="{{ route('Rship.Destroy', $friendquery[$loop->index]->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                            <td>{{ $friend[0]->lastname }}</td>
                            <td>{{ $friend[0]->firstname }}</td>
                            <td><button type="submit" class="badge bg-danger" style="float:right">Törlés</button></td>
                        </form>
                    </tr>
                @endforeach
                @else
                <h4 class="h4-custom"> {{ $person->firstname }} eléggé magányos...</h4>
                <p class="text-custom">Adj hozzá barátokat!</p>

                @endif
                {{-- @foreach ($friends2 as $friend)
                <tr>
                    <td>{{ DB::table('People')->select('lastname')->where('id', $friend->person_id)->get()[0]->lastname }}</td>
                    <td>{{ DB::table('People')->select('firstname')->where('id', $friend->person_id)->get()[0]->firstname }}</td>
                </tr>
                @endforeach --}}
                </table>
            </div>
            {{-- COL 3 --}}
            <div class="col-4"> 
                @if (count($nonfriends) != 0)
                <h4 class="h4-custom">Barátok hozzáadása</h4>
                    <table class="table table-custom table-borderless">
                        <tr>
                            <th>Vezetéknév</th>
                            <th>Utónév</th>
                            <th></th>
                        </tr>
                        @foreach ($nonfriends as $nfriend)
                        <tr>
                            <form action="{{ route('Rship.Store') }}" method="POST">
                            @csrf
                                <input type="hidden" value="{{ $person->id }}" name="person_id">
                                <input type="hidden" value="{{ $nfriend->id }}" name="friend_id">
                                <td>{{ $nfriend->lastname }}</td>
                                <td>{{ $nfriend->firstname }}</td>
                                <td><button type="submit" class="badge bg-success" style="float:right">Hozzáadás</button></td>
                            </form>
                        </tr>                            
                        @endforeach
                    </table>
                @else
                    <h4 class="h4-custom">Egyelőre nincs más az adatbázisban.</h4>
                    <p class="text-custom"><a href="{{ route('People.Create') }}">Ezen a linken</a> megváltoztathatod a helyzetet.</p>
                @endif
            </div>
            {{-- COL 4 --}}
            <div class="col-2"></div>
        
        </div>

    </body>
</html>
