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
            <div class="col-1"></div>

            {{-- COL 2 --}}
            <div class="col-5">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    <h4>Figyelem!</h4>
                    <p>{{ session()->get('message') }}
                </div>
                @endif
            </div>

            {{-- COL 3 --}}
            <div class="col-6"></div>
        </div>

        {{-- ROW 2 --}}
        <div class="row">     
            {{-- COL 1 --}}
            <div style="padding-left:100px" class="col">
                <form action="{{ route('Group.Update', $group[0]->id) }}" method="POST">
                @csrf
                @method('PATCH')
                @if ($errors->any())
                    <div style="margin-left:5px" class="alert alert-warning">Valami nem sikerült... </div>
                    <ul style="margin-left:5px" class="alert alert-warning">
                    @foreach ($errors->all(); as $error)
                        <li style="margin-left:10px"> {{ $error }} </li>
                    @endforeach
                    </ul>
                @endif
                <label for="text" class="form-label text-custom">Csoport név: </label>
                <input type="text" class="form-control" id="group_name" value="{{ $group[0]->group_name }}" name="groupname">
                <button style="margin:15px 0px 0px 0px" type="submit" class="btn btn-warning">Módosítás</button>
                </form>
                <div style="margin-top:20px">
                    @if (count($members) != 0)
                    <h4 class="h4-custom">Tagok listája</h4>
                    <table class="table table-custom table-borderless">
                        <tr>
                            <th>Vezetéknév</th>
                            <th>Keresztnév</th>
                            <th></th>
                        </tr>
                        @foreach ($members as $member) 
                        <tr>
                            <form action="{{ route('Grpmbr.Destroy', ['group_id' => $group[0]->id, 'member_id' => $member->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" value="{{ $member->id }}">
                            <td>{{ $member->lastname }}</td>
                            <td>{{ $member->firstname }}</td>
                            <td>
                                <button style="margin:15px 0px 0px 0px;float:right" type="submit" class="badge bg-danger">Törlés</button>
                            </td>
                        </form>
                        </tr>
                        @endforeach
                        
                    </table>
                    @else
                    <p>Egy halmaz, amely tartalmaz minden halmazt, amelyek nem tartalmazzák magukat, nem létezhet... Ez így nem egy fenntartható állapot.</p>
                    <h4 class="h4-custom">Adj a csoporthoz tagokat!</h4>
                    @endif
                </div>
            </div>

            {{-- COL 2 --}}
            <div style="margin-right:15px" class="col">
                @if (count($everyone) == 0)
                <h4 class="h4-custom">Még nincs ember, akit a csoporthoz lehetne adni.</h4>
                <p class="text-custom"><a href="{{ route('People.Create') }}">Adj embereket</a> az adatbázishoz!</p>

                @elseif (count($everyone) == 1)
                <h4 class="h4-custom">Barátcsoporthoz csak barátokat, vagy azok barátait lehet hozzáadni.</h4>
                <p class="text-custom">Adj a rendszerhez <a href="{{ route('People.Create') }}">még egy embert</a>, majd szerkeszd valamelyiküket, hogy barátok legyenek!</p>

                @elseif (count($everyone) == 2 && count($allpeople) == 0)
                <h4 class="h4-custom">Olyan közel vagy...</h4>
                <p class="text-custom">Hogy már-már azt hiszem direkt csinálod. <a href="{{ route('People.Manage') }}">Szerkeszd meg</a> valamelyik jó madarat, hogy barátok legyenek, és akkor már lesz értelme ennek a résznek.
                
                @elseif (count($allpeople) == 0 && count($members) == 0)
                <h4 class="h4-custom">Látom nem szereted a linkeket, sem az utasításokat...</h4>
                <p class="text-custom">De nem fogsz ki rajtam. Amíg nem lesz legalább egy ember egy másik barátja, nem engedem, hogy itt bármit is csinálj!

                @elseif (count($members) == 0)
                <h4 class="h4-custom">Tagok hozzáadása</h4>
                <table class="table table-custom table-borderless">
                    <tr>
                        <th>Vezetéknév</th>
                        <th>Utónév</th>
                        <th></th>
                    </tr>
                @foreach ($allpeople as $person)
                    <tr>
                    <form action="{{ route('Grpmbr.Store') }}" method="POST">
                    @csrf
                        
                        <input type="hidden" value="{{ $group[0]->id }}" name="groupID">
                        <input type="hidden" value="{{ $person->id }}" name="memberID">
                        <td>{{ $person->lastname }}</td>
                        <td>{{ $person->firstname }}</td>
                        <td>
                            <button type="submit" class="badge bg-success" style="float:right">Hozzáadás</button>
                        </td>
                    </form>
                    </tr>
                @endforeach
                </table>
                {{-- Ha már van tag --}}
                @else
                    @if (count($nonmembers) == 0)
                        <h4 class="h4-custom"> Mindenki a csoport tagja, aki a csoport tagja lehet. </h4>
                    @else
                    <h4>Tagok hozzáadása</h4>
                    <table class="table table-custom table-borderless">
                        <tr>
                            <th>Vezetéknév</th>
                            <th>Utónév</th>
                            <th></th>
                        </tr>
                    @foreach ($nonmembers as $fof)
                        <tr>
                        <form action="{{ route('Grpmbr.Store') }}" method="POST">
                        @csrf
                            
                            <input type="hidden" value="{{ $group[0]->id }}" name="groupID">
                            <input type="hidden" value="{{ $fof->id }}" name="memberID">
                            <td>{{ $fof->lastname }}</td>
                            <td>{{ $fof->firstname }}</td>
                            <td>
                                <button type="submit" class="badge bg-success" style="float:right">Hozzáadás</button>
                            </td>
                        </form>
                        </tr>
                    @endforeach
                   
                    </table>  
                    @endif
                @endif
            </div>

        </div>
    </body>