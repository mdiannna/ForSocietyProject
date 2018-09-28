<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>ForS0cietyMap</title>
</head>

<body data-spy="scroll">


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">ForSociety</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link text-danger" href="{{route('alert-map')}}">Alert map</a>
        </li>

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Intervention teams
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{route('alert-info')}}">View alerts</a>
            <div class="dropdown-divider"></div>
            <!-- <a class="dropdown-item" href="/alert-info/buildings-collapsed">Collapsed buildings</a> -->
            <a class="dropdown-item" href="{{route('alert-info.buildings.list')}}">Buildings info</a>
          </div>
        </li>

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Recent earthquakes
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/earthquakes/all">Worldwide</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route('earthquakes.romania')}}">Romania</a>
            <a class="dropdown-item" href="{{route('earthquakes.romania.past-hour')}}">Romania - past hour</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('before-earthquake')}}">Prepare and learn</a>
        </li>


      </ul>
      <form class="form-inline my-2 my-lg-0">
      <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
      </form>
    </div>
  </nav>
   @yield('banner')

  <div class="container pt-3">

   @yield('content')

 </div>
 <footer>
  <div class="container">

    <div class="row">
      <div class="col-md-12 col-lg-12">
        <p>&copy; ForS0ciety</p>
      </div>
    </div>
  </div>
</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>

</html>