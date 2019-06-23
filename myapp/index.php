<html>
<head>
        <title>Pacific Prime</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <script language="javascript">
                $(document).ready(function(){
                        fetchRecords();
                        $( "#submit_form" ).submit(function( event ) {
                                event.preventDefault();
                                if($("#fmi_name").val() == ''){
                                        $(".alert-name").show();
                                }else if($("#fmi_telephone").val() == ''){
                                        $(".alert-telephone").show();
                                }else if($("#fmi_email").val() == ''){
                                        $(".alert-email").show();
                                }else if($("#fmi_company").val() == ''){
                                        $(".alert-company").show();
                                }else if($("#fmi_fileupload").val() == ''){
                                        $(".alert-fileupload").show();
                                }else{
                                        $.ajax({
                                                type: 'post',
                                                url: 'submit_record.php',
                                                data: new FormData(this),
                                                contentType: false,
                                                cache: false,
                                                processData: false,
                                                success: function () {
                                                        fetchRecords();
                                                }
                                        });
                                }
                                
                        });

                        $( "#fmi_name" ).blur(function() {
                                $(".alert-name").hide();
                        });
                        $( "#fmi_telephone" ).blur(function() {
                                $(".alert-telephone").hide();
                        });
                        $( "#fmi_email" ).blur(function() {
                                $(".alert-email").hide();
                        });
                        $( "#fmi_company" ).blur(function() {
                                $(".alert-company").hide();
                        });
                        $( "#fmi_fileupload" ).change(function() {
                                $(".alert-fileupload").hide();
                        });
                });

                function fetchRecords(){
                        $('#is_record').html('<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">กำลังโหลด...</span>');
                        $.ajax({
                                type: "GET",
                                cache: false,
                                url: "fetch_record.php",
                                dataType: 'text',
                                success: function(data){
                                        $('#is_record').empty();
                                        var tableHTML = '';
                                        var cnt = 0;
                                        var json = $.parseJSON(data);
                                        if(json.length > 0){
                                                for (var i=0;i<json.length;++i){
                                                        cnt = i + 1;
                                                        tableHTML += '<tr>';
                                                        tableHTML += '<th scope="row">' + cnt + '</th>';
                                                        tableHTML += '<th>' + json[i].name + '</th>';
                                                        tableHTML += '<th>' + json[i].telephone + '</th>';
                                                        tableHTML += '<th>' + json[i].email + '</th>';
                                                        tableHTML += '<th>' + json[i].company + '</th>';
                                                        tableHTML += '<th><a href='+window.location.pathname+'upload/' + json[i].path + ' target="_blank">' + json[i].path + '</a></th>';
                                                        tableHTML += '</tr>';
                                                }
                                        }else{
                                                tableHTML += '<tr>';
                                                tableHTML += '<th colspan="6"><i class="fa fa-frown-o" aria-hidden="true"></i> <i>No record found...</i></th>';
                                                tableHTML += '</tr>';
                                        }
                                        $('#is_record').append(tableHTML);
                                }
                        });
                }
        </script>
</head>
<body>
        <div class="jumbotron text-center">
                <h1>Pacific Prime</h1>
                <p>Contact Management</p> 
        </div>
        <div class="container text-center">
                <form enctype="multipart/form-data" id="submit_form">
                        <div class="row">
                                <div class="col-sm-4 text-left">
                                        <h3><i class="far fa-address-card"></i>&nbsp;Add New Contact</h3>
                                        <div class="form-group">
                                                <label for="fmi_name">Name</label>
                                                <input type="text" class="form-control" name="fmi_name" id="fmi_name" placeholder="Enter name">
                                                <div class="alert alert-danger alert-name" role="alert" style="display:none">
                                                        Name is required!
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <label for="fmi_telephone">Phone</label>
                                                <input type="text" class="form-control" name="fmi_telephone" id="fmi_telephone" placeholder="Enter telephone number">
                                                <div class="alert alert-danger alert-telephone" role="alert" style="display:none">
                                                        Phone number is required!
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <label for="fmi_email">Email</label>
                                                <input type="email" class="form-control" name="fmi_email" id="fmi_email" placeholder="Enter email">
                                                <div class="alert alert-danger alert-email" role="alert" style="display:none">
                                                        Email address is required!
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <label for="fmi_company">Company</label>
                                                <input type="text" class="form-control" name="fmi_company" id="fmi_company" placeholder="Enter company name">
                                                <div class="alert alert-danger alert-company" role="alert" style="display:none">
                                                        Company name is required!
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <label for="fmi_fileupload">Company Logo Upload</label>
                                                <input type="file" class="form-control-file" name="fmi_fileupload" id="fmi_fileupload">
                                                <div class="alert alert-danger alert-fileupload" role="alert" style="display:none">
                                                        Company logo is required!
                                                </div>
                                        </div>
                                </div>
                                <div class="col-sm-8 text-left">
                                        <p><p>
                                        <span id="total_row">
                                                <table class="table table-borderless">
                                                        <thead>
                                                                <tr>
                                                                        <th scope="col">#</th>
                                                                        <th scope="col">Name</th>
                                                                        <th scope="col">Phone</th>
                                                                        <th scope="col">Email</th>
                                                                        <th scope="col">Company</th>
                                                                        <th scope="col">Logo</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody id="is_record"></tbody>
                                                </table>
                                        
                                        </span>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-sm-4 text-right">
                                        <button class="form-control form-control-sm btn btn-warning" type="submit" name="submit" value="Submit">Submit</button>
                                </div>
                        </div>
                </form>
        </div>
</body>
</html>