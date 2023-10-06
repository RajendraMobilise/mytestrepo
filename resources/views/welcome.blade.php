<!DOCTYPE html>
<html lang="en">

<head>

    <title>My Test</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
        margin: 0;
        padding: 0;
    }
    </style>
</head>

<body>

    <div>
        <nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <br>
            <a class="navbar-brand" href="#">My Test</a>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                </ul>

            </div>
        </nav>
    </div>
    <div class="container">
        <form id="MyTestForm">
            @csrf
            <div class="form-row">
                <div class="col-md-12">
                    <h3 class="text-center">My Test</h3>
                </div>
                <div class=" col-md-6 offset-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="symbol">Select Company Symbol <span class="text-danger"> *</span></label>
                            <select class="form-control" name="symbol" id="symbol">
                                <option value="">Select One</option>
                                <?php 
                         foreach($finaldata as $key => $val){
                                ?>
                                <option value="<?=$val['Symbol']?>"><?=$val['Company Name']?></option>
                                <?php
                             }
                           ?>
                            </select>
                            <span class="text-danger" id="symbol_error"></span>
                        </div>
                        </div>
                        
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="startDate">Start Date <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="startDate" id="startDate"
                                    placeholder="Start date" />
                                <span class="text-danger" id="startDate_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="endDate">End Date <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="endDate" id="endDate"
                                    placeholder="End date" />
                                <span class="text-danger" id="endDate_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger"> *</span></label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Enter Email ID" />
                                <span class="text-danger" id="email_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            <input type="hidden" name="type_val" value="SubmitForm">
                            <button class="btn btn-primary" type="submit" id="submitform">Submit</button>
                            <span class="text-danger" id="error_form_msg"></span>
                            <span class="text-success" id="form_msg"></span>

                            <br>
                            <br>
                            <br>

                        </div>
                    </div>


                </div>

                <div class="form-row">
                    <div class="col-md-12">
                        <h3 class="text-center ml-2">Historical Quotes</h3>

                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Open</th>
                                <th scope="col">High</th>
                                <th scope="col">Low</th>
                                <th scope="col">Close</th>
                                <th scope="col">Valume</th>
                            </tr>
                        </thead>
                        <tbody id="showHistoricalData">

                        </tbody>
                    </table>
                    <br>
                    <br><br>
                    <div>
                    </div>

                </div>


        </form>
    </div>
     <!-- Include jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Include jQuery UI -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
    <script>
    // Initialize the datepicker
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'yy-mm-dd'
      });
      $("#endDate").datepicker({
        dateFormat: 'yy-mm-dd'
      });
    });
   
  </script>
    <script>
        
    $(document).ready(function() {
        // $("#submitform").attr("disabled", true);  
        // Attach a submit event listener to the form
        $('#MyTestForm').submit(function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Create a new instance of FormData
            var formData = new FormData(this);

            $('#symbol_error').html('');
            $('#email_error').html('');
            $('#endDate_error').html('');
            $('#startDate_error').html('');

            // Validate start date
            var symbol = $('#symbol').val();
            var sts = false;
            var currentDate = new Date();

            if (!symbol) {
                $('#symbol_error').html('Company symbol is required');
                // return;
                sts = true;
            }

            // // Validate start date
            // var startDate = $('#startDate').val();
            // if (!startDate) {

            //     $('#startDate_error').html('Start Date is required');
            //     sts = true;
            //     // return;
            // }

            // // Validate end date
            // var endDate = $('#endDate').val();
            // if (!endDate) {

            //     $('#endDate_error').html('End Date is required');
            //     // return;
            //     sts = true;
            // }

            // Validate start date
            var startDate = new Date($('#startDate').val());

            if (!startDate || isNaN(startDate.getTime())) {

                $('#startDate_error').html('Start Date is required and should be a valid date');

                sts = true;
            }

            // Validate end date
            var endDate = new Date($('#endDate').val());
            if (!endDate || isNaN(endDate.getTime())) {
                $('#endDate_error').html('End Date is required and should be a valid date');
                sts = true;
            }

            // Validate start date is less than or equal to end date
            if (startDate > endDate) {

                $('#startDate_error').html('Start Date should be less than or equal to End Date');
                sts = true;
            }

            // Validate start date is less than or equal to current date

            if (startDate > currentDate) {
                $('#startDate_error').html('Start Date should be less than or equal to Current Date');

                // return;
                sts = true;
            }
            // /////////////////////////////////////////////////////////////////////////////
            // Validate end  date is less than or equal to end date
            if (endDate < startDate) {
                $('#endDate_error').html('End Date should be greater than or equal to Start Date');
                sts = true;
            }

            // // Validate start date is less than or equal to current date

            if (endDate > currentDate) {
                $('#endDate_error').html('End Date should be less than or equal to Current Date');
                // return;
                sts = true;
            }

            // Validate email
            var email = $('#email').val();
            if (!email || !isValidEmail(email)) {

                $('#email_error').html('Valid email is required');
                // return;
                sts = true;
            }

            if (!sts) {
                $("#submitform").attr("disabled", true);
                $("#submitform").html("Please wait..");
                $.ajax({
                    url: "{{url('/submit-form')}}", // Specify the URL to submit the form data
                    type: 'POST', // Specify the HTTP method (GET, POST, etc.)
                    data: formData, // Pass the FormData object as the data
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Prevent jQuery from automatically setting the content type
                    success: function(response) {
                        $("#submitform").attr("disabled", false);
                         $("#submitform").html("Submit");
                        var data = response.data;
                        console.log(data);
                        if (response.status == 'errors') {
                           
                            $.each(response.errors, function(key, val) {

                                $('#' + key + '_error').html(val[0]);

                                });
                        }
                        if (response.status == false) {
                           
                           alert(response.message);
                           return;
                        }

                        if (response.status == true) {
                            
                            let text = "";
                            if (data.length > 0) {
                                for (let i = 0; i < data.length; i++) {
                                text +="<tr>";
                                text +="<td>"+data[i]['date']+"</td>";
                                text +="<td>"+data[i]['open']+"</td>";
                                text +="<td>"+data[i]['high']+"</td>";
                                text +="<td>"+data[i]['low']+"</td>";
                                text +="<td>"+data[i]['close']+"</td>";
                                text +="<td>"+data[i]['volume']+"</td>";
                                text +="</tr>";
                                } 
                            }else{
                                text +="<tr>";
                                text +="<td colspan='6'>data not found</td>";
                                text +="</tr>";
                            }
                           
                            $('#showHistoricalData').html(text);
                            
                            $('#MyTestForm')[0].reset();
                            
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response
                        console.error(error);
                    }
                });

            }
            return;

            function isValidEmail(email) {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
        });
    });
    </script>
</body>

</html>