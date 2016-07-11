<?php require_once 'db.php';?>

  <!doctype	html>
    <html lang="en-US">
    <head>
 		<meta charset="UTF-8">
    	<title>Home | Development</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>

 <div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"> Site Pool</a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <li> <a  class="topnav-item" data-toggle="modal" data-target="#myModal">Create new site link </a></li>
                    <li> <a type="button" class="topnav-item" onclick="location.reload()" > <span class="glyphicon glyphicon-refresh"></span> Reload </a> </li>

                </ul>
            </div>
        </div>
    </nav>



      <table role="presentation" class="table table-striped">

         <thead>
            <th><input type="checkbox" id="checkall" /></th>
            <th>Site Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>

        <tbody class="files">
        <?php
            $stmt = $dbh->prepare('SELECT * from sites');
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                 <tr class="fade in">
                    <td><input type="checkbox" class="checkthis" id="<?php echo $rs->id; ?>" /></td>  <!---->
                    <td> <li class="nav-link"> <a class="nav-item" href="<?php echo $rs->sitelink; ?>"> <?php echo $rs->sitename; ?> </a> </li></td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button name="<?php echo $rs->id; ?>" class="btn btn-primary btn-xs" data-type="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button name="<?php echo $rs->id; ?>" class="btn btn-danger btn-xs" data-type="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                </tr>
       <?php  }
            $dbh = null;
       ?>

        </tbody>
      </table>

    </div>

 <!-- ++++++++++++++++++++++++++++++++++++++++++ CREATE SITE LINK MODAL  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->


                 <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create a site link </h4>
                    </div>

                    <div class="alert-message alert alert-success fade in"> Sucess! </div>


                    <div class="modal-body">

                        <div id="errorwarn_create" class="errorwarn"></div>
                        <form class="sform" name="sform" id="sform" action="" method="post" role="form" data-toggle="validator">
                            <div class="form-group">
                                <label for="sitename">Site name: </label>
                                <input type="text" name="sitename" id="sitename" data-minlength="3" class="form-control" required>
                                <span class="help-block">Minimum of 3 characters</span>

                            </div>
                            <div class="form-group">
                                <label for="sitetype">Site type: </label>
                                <input type="text" name="sitetype" id="sitetype" class="form-control"  required>

                            </div>
                            <div class="form-group">
                                <label for="sitelink">Site link: </label>
                                <input type="text" name="sitelink" id="sitelink" class="form-control"   data-minlength="10" value="<?php echo 'http://' ?>" required>
                                <span class="help-block">Minimum of 10 characters</span>
                            </div>
                                <button type="submit" id="post_create" name="post_create" class="btn btn-success form-group"> Create </button>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </div>

            </div>
      </div>


<!-- ++++++++++++++++++++++++++++++++++++++++++  EDIT MODAL++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
            </div>

            <form id="do_update" action=""  method="post" role="form"  data-toggle="validator">
                <div class="modal-body">
                <div id="errorwarn_update" class="errorwarn"></div>
                    <div class="form-group">
                        <input id="update_sitename" name="update_site_name" class="form-control " type="text" required>
                    </div>
                    <div class="form-group">
                        <input id="update_sitetype" name="update_site_type" class="form-control " type="text" required>
                    </div>
                    <div class="form-group">
                        <input id="update_sitelink" name="update_site_link" class="form-control " type="text" required>
                    </div>

                </div>
                <div class="modal-footer ">
                    <button type="submit" name="go_update" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
                </div>
            </form>
        </div>
    <!-- /.modal-content -->
    </div>
      <!-- /.modal-dialog -->
</div>

<!-- ++++++++++++++++++++++++++++++++++++++++++ DELETE CONFIRM MODAL ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                </div>

                <div class="modal-body">
                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
                </div>

                <div class="modal-footer ">
                    <button type="button" class="btn btn-success" data-type="yes-confirm-delete" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>

 <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/bootstrap/js/bootbox.min.js"></script>

<script>

       var tobedeleted ='', tobeupdated = '';

    $("button[data-type=Delete]").click(function() {
         tobedeleted = this.name;
     });

    $("button[data-type=yes-confirm-delete]").click(function() {
       $.ajax({
            type: "POST",
            url:"processDelete.php",
            data: {'tobedeleted': tobedeleted},

            success: function() {
            location.reload();

            //alert("message sent!");
        }
      });
    });

     $("button[data-type=Edit]").click(function() {
         tobeupdated = this.name;
         //alert(this.name)

        var request = $.ajax({
            url: "processUpdate.php",
            type: "POST",
            dataType: 'json',
            data: {'tobeupdated': tobeupdated }
        });

        request.done(function(returned_row) {

           var tobeupdated_row = returned_row;

            $("#update_sitename").val(tobeupdated_row['site_name']);
            $("#update_sitetype").val(tobeupdated_row['site_type']);
            $("#update_sitelink").val(tobeupdated_row['site_link']);

        }); // request.done

        request.fail(function(jqXHR, textStatus) {
            alert( "Request failed: " + textStatus );
        });

    });

     // update site link
     $("button[name=go_update]").click(function() {

            $(function() {
                $("#do_update").on("submit", function(event) {
                    event.preventDefault();


                     var errors = 0;
                        $("#do_update :input[type=text]").map(function(){
                             if( !$(this).val() ) {
                                  $(this).parents('p').addClass('warning');
                                  errors++;
                            } else if ($(this).val()) {
                                  $(this).parents('p').removeClass('warning');
                            }
                        });
                        if(errors > 0){
                            $('#errorwarn_update').text("All fields are required");
                            return false;
                        }



                    $.ajax({
                        url: "doUpdate.php",
                        type: "post",
                        data: $(this).serialize() + "&update_site_id=" + tobeupdated,
                        success: function() {

                            location.reload();
                        }
                    });
                });
            });
     });

     //create site link
       $(function() {
            $("#sform").on("submit", function(event) {
                event.preventDefault();

                var errors = 0;
                $("#sform :input[type=text]").map(function(){
                     if( !$(this).val() ) {
                          $(this).parents('p').addClass('warning');
                          errors++;
                    } else if ($(this).val()) {
                          $(this).parents('p').removeClass('warning');
                    }
                });
                if(errors > 0){
                    $('#errorwarn_create').text("All fields are required");
                    return false;
                }



                $.ajax({
                    url: "create.php",
                    type: "post",
                    data: $(this).serialize(),

                    success: function(response) {
                        //alert(response);

                            $(".alert-message").show();
                           // $(".alert-message").alert();
                            window.setTimeout(function() { $(".alert-message").alert('close'); }, 2000);
                            window.setTimeout(function(){location.reload();}, 2000)
                    }

                });
            });
       });

</script>


</body>
</html>
