<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css"> <!-- Use version 1.11.6 CSS -->

    <title>Manage Funeral Service</title>

    <style type="text/css">
      .addbtn{
        float: right;
      }
      body {
        font-family: "Lato", sans-serif;
      }

      .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
      }

      .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
      }

      .sidenav a:hover {
        color: #f1f1f1;
      }

      .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
      }

      @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
      }
      /* Style for the horizontal lines */
      hr {
          border: none;
          height: 2px; /* Adjust the height as needed */
          background-color: white; /* Color of the line */
          opacity: 0.5; /* Adjust the opacity to make it less prominent */
          margin: 5px 0; /* Adjust the margin for spacing */
      }
    </style>
  </head>
  <body>
    <?php
    if ($this->session->userdata('UserLoginSession')) {
        $udata = $this->session->userdata('UserLoginSession');
        $welcomeMessage = 'Manage Funeral Service';
        ?>
        <nav class="navbar navbar-dark bg-dark">
          <div class="navbar-nav">
            <span class="" style="font-size:30px;cursor:pointer; color: white; padding-left: 10px" onclick="openNav()">&#9776; Menu</span>
            <div id="mySidenav" class="sidenav">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
          <a href="<?=base_url('dashboard')?>">Dashboard</a>
          <hr>
          <a href="<?=base_url('Inventory')?>">Inventory</a>
          <hr>
          <a href="#">Scheduler</a>
          <hr>
          <a href="<?=base_url('Monitoring_Bill')?>">Monitoring Bill</a>
          <hr>
          <a href="#">Start to End Transaction Record</a>
          <hr>
          <a href="#">Report</a>
          <hr>
        </div>
          </div>
            <a class="navbar-brand"><?php echo $welcomeMessage; ?></a>
            <div class="navbar-nav ml-auto" style="padding-right: 10px;">
              <a class="btn btn-primary ml-auto" href="<?= base_url('logout') ?>">Log Out</a>
            </div>
        </nav>
    <?php
    } else {
        redirect(base_url('home'));
    }
    ?>
    <div class="container">
      <div class="container mt-4">
        <div class="card">
          <div class="card-header">
            <a class="btn btn btn-primary addbtn" href="<?= base_url('funeralservices/add')?>">Add Service</a>
          </div>
          <div class="card-body">
            <table id="funeralservicetable" class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Service Name</th>
                <th>Description</th>
                <th>Pricing</th>
                <th>Associated Products</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody id="table-body">
              <?php
                foreach ($services as $row) : ?>
                  
                <tr>
                  <td><?= $row->service_id; ?></td>
                  <td><?= $row->service_name; ?></td>
                  <td><?= $row->description; ?></td>
                  <td><?= $row->price; ?></td>
                  <td><?= $row->associated_products; ?></td>

                  <td><a href="<?=base_url('funeralservices/edit/'.$row->service_id)?>" class="btn btn-success">Edit</a></td>

                  <td><button class="btn btn-danger" onclick="confirmDelete(<?= $row->service_id ?>)">Delete</button></td>

                  <!--<td><a href="?=base_url('funeralservices/delete/'.$row->service_id)?" class="btn btn-danger">Delete</a></td>-->

                  <td><button class="btn btn-warning archive">Archive</button></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function(){
        $('#funeralservicetable').DataTable(); // Initialize DataTables on your table
      });
    </script>
    <script type="text/javascript">
      //delete the data within the table of funeral service
      function confirmDelete(serviceId)
      {
        if (confirm("Are you sure you want to delete this service?"))
        {
          window.location.href = '<?= base_url('funeralservices/delete/') ?>' + serviceId;
        }
      }

      function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
      }

      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
      }
    </script>
  </body>
</html>
