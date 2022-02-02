@extends('layouts.layout')
@section('title', 'MicroGridLab')
@section('head')
@endsection
@section('content')


    <body oncontextmenu="return false">
        <!-- Rechtsklick auf der Web-Seite nicht möglich -->

        <!-- Bilder-Show oben auf der Seite -->
        <div id="carouselExampleControls" class="carousel slide shadow-lg rounded">
            <div class="carousel-inner">
                <!-- 1.Bild -->
                <div class="carousel-item active">
                    <img class="picture" src="/images/homepage/HomePage2 - Kopie.jpg" alt="First slide">
                </div>
                <!-- 2.Bild -->
                <div class="carousel-item">
                    <img class="picture" src="/images/homepage/HomePage4 - Kopie.jpg" alt="Second slide">
                </div>
                <!-- 3.Bild -->
                <div class="carousel-item">
                    <img class="picture" src="/images/homepage/HomePage5 - Kopie.jpg" alt="Third slide">
                </div>
                <!-- n.Bild .... -->
            </div>

            <!-- Controll-Pfeil Zurück links -->
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                <span class="sr-only">
                    <!--Previous-->
                </span>
            </a>

            <!-- Controll-Pfeil Weiter rechts -->
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">
                    <!--Next-->
                </span>
            </a>
        </div>


        <!-- Beitrag -->
        <div class="Beitrag shadow-lg rounded-3">

            <h3 style="padding:10px" class="text-center"> <b> Über uns</b></h3> <!-- Überschrift -->

            <!-- Text -->
            <p class="text">
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
                et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                amet,
                consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                sed
                diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea
                takimata
                sanctus est Lorem ipsum dolor sit amet.
                et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                amet,
                consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                sed
                diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea
                takimata
                sanctus est Lorem ipsum dolor sit amet.
                et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                amet,
                consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                sed
                diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea
                takimata
                sanctus est Lorem ipsum dolor sit amet.
            </p>
        </div>
    </body>
    <?php
    
    use Illuminate\Support\Facades\Http;
    /*
        $uid = 15;
        
        $suid = strval($uid);
        
        
        
            $json = Http::withToken('eyJrIjoiM2dTZlU5bTM2SzJPaEt3OExnUUE5eDlFR1NEdjVjSVkiLCJuIjoiVGVzdEtleSIsImlkIjoxfQ==')->get('192.168.1.5:3000/api/dashboards/uid/'. $suid);
        
        
            echo($json);
        
        
            echo("</br>");
            echo("</br>");
            echo("</br>");
        
        
            var_dump(json_decode($json));
        //var_dump(json_decode($json, true));
        
        
        
        */
    

       // $version = 0;

  
       /*
        $createEnsysDashboard = Http::withHeaders([

        

'Authorization' => 'Bearer eyJrIjoiM2dTZlU5bTM2SzJPaEt3OExnUUE5eDlFR1NEdjVjSVkiLCJuIjoiVGVzdEtleSIsImlkIjoxfQ==',
'Content-Type' => 'application/json',
'Accept' => 'application/json',




])->post('192.168.1.5:3000/api/dashboards/db', [



"dashboard" => [


    'annotations' => [
        'list' => [
            [
                'builtIn' => 1,
                'datasource' => '-- Grafana --',
                'enable' => true,
                'hide' => true,
                'iconColor' => 'rgba(0, 211, 255, 1)',
                'name' => 'Annotations & Alerts',
                'target' => [
                    'limit' => 100,
                    'matchAny' => false,
                    'tags' => [],
                    'type' => 'dashboard',
                ],
                'type' => 'dashboard',
            ],
        ],
    ],
    'editable' => true,
    'fiscalYearStartMonth' => 0,
    'graphTooltip' => 0,
    'id' => null,
    'links' => [],
    'liveNow' => false,
    'panels' => [
        [
            'datasource' => [
                'type' => 'datasource',
                'uid' => 'grafana',
            ],
            'fieldConfig' => [
                'defaults' => [
                    'color' => [
                        'mode' => 'palette-classic',
                    ],
                    'custom' => [
                        'axisLabel' => '',
                        'axisPlacement' => 'auto',
                        'barAlignment' => 0,
                        'drawStyle' => 'line',
                        'fillOpacity' => 0,
                        'gradientMode' => 'none',
                        'hideFrom' => [
                            'legend' => false,
                            'tooltip' => false,
                            'viz' => false,
                        ],
                        'lineInterpolation' => 'linear',
                        'lineWidth' => 1,
                        'pointSize' => 5,
                        'scaleDistribution' => [
                            'type' => 'linear',
                        ],
                        'showPoints' => 'auto',
                        'spanNulls' => false,
                        'stacking' => [
                            'group' => 'A',
                            'mode' => 'none',
                        ],
                        'thresholdsStyle' => [
                            'mode' => 'off',
                        ],
                    ],
                    'mappings' => [],
                    'thresholds' => [
                        'mode' => 'absolute',
                        'steps' => [
                            [
                                'color' => 'green',
                                'value' => null,
                            ],
                            [
                                'color' => 'red',
                                'value' => 80,
                            ],
                        ],
                    ],
                ],
                'overrides' => [],
            ],
            'gridPos' => [
                'h' => 9,
                'w' => 12,
                'x' => 0,
                'y' => 0,
            ],
            'id' => 2,
            'options' => [
                'legend' => [
                    'calcs' => [],
                    'displayMode' => 'list',
                    'placement' => 'bottom',
                ],
                'tooltip' => [
                    'mode' => 'single',
                ],
            ],
            'targets' => [
                [
                    'datasource' => [
                        'type' => 'datasource',
                        'uid' => 'grafana',
                    ],
                    'queryType' => 'randomWalk',
                    'refId' => 'A',
                ],
            ],
            'title' => 'paneltesttt',
            'type' => 'timeseries',
        ],



//neuespanel


[
            'datasource' => [
                'type' => 'datasource',
                'uid' => 'grafana',
            ],
            'fieldConfig' => [
                'defaults' => [
                    'color' => [
                        'mode' => 'palette-classic',
                    ],
                    'custom' => [
                        'axisLabel' => '',
                        'axisPlacement' => 'auto',
                        'barAlignment' => 0,
                        'drawStyle' => 'line',
                        'fillOpacity' => 0,
                        'gradientMode' => 'none',
                        'hideFrom' => [
                            'legend' => false,
                            'tooltip' => false,
                            'viz' => false,
                        ],
                        'lineInterpolation' => 'linear',
                        'lineWidth' => 1,
                        'pointSize' => 5,
                        'scaleDistribution' => [
                            'type' => 'linear',
                        ],
                        'showPoints' => 'auto',
                        'spanNulls' => false,
                        'stacking' => [
                            'group' => 'A',
                            'mode' => 'none',
                        ],
                        'thresholdsStyle' => [
                            'mode' => 'off',
                        ],
                    ],
                    'mappings' => [],
                    'thresholds' => [
                        'mode' => 'absolute',
                        'steps' => [
                            [
                                'color' => 'green',
                                'value' => null,
                            ],
                            [
                                'color' => 'red',
                                'value' => 80,
                            ],
                        ],
                    ],
                ],
                'overrides' => [],
            ],
            'gridPos' => [
                'h' => 9,
                'w' => 12,
                'x' => 0,
                'y' => 0,
            ],
            'id' => 2,
            'options' => [
                'legend' => [
                    'calcs' => [],
                    'displayMode' => 'list',
                    'placement' => 'bottom',
                ],
                'tooltip' => [
                    'mode' => 'single',
                ],
            ],
            'targets' => [
                [
                    'datasource' => [
                        'type' => 'datasource',
                        'uid' => 'grafana',
                    ],
                    'queryType' => 'randomWalk',
                    'refId' => 'A',
                ],
            ],
            'title' => 'paneltest2',
            'type' => 'timeseries',
        ],


    ],
    'refresh' => '',
    'schemaVersion' => 16,
    'style' => 'dark',
    'tags' => [],
    'templating' => [
        'list' => [],
    ],
    'time' => [
        'from' => 'now-6h',
        'to' => 'now',
    ],
    'timepicker' => [],
    'timezone' => 'browser',
    'title' => 'vt',
    'uid' => '29',
    'version' => 2,

    
   

    ]
]);

*/
//echo ($createEnsysDashboard);

/*
$json = '{"id":81,"slug":"versionstesttt","status":"success","uid":"28","url":"/d/28/versionstesttt","version":1}';





//echo($json. '<br>');


$decjson = json_decode($json. '<br>');


//echo($decjson);

 $array = (json_decode($json, true . '<br>'));


 $version = $array['version'];


 echo($version);

 


$jjson = Http::withToken('eyJrIjoiM2dTZlU5bTM2SzJPaEt3OExnUUE5eDlFR1NEdjVjSVkiLCJuIjoiVGVzdEtleSIsImlkIjoxfQ==')->get('192.168.1.5:3000/api/dashboards/uid/29');

echo($jjson);
echo("<br>");



//$arr = (json_decode($jjson, true));

//echo($arr['version']);

*/
    ?>
@endsection
@section('foooter')
