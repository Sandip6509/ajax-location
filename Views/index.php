<!DOCTYPE html>
<html>
<head>
    <title>LearnVern | Task</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style type="text/css">
    .card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
        margin-top: 20px;
    }
    li {
        width: 400px;
    }
    select {
        width: 350px;
    }
</style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">LearnVern | Task</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="card" style="margin: 1%;">
        <h5 class="card-header">Location Data</h5>
        <div class="card-body">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item"><b>Countries</b><hr>
                    <select id="country_dropdown">
                        <option value="" disabled="" selected="">-----------------Select Country-----------------</option>
                    </select>

                  </li>
                  <li class="list-group-item"><b>States</b><hr>
                    <select id="state_dropdown">
                        <option value="" disabled="" selected="">-----------------Select State-----------------</option>
                    </select>
                </li>
                <li class="list-group-item"><b>Cities</b><hr>
                    <select id="city_dropdown">
                        <option value="" disabled="" selected="">-----------------Select City-----------------</option>
                    </select>
                </li>
            </ul>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function (){
            loadCountries();
        });

        $('#country_dropdown').change(function(){
            loadStates(this.value);
        });

        $('#state_dropdown').change(function(){
            loadCities(this.value);
        });
        
        function loadCountries(){
           $.ajax({
                type:'get',
                url : 'http://localhost/ajax-mvc/getCountriesData',
                data:{

                },
                cache: false,
                dataType: 'text',
                success: function(data){
                    $('#country_dropdown').append(data)
                }
           }); 
        }
        
        function loadStates(country_id){
           $.ajax({
                type:'post',
                url : 'http://localhost/ajax-mvc/getStatesData',
                data:{
                    country: country_id
                },
                cache: false,
                dataType: 'text',
                success: function(data){
                    $('#state_dropdown').empty()
                    $('#state_dropdown').append(data)
                }
           }); 
        }

        function loadCities(state_id){
           $.ajax({
                type:'post',
                url : 'http://localhost/ajax-mvc/getCitiesData',
                data:{
                    state: state_id
                },
                cache: false,
                dataType: 'text',
                success: function(data){
                    $('#city_dropdown').empty()
                    $('#city_dropdown').append(data)
                }
           }); 
        }
    </script>
</body>
</html>