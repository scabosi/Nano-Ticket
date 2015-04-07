<?php session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '') || $_SESSION['admin'] !="1") {
  header ("Location: /index.php?login=not_admin");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Admin Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-select.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/template.css" rel="stylesheet">
    <link href="../css/dashboard.css" rel="stylesheet">
    <link href="../css/sticky-footer.css" rel="stylesheet">
    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap-select.js"></script>
    <script src="../chart/Chart.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>

    <style type="text/css"></style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->



  </head>

  <body>
    <div  id="modal_ticket_details" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Ticket Details | Ticketnummer: <span id="ticket_id"></span></h4>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-md-6 lead"><span>Produktion: </span><span id="produktion"></span></div>
              <div class="col-md-6 lead"><span>Datum: </span><span id="datum"></span></div>
            </div>

             <div class="row">
              <div class="col-md-6 lead"><span>Grund: </span><span id="grund"></span></div>
              <div class="col-md-6 lead"><span>Raum: </span><span id="raum"></span></div>
            </div>

            <p>Benutzeranfrage:<p>
            <textarea id="user_text" class="form-control" rows="3"readonly></textarea>
            <p>Antwort:<p>
            <textarea id="admin_text" class="form-control" rows="3"></textarea>
          </div>
          <div class="modal-footer">
            <button id="button_save" type="button" class="btn btn-warning" data-dismiss="modal">Speichern & Schliessen</button>
            <button id="button_close" type="button" class="btn btn-success" data-dismiss="modal"> Ticket schliessen</button>

              <script>

              $("#button_save").click(function() {
                update_ticket();
              });

              $("#button_close").click(function() {
               close_ticket();
              });


              </script>

          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span id="name_brand" class="navbar-brand" ></span>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">

             <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Einstellungen <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Authentifizierung</a></li>
                  <li><a href="#">Benutzer</a></li>
                  <li><a href="#">Mail</a></li>
                  <li><a href="#">Umgebung</a></li>
                </ul>
              </li>

            <li><a href="assets/logout.php">Logout</a></li>
          </ul>
          <div id="badge_container">
            <span id="badge_top_0" class="badge badge-open"></span>
            <span id="badge_top_1" class="badge badge-busy"></span>
            <span id="badge_top_2" class="badge badge-closed"></span>
          </div>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container-fluid">

        <div class="row">
          <div class="col-md-3 col-md-2">
                <ul class="nav nav-sidebar sibebar2">
                  <li  class="active" ><a href="#">Dashboard Home</a>  </li>
                </ul>
                <ul class="nav nav-sidebar sibebar2">
                  <li><a href="../admin/dashboard_tickets.php"><span style="width:110px;display:inline-block">Neue Tickets</span> <span id="badge_left_0" class="badge"></span></a>  </li>
                  <li><a href="../admin/dashboard_tickets.php"><span style="width:110px;display:inline-block">In Bearbeitung</span> <span id="badge_left_1" class="badge"></span></a>  </li>
                  <li><a href="../admin/dashboard_tickets.php"><span style="width:110px;display:inline-block">Geschlossen</span> <span id="badge_left_2" class="badge"></span></a>  </li>
                </ul>
                <ul class="nav nav-sidebar sibebar2">
                  <li  ><a href="#">Tickets nach Räumen</a>  </li>
                  <li  ><a href="#">Tickets nach Grund</a>  </li>

                  <li  ><a href="#">Tickets nach User</a>  </li>
                </ul>
                <ul class="nav nav-sidebar sibebar2">
                  <li  ><a href="#">Tickets suchen</a>  </li>
                </ul>
          </div>

          <div class="col-md-8 col-sm.offset-3 col-md-10 col-md-offset-1">

            <h3 class="sub-header">Neue Tickets</h3>
            <div class="row placeholders" style="height:222px">
                <div class="table-responsive" >
                  <table id="ticket_table" class="table table-hover">
                    <thead>
                      <tr>
                        <th class="col-sm-1">#</th>
                        <th class="col-sm-2">Datum</th>
                        <th class="col-sm-1">Uhrzeit</th>
                        <th class="col-sm-2">Raum</th>
                        <th class="col-sm-2">Grund</th>
                        <th class="col-sm-4">Fehler</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>

                  </table>
                </div>

              </table>
            </div>

            <h3 class="sub-header">Ticketverteilung</h3>
            <div class="row placeholders">
                <div class="chart_wrapper">
                  <div><p class="text-center">Tickets nach Status</p></div>
                  <canvas id="chart-area1" width="170" height="160"></canvas>
                </div>

                <div class="chart_wrapper">
                  <div><p class="text-center">Tickets nach Räumen</p></div>
                  <canvas id="chart-area2" width="170" height="160"></canvas>
                </div>

                <div class="chart_wrapper">
                  <div><p class="text-center">Tickets nach Grund</p></div>
                  <canvas id="chart-area3" width="170" height="160"></canvas>
                </div>
            </div>


            <h3 class="sub-header">Anzahl der Tickets in den vergangen 6 Monaten</h3>
            <div class="row placeholders">
                <div class="chart_wrapper_line">

                  <canvas id="chart-area4" height="160" ></canvas>
                </div>
            </div>


          </div>
        </div>
    </div><!-- /.container -->

    <footer class="footer">
      <div class="container">
        <p class="text-muted">ProTicket | Tibor Banvölgyi 2014</p>
      </div>
    </footer>

    <script>

        function get_status_count(){

        $.ajax({
                url: "assets/status_info.php",
                type: "POST",
                data: {
                    status: 0

                },
                success: function(response)
                {

                obj = jQuery.parseJSON( response );


                for (x=0;x<3;x++) {
                  $("#badge_top_"+x).empty();
                  $("#badge_top_"+x).html(obj[x].count);
                  $("#badge_left_"+x).empty();
                  $("#badge_left_"+x).html(obj[x].count);
                }
                }
        });

      }

        function update_ticket() {
          console.log("update");
          var ticket_id=$("#ticket_id").html();

          var admin_text=$("#admin_text").val();
          $.ajax({
              url: "assets/ticket_update.php",
              type: "POST",
              data: {
                  status: 1,
                  index:parseInt(ticket_id),
                  text_admin:admin_text
              },
              success: function(response)
              {
                obj = response ;
                if (obj.trim()!="OK") {
                  alert("Fehler beim Update in die Datenbank!");
                  alert(obj);
                }
                get_top5_tickets();
                get_diagramm_data();

              }
          });


        }

        function close_ticket() {
          console.log("close");
          var ticket_id=$("#ticket_id").html();
          console.log(ticket_id);
          var admin_text=$("#admin_text").val();
          $.ajax({
              url: "assets/ticket_update.php",
              type: "POST",
              data: {
                  status: 2,
                  index:parseInt(ticket_id),
                  text_admin:admin_text
              },
              success: function(response)
              {
                obj = response ;
                if (obj.trim()!="OK") {
                  alert("Fehler beim Update in die Datenbank!");
                  alert(obj);
                }
                get_top5_tickets();
                get_diagramm_data();

              }
          });
        }

      $(document).ready(function () {
            get_status_count();

            $('.selectpicker').selectpicker();

            var cookie = document.cookie;

            var cookie_elements=cookie.split(";");

            for (x=0;x<cookie_elements.length;x++) {

              var atom = cookie_elements[x].split("=");

              if (atom[0]=="username") {
                console.log (atom[1]);
              }

              if (atom[0]==" vorname") {

                var vorname=atom[1];
              }

              if (atom[0]==" nachname") {

                var nachname=atom[1]
              }


            }

            $("#name_brand").empty();
            $("#name_brand").append("Admin | "+vorname+" "+nachname);


            var ctx1 = document.getElementById("chart-area1").getContext("2d");
            var ctx2 = document.getElementById("chart-area2").getContext("2d");
            var ctx3 = document.getElementById("chart-area3").getContext("2d");



            myPie1 = new Chart(ctx1).Pie(pieData1);
            myPie2 = new Chart(ctx2).Pie(pieData2);
            myPie3 = new Chart(ctx3).Pie(pieData3);

            var ctx4 = document.getElementById("chart-area4").getContext("2d");
            var myBarChart = new Chart(ctx4).Line(data, {responsive: true,maintainAspectRatio: false} );


            Chart.defaults.global = {responsive : true,scaleBeginAtZero: true,scaleStartValue: 0,};


            get_diagramm_data(myBarChart);
            get_top5_tickets();
            get_line_diagramm_data(myBarChart);

            setInterval(function() {
              get_top5_tickets();
              get_diagramm_data();
              get_status_count();
            }, 15000);
      });

        var data = {
             labels: [1, 2],
            datasets: [
                {
                  fillColor: "rgba(151,187,205,0.2)",
                  strokeColor: "rgba(151,187,205,1)",
                  pointColor: "rgba(151,187,205,1)",
                  pointStrokeColor: "#fff",
                  data: [0, 0]
                }

            ]
        };


        var pieData1 = [
          {
            value: 10,
            color:"#d9534f",
            highlight: "#d9534f",
            label: "offen"
          },
          {
            value: 10,
            color: "#f0ad4e",
            highlight: "#f0ad4e",
            label: "in Bearbeitung"
          },
          {
            value: 100,
            color: "#5cb85c",
            highlight: "#5cb85c",
            label: "geschlossen"
          }


        ];



         var pieData2 = [
          {
            value: 10,
            color:"#0D8EDB",
            highlight: "#0D8EDB",
            label: "Atelier 1"
          },
          {
            value: 50,
            color: "#5FB2E3",
            highlight: "#5FB2E3",
            label: "Atelier 2"
          },
          {
            value: 70,
            color: "#36A0DE",
            highlight: "#36A0DE",
            label: "Atelier 3"
          }


        ];


         var pieData3 = [
          {
            value: 20,
            color:"#FF8D01",
            highlight: "#FF8D01",
            label: "Audio"
          },
          {
            value: 150,
            color: "#FFB962",
            highlight: "#FFB962",
            label: "Video"
          },
          {
            value: 70,
            color: "#FF6433",
            highlight: "#FF6433",
            label: "Office IT"
          }

        ];


    var months=["Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember"];

    $.fn.reverseList = [].reverse;



    function get_line_diagramm_data(myBarChart){
       $.ajax({
                url: "assets/ticket_count_six_month.php",
                type: "POST",
                data: {
                    username: "Test"
                },
                success: function(response)
                {
                  obj = jQuery.parseJSON( response );

                  var data_length=myBarChart.datasets[0].points.length;



                  for (x=0;x<obj.length;x++) {

                    myBarChart.addData([obj[x].count], months[obj[x].month-1]);

                  }


                  myBarChart.removeData();
                  myBarChart.removeData();

                 myBarChart.update();

                }
        });
    }

    function get_diagramm_data() {

        $.ajax({
                url: "assets/status_count.php",
                type: "POST",
                data: {
                    username: "Test"
                },
                success: function(response)
                {
                  obj = jQuery.parseJSON( response );

                  for (x=0;x<3;x++){

                    myPie1.segments[x].value=parseInt(obj[x].status_count);
                    myPie1.update();
                  }

                }
        });

          $.ajax({
                url: "assets/room_count.php",
                type: "POST",
                data: {
                    username: "Test"
                },
                success: function(response)
                {
                  obj = jQuery.parseJSON( response );

                  for (x=0;x<3;x++){

                    myPie2.segments[x].value=parseInt(obj[x].raum_count);
                    myPie2.segments[x].label=obj[x].raum;
                    myPie2.update();
                  }

                }
        });

          $.ajax({
                url: "assets/reason_count.php",
                type: "POST",
                data: {
                    username: "Test"
                },
                success: function(response)
                {
                  obj = jQuery.parseJSON( response );

                  for (x=0;x<3;x++){

                    myPie3.segments[x].value=parseInt(obj[x].grund_count);
                    myPie3.segments[x].label=obj[x].grund;
                    myPie3.update();
                  }

                }
        });



    }




    function get_top5_tickets() {

        $.ajax({
                url: "assets/new_tickets_top.php",
                type: "POST",
                data: {
                    username: "Test"
                },
                success: function(response)
                {
                   obj = jQuery.parseJSON( response );

                   var new_items = [];

                   var old_items = [];

                   var found=0;

                    $.each( obj, function( key, value ) {
                      found=0;
                      $('.table_row').each(function() {
                        if (value.id==$(this).attr("id")) {
                          found=1;
                        }
                      });
                      if (found==0) {
                        new_items.push(value.id);
                      }
                    });

                    for (b=0;b<new_items.length;b++) {
                      $("#ticket_table tbody tr:last-child").remove();
                    }



                    for (a=obj.length-1;a>=0;a--){
                          var in_list=0;
                          for (y=0;y<new_items.length;y++) {

                            if (obj[a].id==new_items[y]) {
                              in_list=1
                            }
                          }

                          if (in_list==1) {

                            $("<tr class='table_row' id='"+obj[a].id+"''><td>"+obj[a].id+"</td><td>"+obj[a].datum+"</td><td>"+obj[a].zeit+"</td><td>"+obj[a].raum+"</td><td>"+obj[a].grund+"</td><td>"+obj[a].text_user+"</td></tr>").prependTo("#ticket_table tbody");
                          }
                    }

                    $( ".table_row" ).click(function() {
                      var ticket_id=$( this ).attr("id");

                          $.ajax({
                              url: "assets/ticket_details.php",
                              type: "POST",
                              data: {
                                  ticket_id: ticket_id
                              },
                              success: function(response)
                              {
                                obj = jQuery.parseJSON( response );

                                $("#produktion").empty();
                                $("#grund").empty();
                                $("#datum").empty();
                                $("#raum").empty();
                                $("#user_text").empty();
                                $("#ticket_id").empty();

                                $("#ticket_id").append(obj.ticket_id);
                                $("#raum").append(obj.raum);
                                $("#grund").append(obj.grund);
                                $("#datum").append(obj.datum);
                                $("#produktion").append(obj.produktion);
                                $("#user_text").val(obj.text_user);
                                $("#admin_text").val(obj.text_admin);

                              }
                          });

                          $("#modal_ticket_details").modal("show");


                    });

                }
            });
      }


    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="../js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>


</body></html>
