<?php

date_default_timezone_set('Asia/Kolkata');
require_once('Model/MyModel.php');
session_start();

class MyController extends MyModel
{
    function __construct()
    {
        parent::__construct();

        if (isset($_SERVER['PATH_INFO'])) {
            switch ($_SERVER['PATH_INFO']) {
                case '/index':
                    include 'Views/index.php';
                    break;
                case '/getCountriesData':
                    $CountryData = $this->SelectData('countries');
                    $html = '';
                    foreach ($CountryData['data'] as $value) {
                        $html .= "<option value='" . $value->id . "'>" . $value->name . "</option>";
                    }
                    echo $html;
                    break;
                case '/getStatesData':
                    $StateData = $this->SelectData('states', ['country_id' => $_REQUEST['country']]);
                    $html = '';
                    foreach ($StateData['data'] as $value) {
                        $html .= "<option value='" . $value->id . "'>" . $value->name . "</option>";
                    }
                    echo $html;
                    break;
                case '/getCitiesData':
                    $CityData = $this->SelectData('cities', ['state_id' => $_REQUEST['state']]);
                    $html = '';
                    foreach ($CityData['data'] as $value) {
                        $html .= "<option value='" . $value->id . "'>" . $value->name . "</option>";
                    }
                    echo $html;
                    break;
                default:
                    break;
            }
        } else {
?>
            <script type="text/javascript">
                window.location.href = 'index';
            </script>
<?php
        }
    }
}

$obj = new MyController;
