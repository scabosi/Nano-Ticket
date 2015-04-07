<?php session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
  header ("Location: index.php");
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

    <title>Neues Ticket</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-select.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/template.css" rel="stylesheet">
    <script src="/js/jquery-1.11.1.min.js"></script>
    <script src="/js/bootstrap-select.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script><style type="text/css"></style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script>
      $(document).ready(function () {

            console.log("test");

            get_session_data();

            $('.selectpicker').selectpicker();
            get_elemts();
      });


      function get_session_data(){

        var url = "/assets/get_uid.php";

        $.ajax({
               type: "GET",
               url: url,
               success: function(data)
               {
                  session_data = jQuery.parseJSON( data );

                  console.log(session_data);

                  $("#name_brand").empty();
                  $("#name_brand").append(vorname+" "+nachname);

               }
        });

      }

      function get_elemts() {

        $.ajax({
                url: "/assets/elements.php",
                type: "GET",
                data: {

                },
                success: function(response)
                {
                    var obj = jQuery.parseJSON( response );

                    $("#raum").empty();
                    $("#grund").empty();


                    $.each( obj.raum, function( key, value ) {
                          $("#raum").append("<option value='"+value.id+"'>"+value.raum+"</option>");
                    });

                    $.each( obj.grund, function( key, value ) {
                          $("#grund").append("<option value='"+value.id+"'>"+value.raum+"</option>");
                    });

                    $('.selectpicker').selectpicker('refresh');

                }
            });

      }

      function submit_data() {


        $.ajax({
                url: "assets/insert.php",
                type: "POST",
                data: {
                    raum: $('#raum option:selected').val(),
                    grund: $('#grund option:selected').val(),
                    produktion: $("#produktion").val(),
                    prio: $("input:radio:checked").val(),
                    note: $("#note").val(),
                    ruf: "1",
                    status:"0"

                },
                success: function(response)
                {

                  console.log(response);

                  if (response > 0) {
                    $("#success_modal").modal('show')
                  }
                  else {
                    console.log("error");

                  }

                }
            });
      }

    </script>



  </head>
  <body>
    <div id="success_modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Neues Ticket</h4>
          </div>
          <div class="modal-body">
            <p>Das Ticket wurde erfolgreich eingereicht.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="error_modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Neues Ticket</h4>
          </div>
          <div class="modal-body">
            <p>Das Ticket konnte nicht gesendet werden. Bitte wenden Sie sich an einen Administrator</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
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
            <li class="active"><a href="myticket.html">Meine Tickets</a></li>
            <li><a href="assets/logout.php">Logout</a></li>
          </ul>
          <div id="badge_container">
            <span class="badge badge-open">6</span>
            <span class="badge badge-busy">1</span>
            <span class="badge badge-closed">24</span>
          </div>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <div class="starter-template">
        <h2>Ein neues Ticket einreichen</h2>
        <div id="main_panel" class="panel panel-default">
          <div class="row">

           <div class="col-md-6">
            <form class="form-horizontal" role="form">
              <div class="form-group">
                <label for="inputEmail3" class="col-md-4 control-label">Raum</label>
                <div class="col-md-6">
                  <select id="raum" class="selectpicker">
                    <option>Atelier 1</option>
                    <option>Atelier 2</option>
                    <option>Atelier 3</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-md-4 control-label">Produktion</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="produktion" placeholder="">
                </div>
              </div>
            </form>
          </div>

          <div class="col-md-6">
            <form class="form-horizontal" role="form">
              <div class="form-group">
                <label for="inputEmail3" class="col-md-4 control-label">Ticketgrund</label>
                <div class="col-md-6">
                  <select id="grund" class="selectpicker">
                    <option>Video</option>
                    <option>ProTools</option>
                    <option>SAN</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-md-4 control-label">Rückruf</label>
                <div class="col-md-6">
                  <label class="control-label" >
                  <input type="checkbox" value="ruf">
                </label>
                </div>
              </div>
            </form>
          </div>
         </div>

         <div class="radio_prod">

           <div class="radio">
            <label>
              <input type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked>
             info
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="optionsRadios" id="optionsRadios2" value="2">
              produktionsbehindernd
            </label>
          </div>
          <div class="radio disabled">
            <label>
              <input type="radio" name="optionsRadios" id="optionsRadios3" value="3" >
              produktionsverhindernd
            </label>
          </div>

        </div>

          <h4>Beschreiben Sie das Problem (max 500 Zeichen):</h4>
          <textarea id="note" class="form-control" rows="3"></textarea>

        </div>
        <button id="submit" type="button" class="btn btn-success btn-lg">Absenden</button>

        <script>$('#submit').click(function() {
          submit_data();
        });
        </script>


      </div>
    </div><!-- /.container -->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>


</body></html>
