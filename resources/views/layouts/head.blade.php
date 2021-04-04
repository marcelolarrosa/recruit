<!DOCTYPE html>
<html lang="en" >
    
<head>
        <meta charset="UTF-8">
        <title>Porfolio-Recru-IT</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{csrf_token()}}">

        <!-- Add Roboto Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <!-- Add jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Add Bootstrap and Fontawesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

        <link rel="stylesheet" href="{!! asset('css/styles.css') !!}">

        <script>
        
        $(".main-container").hide();
        $(document).ready(function(){
            $(".search-bar input").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#candidates-grid .card-container").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#imageUpload").change(function() {
                readURL(this);
            });

            $("#profile-container #best-candidate-button").click(function(){
                $("#best-candidates").load("includes/load-best-candidate.php");
            });

            $("#update-candidate-button").on('click', function(){
                $(".simplepicker-wrapper").css('display', 'none');
            });
        });       
        </script>

    </head>

    <body>