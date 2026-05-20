<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard </title>

  <!-- ICONS -->
  <link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

  <style>

    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
      font-family:Arial, sans-serif;
    }

    body{
      display:flex;
      background:#f4f7fc;
      min-height:100vh;
    }

    /* SIDEBAR */

    .sidebar{
      width:260px;
      background:linear-gradient(180deg,#0d47d9,#0039cb);
      color:white;
      padding:25px;
      position:fixed;
      height:100%;
      display:flex;
      flex-direction:column;
      justify-content:space-between;
    }

    .logo{
      font-size:34px;
      font-weight:bold;
      margin-bottom:40px;
    }

    .menu{
      list-style:none;
    }

    .menu li{
      padding:15px 18px;
      margin-bottom:12px;
      border-radius:14px;
      cursor:pointer;
      transition:0.3s;
      display:flex;
      align-items:center;
      gap:15px;
      font-size:17px;
    }

    .menu li:hover,
    .menu .active{
      background:rgba(255,255,255,0.15);
    }

    .admin-box{
      background:rgba(255,255,255,0.1);
      padding:15px;
      border-radius:18px;
      text-align:center;
    }

    .admin-box img{
      width:50px;
      height:50px;
      border-radius:50%;
      margin-bottom:08px;
    }

    /* MAIN */

    .main{
      margin-left:260px;
      width:100%;
      padding:30px;
    }

    /* NAVBAR */

    .navbar{
      background:white;
      border-radius:22px;
      padding:18px 25px;
      display:flex;
      justify-content:space-between;
      align-items:center;
      box-shadow:0 5px 15px rgba(0,0,0,0.05);
      margin-bottom:30px;
    }

    .search-box{
      background:#f4f7fc;
      padding:12px 18px;
      border-radius:12px;
      width:380px;
      display:flex;
      align-items:center;
      gap:10px;
    }

    .search-box input{
      border:none;
      background:none;
      outline:none;
      width:100%;
      font-size:15px;
    }

    .nav-icons{
      display:flex;
      align-items:center;
      gap:20px;
    }

    .icon{
      width:45px;
      height:45px;
      border-radius:12px;
      background:#f4f7fc;
      display:flex;
      align-items:center;
      justify-content:center;
      cursor:pointer;
      transition:0.3s;
    }

    .icon:hover{
      background:#0d47d9;
      color:white;
    }

    .profile{
      display:flex;
      align-items:center;
      gap:12px;
    }

    .profile img{
      width:50px;
      height:50px;
      border-radius:50%;
    }

    /* TITLE */

    .title{
      margin-bottom:25px;
    }

    .title h1{
      font-size:35px;
      color:#222;
      margin-bottom:8px;
    }

    .title p{
      color:#777;
    }

    /* CARDS */

    .cards{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
      gap:20px;
      margin-bottom:30px;
    }

    .card{
      background:white;
      padding:25px;
      border-radius:22px;
      box-shadow:0 5px 15px rgba(0,0,0,0.05);
      transition:0.3s;
      position:relative;
      overflow:hidden;
    }

    .card:hover{
      transform:translateY(-6px);
    }

    .card .top{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:15px;
    }

    .card .icon-box{
      width:60px;
      height:60px;
      border-radius:18px;
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:24px;
      color:white;
    }

    .blue{background:#0d47d9;}
    .green{background:#00b894;}
    .orange{background:#ff9800;}
    .purple{background:#8e44ad;}

    .card h3{
      color:#777;
      margin-bottom:10px;
    }

    .card h2{
      font-size:32px;
      color:#222;
    }

    /* CONTENT */

    .content{
      display:grid;
      grid-template-columns:2fr 1fr;
      gap:25px;
      margin-bottom:30px;
    }

    .chart,
    .orders{
      background:white;
      padding:25px;
      border-radius:22px;
      box-shadow:0 5px 15px rgba(0,0,0,0.05);
    }

    .chart h2,
    .orders h2{
      margin-bottom:20px;
    }

    /* GRAPH */

    .graph{
      height:350px;
      display:flex;
      align-items:flex-end;
      gap:18px;
      padding:20px;
    }

    .bar{
      flex:1;
      background:linear-gradient(to top,#0d47d9,#6ea8ff);
      border-radius:12px 12px 0 0;
      animation:grow 1.5s ease forwards;
      transform-origin:bottom;
    }

    .bar:nth-child(1){height:120px;}
    .bar:nth-child(2){height:180px;}
    .bar:nth-child(3){height:140px;}
    .bar:nth-child(4){height:250px;}
    .bar:nth-child(5){height:220px;}
    .bar:nth-child(6){height:300px;}

    @keyframes grow{
      from{
        transform:scaleY(0);
      }
      to{
        transform:scaleY(1);
      }
    }

    /* TABLE */

    table{
      width:100%;
      border-collapse:collapse;
    }

    table tr{
      border-bottom:1px solid #eee;
    }

    table td{
      padding:16px 0;
      color:#555;
    }

    .status{
      padding:6px 14px;
      border-radius:20px;
      font-size:14px;
      color:white;
    }

    .success{
      background:#00b894;
    }

    .pending{
      background:#ff9800;
    }

    /* STATS BARS */

    .stats{
      background:white;
      padding:25px;
      border-radius:22px;
      box-shadow:0 5px 15px rgba(0,0,0,0.05);
    }

    .stats h2{
      margin-bottom:25px;
    }

    .stat{
      margin-bottom:22px;
    }

    .stat-info{
      display:flex;
      justify-content:space-between;
      margin-bottom:8px;
    }

    .progress{
      width:100%;
      height:14px;
      background:#e9f1ff;
      border-radius:20px;
      overflow:hidden;
    }

    .progress div{
      height:100%;
      border-radius:20px;
      animation:load 2s ease forwards;
    }

    .p1{
      width:90%;
      background:#0d47d9;
    }

    .p2{
      width:75%;
      background:#00b894;
    }

    .p3{
      width:60%;
      background:#ff9800;
    }

    .p4{
      width:85%;
      background:#8e44ad;
    }

    @keyframes load{
      from{
        width:0;
      }
    }

    /* RESPONSIVE */

    @media(max-width:1100px){

      .content{
        grid-template-columns:1fr;
      }

    }

    @media(max-width:900px){

      .sidebar{
        width:100%;
        height:auto;
        position:relative;
      }

      .main{
        margin-left:0;
      }

      body{
        flex-direction:column;
      }

    }

    @media(max-width:768px){

      .navbar{
        flex-direction:column;
        gap:15px;
      }

      .search-box{
        width:100%;
      }

      .cards{
        grid-template-columns:1fr;
      }

      .graph{
        height:250px;
      }

    }

  </style>

</head>
<body>

  <!-- SIDEBAR -->

  <div class="sidebar">

    <div>

      <div class="logo">
        TechStore
      </div>

      <ul class="menu">

        <li class="active">
          <i class="fa-solid fa-house"></i>
          Dashboard
        </li>

        <li>
          <i class="fa-solid fa-box"></i>
          Produits
        </li>

        <li>
          <i class="fa-solid fa-cart-shopping"></i>
          Commandes
        </li>

        <li>
          <i class="fa-solid fa-users"></i>
          Clients
        </li>

        <li>
          <i class="fa-solid fa-credit-card"></i>
          Paiements
        </li>

        <li>
          <i class="fa-solid fa-chart-column"></i>
          Statistiques
        </li>

        <li>
          <i class="fa-solid fa-gear"></i>
          Paramètres
        </li>
        <li> <a href="../public/index.php">Retour au site</a> </li>

      </ul>
    
        
    </div>

    <div class="admin-box">

      <img src="" alt="">

      <h3>Admin</h3>
      <p>admin@techstore.com</p>

    </div>
  

  </div>

  <!-- MAIN -->

  <div class="main">

    <!-- NAVBAR -->

    <div class="navbar">

      <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Rechercher un produit...">
      </div>

      <div class="nav-icons">

        <div class="icon">
          <i class="fa-regular fa-bell"></i>
        </div>

        <div class="icon">
          <i class="fa-regular fa-envelope"></i>
        </div>

        <div class="profile">

          <img src="https://pin.it/4t7yO1Oon" alt="">
          <h3>Bonjour Admin</h3>

        </div>

      </div>

    </div>

    <!-- TITLE -->

    <div class="title">

      <h1>Dashboard</h1>
      <p>Bienvenue sur votre espace d’administration.</p>

    </div>

    <!-- CARDS -->

    <div class="cards">

      <div class="card">

        <div class="top">
          <div>
            <h3>Ventes</h3>
            <h2>25M</h2>
          </div>

          <div class="icon-box blue">
            <i class="fa-solid fa-dollar-sign"></i>
          </div>
        </div>

      </div>

      <div class="card">

        <div class="top">
          <div>
            <h3>Clients</h3>
            <h2>892</h2>
          </div>

          <div class="icon-box green">
            <i class="fa-solid fa-users"></i>
          </div>
        </div>

      </div>

      <div class="card">

        <div class="top">
          <div>
            <h3>Produits</h3>
            <h2>320</h2>
          </div>

          <div class="icon-box orange">
            <i class="fa-solid fa-box"></i>
          </div>
        </div>

      </div>

      <div class="card">

        <div class="top">
          <div>
            <h3>Commandes</h3>
            <h2>1 245</h2>
          </div>

          <div class="icon-box purple">
            <i class="fa-solid fa-cart-shopping"></i>
          </div>
        </div>

      </div>

    </div>

    <!-- CONTENT -->

    <div class="content">

      <!-- CHART -->

      <div class="chart">

        <h2>Statistiques des ventes</h2>

        <div class="graph">

          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>

        </div>

      </div>

      <!-- ORDERS -->

      <div class="orders">

        <h2>Commandes récentes</h2>

        <table>

          <tr>
            <td>PC Gamer</td>
            <td><span class="status success">Livré</span></td>
          </tr>

          <tr>
            <td>Clavier RGB</td>
            <td><span class="status pending">En attente</span></td>
          </tr>

          <tr>
            <td>Écran HP</td>
            <td><span class="status success">Livré</span></td>
          </tr>

          <tr>
            <td>Souris Logitech</td>
            <td><span class="status success">Livré</span></td>
          </tr>

        </table>

      </div>

    </div>

    <!-- STATS -->

    <div class="stats">

      <h2>Performance Produits</h2>

      <div class="stat">

        <div class="stat-info">
          <span>Ordinateurs</span>
          <span>90%</span>
        </div>

        <div class="progress">
          <div class="p1"></div>
        </div>

      </div>

      <div class="stat">

        <div class="stat-info">
          <span>Claviers</span>
          <span>75%</span>
        </div>

        <div class="progress">
          <div class="p2"></div>
        </div>

      </div>

      <div class="stat">

        <div class="stat-info">
          <span>Souris</span>
          <span>60%</span>
        </div>

        <div class="progress">
          <div class="p3"></div>
        </div>

      </div>

      <div class="stat">

        <div class="stat-info">
          <span>Écrans</span>
          <span>85%</span>
        </div>

        <div class="progress">
          <div class="p4"></div>
        </div>

      </div>

    </div>

  </div>

</body>
</html>