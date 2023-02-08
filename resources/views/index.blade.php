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

        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h2>Üdvözöllek</h2>
                <p class="pt-1" style="text-align:justify">Ez a webalkalmazás egy hipotetikus embercsoport egymás közti kapcsolatainak kezelésére, és lehetséges barátcsoportok létrehozására szolgál. A weboldal 3 modulból épül fel, amiket a navigációs soron megtalálsz.</p>
                <p class="pt-1" style="text-align:justify">Az elsővel, az "<a href="{{ route('People.Create') }}">Emberek hozzáadásával</a>", a 'People' adattáblához lehet embereket hozzáfűzni.</p>
                <p class="pt-1" style="text-align:justify">A másodikra, az "<a href="{{ route('People.Manage') }}">Ember szerkesztésére</a>", rákattintva, először is a már létrehozott adatsorokat lehet megtekinteni, ha van ilyen. Ellenkező esetben az oldal arra utasít bennünket, hogy adjuk a 'People' táblához egy sort. Ha nem üres a 'People' tábla, akkor soronként módosíthatjuk az adatait, valamint az illető kapcsolatait lehet szerkeszteni itt, a 'Relationship' táblán végzett változtatásokkal. Továbbá meg lehet tekinteni, hogy adott ember milyen barátcsoportok tagja, és szükség esetén ki lehet léptetni ezekből.</p>
                <p class="pt-1" style="text-align:justify">Végül, a "<a href="{{ route('Group.Manage') }}">Barátcsoportok szerkesztésére</a>" navigálva, először arra utasít bennünket a weboldal, hogy hozzunk létre csoportot. Ha már léteznek csoportok, akkor ugyanitt a 'Groups' tábla tartalmát láthatjuk listázva. Ezekhez tudunk új táblát adni, illetve a meglévőket szerkeszthetjük.
            </div>
            <div class="col-3"></div>
        </div>
    </body>
</html>
