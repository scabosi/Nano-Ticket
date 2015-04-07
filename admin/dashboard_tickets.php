<?php include 'assets/check_user.php'; /*User überprüfen*/ ?>


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
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/css/bootstrap-select.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/template.css" rel="stylesheet">
    <link href="../css/dashboard.css" rel="stylesheet">
    <link href="../css/sticky-footer.css" rel="stylesheet">
    <script src="../js/jquery-1.11.1.min.js"></script>
     <script src="../js/jquery-ui.js"></script>
    <script src="../dist/js/bootstrap-select.js"></script>
    <script src="../chart/Chart.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../dist/js/ie-emulation-modes-warning.js"></script><style type="text/css"></style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>


    </script>

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
              <div class="col-md-6 lead"><span>Produktion: </span><span id="produktion">Test</span></div>
              <div class="col-md-6 lead"><span>Datum: </span><span id="datum">14.07.2014</span></div>
            </div>             

             <div class="row">
              <div class="col-md-6 lead"><span>Grund: </span><span id="grund">Video</span></div>
              <div class="col-md-6 lead"><span>Raum: </span><span id="raum">Atelier 1</span></div>
            </div> 

            <p>Benutzeranfrage:<p>
            <textarea id="user_text" class="form-control" rows="3"readonly></textarea>
            <p>Antwort:<p>
            <textarea id="admin_text" class="form-control" rows="3"></textarea> 
          </div>
          <div class="modal-footer">
            <button id="button_save" type="button" class="btn btn-warning" >Speichern & Schliessen</button>
            <button id="button_close" type="button" class="btn btn-success" > Ticket schliessen</button> 

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
                  <li><a href="../admin/dashboard.php">Dashboard Home</a>  </li>
                </ul>
                <ul class="nav nav-sidebar sibebar2">                  
                  <li class="active" ><a href="../admin/dashboard_tickets.php"><span style="width:110px;display:inline-block">Neue Tickets</span> <span id="badge_left_0" class="badge"></span></a>  </li>
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
              <div class="table-responsive">
                <table id="ticket_table" class="table table-hover">
                  <tr>
                    <th class="col-sm-1">#</th>
                    <th class="col-sm-2">Datum</th>
                    <th class="col-sm-1">Uhrzeit</th>
                    <th class="col-sm-2">Raum</th>
                    <th class="col-sm-2">Grund</th>
                    <th class="col-sm-4">Fehler</th>
                  <tr>
                </table>
              </div>

              <nav>
                  <ul class="pagination pagination-sm">
                    <li id="prev_page"><a href="#">&laquo;</a></li>               
                  </ul>
              </nav>
          </div>
        </div>       
    </div><!-- /.container -->

    <footer class="footer">
      <div class="container">
        <p class="text-muted">ProTicket | Tibor Banvölgyi 2014</p>
      </div>
    </footer>

    <script>


     function update_ticket() {
          console.log("update");
          var ticket_id=$("#ticket_id").html();
          console.log(ticket_id);
          var admin_text=$("#admin_text").val();
          
          $("#admin_text").animate({backgroundColor: "#FFACA9"}, 100 );
          $("#admin_text").animate({backgroundColor: "#fff"}, 500 );
         
          if (admin_text.length==0) {
            console.log("leer");
          } else {

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
                get_ticket();   
                 $("#modal_ticket_details").modal("hide");
                }
            });

          }

         


        }

        function close_ticket() {
          console.log("close");
          var ticket_id=$("#ticket_id").html();
          console.log(ticket_id);
          var admin_text=$("#admin_text").val();
           if (admin_text.length==0) {
            console.log("leer");
           $("#admin_text").animate({backgroundColor: "#FFACA9"}, 100 );
           $("#admin_text").animate({backgroundColor: "#fff"}, 500 );
          } else {
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
                  get_ticket();  
                  $("#modal_ticket_details").modal("hide");     
                  
                }
            });
          }
        }

        
  function activate_paging_click() {

    $("#prev_page").click(function() {
      prev_page();
     
    });

    $("#next_page").click(function() {
      next_page();
      
    });

    $(".paging").click(function() {
      var id=$(this).attr("id");
      id=id.split("_");
      change_page(id[1]);      
    });

    $("#prev_page_filter").click(function() {
      prev_page_filter();
     
    });

    $("#next_page_filter").click(function() {
      next_page_filter();
      
    });

    $(".paging_filter").click(function() {
      var id=$(this).attr("id");
      id=id.split("_");
      change_page_filter(id[1]);      
    });

  }
    

  </script>

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
                console.log(obj);

                for (x=0;x<3;x++) {
                  $("#badge_top_"+x).empty();
                  $("#badge_top_"+x).html(obj[x].count);
                  $("#badge_left_"+x).empty();
                  $("#badge_left_"+x).html(obj[x].count);
                }
                }
        });

      }

      var obj;

      function next_page() {       

        max_index=0;


        $('.paging').each(function(index) {
            max_index=max_index+1;
            $(this).removeClass("active");

        });    



        if (current_page<max_index) {
          current_page=current_page+1;
        }

        $('.paging').each(function(index) {
          
            if ((index+1)==current_page) {
              $(this).addClass("active");             
            }

        });  
      build_table();    

      }

      function prev_page() {
        max_index=0;

        $('.paging').each(function(index) {
            max_index=max_index+1;
            $(this).removeClass("active");
        });

        if (current_page>1) {
          current_page=current_page-1;
        }

         $('.paging').each(function(index) {
          
            if ((index+1)==current_page) {
              $(this).addClass("active");
            }
                        
        });  
        build_table(); 
       
        
      }

      function change_page(id) {
        max_index=0;

        $('.paging').each(function(index) {
            max_index=max_index+1;
            $(this).removeClass("active");
        });       
        
       $('#i_'+id).addClass("active");
       current_page=parseInt(id); 
       build_table();
      }




      function next_page_filter() {       

        max_index=0;

        $('.paging_filter').each(function(index) {
            max_index=max_index+1;
            $(this).removeClass("active");
        });    



        if (current_page<max_index) {
          current_page=current_page+1;
        }

        $('.paging_filter').each(function(index) {
          
            if ((index+1)==current_page) {
              $(this).addClass("active");             
            }

        });  
        build_table_filter(filter_obj);     

      }

      function prev_page_filter() {
        max_index=0;

        $('.paging').each(function(index) {
            max_index=max_index+1;
            $(this).removeClass("active");
        });

        if (current_page>1) {
          current_page=current_page-1;
        }

         $('.paging_filter').each(function(index) {
          
            if ((index+1)==current_page) {
              $(this).addClass("active");
            }
                        
        });  
        build_table_filter(filter_obj);       
        
      }

      function change_page_filter(id) {
        max_index=0;

        $('.paging_filter').each(function(index) {
            max_index=max_index+1;
            $(this).removeClass("active");
        });       
        
       $('#i_'+id).addClass("active");
       current_page=parseInt(id); 
        build_table_filter(filter_obj);

      }

      var current_page;

      $(document).ready(function () {

            get_status_count();

            current_page = 1;

            $('.selectpicker').selectpicker();

            var cookie = document.cookie;         
            var username;
            var cookie_elements=cookie.split(";");         

            for (x=0;x<cookie_elements.length;x++) {

              var atom = cookie_elements[x].split("=");

              if (atom[0].trim()=="username") {
               
                username=atom[1];
              }

              if (atom[0].trim()=="vorname") {
                
                var vorname=atom[1];
              }

              if (atom[0].trim()=="nachname") {
               
                var nachname=atom[1]
              }
            }

            $("#name_brand").empty();
            $("#name_brand").append(vorname+" "+nachname);

            get_ticket();
      });

      function build_table() {

        $(".pagination").empty();

        $(".pagination").append("<li id='prev_page'><a href='#''>&laquo;</a></li>");      

          for (x=1;x<(Math.floor(obj.length/10)+1);x++) {
             
            $(".pagination").append("<li id='i_"+x+"' class='paging'><a href='#''>"+x+"</a></li>")

          }

        $(".pagination").append("<li id='next_page'><a href='#''>&raquo;</a></li>")
        
        $("#i_"+current_page).addClass("active");

        activate_paging_click();

        $(".tablerow").remove();

        var count_open=0;
        var count_busy=0;
        var count_closed=0;

        max_page = current_page*10;

        if (obj.length<max_page) {
          max_page=obj.length;
        }

        for  (x=((current_page*10)-9);x<=max_page;x++) {

           $("#ticket_table").append("<tr class='tablerow' id='"+obj[x-1].id+"''><td>"+obj[x-1].id+"</td><td>"+obj[x-1].datum+"</td><td>"+obj[x-1].zeit+"</td><td>"+obj[x-1].raum+"</td><td>"+obj[x-1].grund+"</td><td>"+obj[x-1].text_user+"</td></tr>");

              
        } 
      }


      function filter_table(search_value) { 

        var filter_obj = [];     

        for (x=0;x<obj.length;x++) {           

            var result_ticket_room = obj[x].raum.search(new RegExp( search_value, 'i' ));

            if (result_ticket_room > -1) {
             
              filter_obj[filter_obj.length]=obj[x];

            }
        }

        build_filter_table(filter_obj);

      }



      function build_filter_table(filter_obj) {        

        $(".pagination").empty();

        $(".pagination").append("<li id='prev_page_filter'><a href='#''>&laquo;</a></li>");      

          for (x=1;x<(Math.floor(filter_obj.length/10)+1);x++) {
             
            $(".pagination").append("<li id='i_"+x+"' class='paging_filter'><a href='#''>"+x+"</a></li>")

          }

        $(".pagination").append("<li id='next_page_filter'><a href='#''>&raquo;</a></li>")
        $("#i_1").addClass("active");

        $(".tablerow").remove();

        var count_open=0;
        var count_busy=0;
        var count_closed=0;

        max_page = current_page*10;

        if (filter_obj.length<max_page) {
          max_page=filter_obj.length;
        }

        for  (x=((current_page*10)-9);x<=max_page;x++) {

           $("#ticket_table").append("<tr class='tablerow' id='"+filter_obj[x-1].id+"''><td>"+filter_obj[x-1].id+"</td><td>"+filter_obj[x-1].datum+"</td><td>"+filter_obj[x-1].zeit+"</td><td>"+filter_obj[x-1].raum+"</td><td>"+filter_obj[x-1].grund+"</td><td>"+filter_obj[x-1].text_user+"</td></tr>");

                if (obj[x-1].status==0) {
                     count_open=count_open+1;
                     $("#"+filter_obj[x-1].id).addClass("danger");
                }

                 if (obj[x-1].status==1) {
                     count_busy=count_busy+1;
                     $("#"+filter_obj[x-1].id).addClass("warning");
                }

                 if (obj[x-1].status==2) {
                     count_closed=count_closed+1;
                     $("#"+filter_obj[x-1].id).addClass("success");
                }             
        } 

      activate_paging_click();


      }



      function get_ticket() {

        var count_open=0;
        var count_busy=0;
        var count_closed=0;

        $.ajax({
                url: "assets/tickets_all.php",
                type: "POST",
                data: {
                    status: 0                   
                    
                },
                success: function(response)
                {  
                   obj = jQuery.parseJSON( response );

                   for (x=1;x<(Math.floor(obj.length/10)+1);x++) {
                     
                      $(".pagination").append("<li id='i_"+x+"' class='paging'><a href='#''>"+x+"</a></li>")

                   }

                   $(".pagination").append("<li id='next_page'><a href='#''>&raquo;</a></li>")
                   $("#i_1").addClass("active");

                   activate_paging_click();

                   /* $.each( obj, function( key, value ) {

                        if (key<10) {

                          $("#ticket_table").append("<tr class='tablerow' id='"+value.id+"''><td>"+value.id+"</td><td>"+value.datum+"</td><td>"+value.zeit+"</td><td>"+value.raum+"</td><td>"+value.grund+"</td><td>"+value.text_user+"</td></tr>");

                        }                                            
                   });*/

                    build_table();


                    $("#badge_open").empty();
                    $("#badge_open").append(count_open);
                    $("#badge_busy").empty();
                    $("#badge_busy").append(count_busy);
                    $("#badge_closed").empty();
                    $("#badge_closed").append(count_closed);


                    $( ".tablerow" ).click(function() {
                            id=$( this ).attr("id");

                                  $.ajax({
                                    url: "assets/ticket_details.php",
                                    type: "POST",
                                    data: {
                                        ticket_id: id                   
                                        
                                    },
                                    success: function(response)
                                    {  
                                        var obj = jQuery.parseJSON( response );  
                                        
                                        $("#ticket_id").empty();
                                        $("#ticket_id").append(obj.ticket_id);


                                        $("#raum").empty();
                                        $("#grund").empty();
                                        $("#datum").empty();
                                        $("#produktion").empty();

                                        $("#raum").append(obj.raum);
                                        $("#grund").append(obj.grund);
                                        $("#datum").append(obj.datum);
                                        $("#produktion").append(obj.produktion);

                                        $("#user_text").val(obj.text_user);
                                        $("#admin_text").val(obj.text_admin);

                                        $("#modal_ticket_details").modal("show");  

                                    }              

                              });
                    });

                }
            });        

      }


    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="../dist/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../dist/js/ie10-viewport-bug-workaround.js"></script>
  

</body></html>