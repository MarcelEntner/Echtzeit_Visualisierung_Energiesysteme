<?php

namespace App\Http\Controllers;

use App\Models\EnTech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;



class EnTechController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $enTech = new EnTech();



        $enTech->enSys_idEnSys = $request->IDES;
        $enTech->designation = $request->Bezeichnung;
        $enTech->longitude = $request->Laengengrad;
        $enTech->latitude = $request->Breitengrad;
        $enTech->description = $request->BeschreibungET;
        $enTech->type = $request->Typ;
        $enTech->location = $request->Ort;
        $enTech->enSys_users_idusers = $user->id;

        if ($request->file("imageET")) {
           // $image = base64_encode(file_get_contents($request->file('imageET')));
           // $enTech->picture = $image;

          

           $path = $request->file('imageET')->store('public');
           $enTech->imgpath = $path; 
        }


      
        $enTech->save();
        $data = DB::table('EnTech')->get();


          //Grafana ET (Panel) erstellen anfang
        

$uid = strval($request->IDES);

$panelId = $enTech->id;

$getCurrentDashboard = Http::withToken('eyJrIjoiQjFpUjQyZnF6U2xFM0hLb1djbjNLaWlLSVBNYXFxelMiLCJuIjoiTWljcm9ncmlkIFZpc3UiLCJpZCI6NH0=')->get('https://show.microgrid-lab.eu/api/dashboards/uid/'. $uid);

$oldDashboard = json_decode($getCurrentDashboard,true);



    $paneldef =      [

       
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
        'id' => $panelId,
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
        "targets" => [
      
            

        ],
        'title' => $request->Bezeichnung,
        'type' => 'timeseries',
        
    ];







$panelTarget_PV = [
    [
        "datasource" => [
           "type" => "Ensys Visu", 
           "uid" => "nHHCjxBnk" 
        ], 
        "format" => "time_series", 
        "group" => [
           ], 
        "metricColumn" => "none", 
        "rawQuery" => false, 

        "rawSql" => "SELECT timestamp AS \"time\",power FROM EtPV WHERE \$__timeFilter(timestamp) ORDER BY timestamp",

        "refId" => "A", 
        "select" => [
                 [
                    [
                       "params" => [
                          "power" 
                       ], 
                       "type" => "column" 
                    ] 
                 ] 
              ], 
        "table" => "EtPv", 
        "timeColumn" => "timestamp", 
        "timeColumnType" => "timestamp", 
        "where" => [
                             [
                                "name" => "\$__timeFilter", 
                                "params" => [
                                ], 
                                "type" => "macro" 
                             ]
                             ,

                                                                                                      


                                                                                                      [
                                                                                                         "datatype" => "int", 
                                                                                                         "name" => "", 
                                                                                                         "params" => [
                                                                                                               "enTech_idEnTech", 
                                                                                                               "=", 
                                                                                                               $panelId
                                                                                                            ], 
                                                                                                         "type" => "expression" 
                                                                                                      ]
                          ] 
     ], 
    ];

    $panelTarget_Stromnetzbezug = [
        [
            "datasource" => [
               "type" => "Ensys Visu", 
               "uid" => "nHHCjxBnk" 
            ], 
            "format" => "time_series", 
            "group" => [
               ], 
            "metricColumn" => "none", 
            "rawQuery" => false, 
    
            "rawSql" => "SELECT timestamp AS \"time\",power FROM EtSnB WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
    
            "refId" => "A", 
            "select" => [
                     [
                        [
                           "params" => [
                              "power" 
                           ], 
                           "type" => "column" 
                        ] 
                     ] 
                  ], 
            "table" => "EtSnB", 
            "timeColumn" => "timestamp", 
            "timeColumnType" => "timestamp", 
            "where" => [
                                 [
                                    "name" => "\$__timeFilter", 
                                    "params" => [
                                    ], 
                                    "type" => "macro" 
                                 ]
                                 ,

                                                                                                      


                                                                                                      [
                                                                                                         "datatype" => "int", 
                                                                                                         "name" => "", 
                                                                                                         "params" => [
                                                                                                               "enTech_idEnTech", 
                                                                                                               "=", 
                                                                                                               $panelId
                                                                                                            ], 
                                                                                                         "type" => "expression" 
                                                                                                      ]
                            
                              ] 
         ], 
        ];
        $panelTarget_Batteriespeicher = [
            [
                "datasource" => [
                   "type" => "Ensys Visu", 
                   "uid" => "nHHCjxBnk" 
                ], 
                "format" => "time_series", 
                "group" => [
                   ], 
                "metricColumn" => "none", 
                "rawQuery" => false, 
        
                "rawSql" => "SELECT timestamp AS \"time\", storageCapacity FROM EtBs WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
        
                "refId" => "A", 
                "select" => [
                         [
                            [
                               "params" => [
                                  "storageCapacity" 
                               ], 
                               "type" => "column" 
                            ] 
                         ] 
                      ], 
                "table" => "EtBs", 
                "timeColumn" => "timestamp", 
                "timeColumnType" => "timestamp", 
                "where" => [
                                     [
                                        "name" => "\$__timeFilter", 
                                        "params" => [
                                        ], 
                                        "type" => "macro" 
                                     ]
                                     ,

                                                                                                      


                                                                                                      [
                                                                                                         "datatype" => "int", 
                                                                                                         "name" => "", 
                                                                                                         "params" => [
                                                                                                               "enTech_idEnTech", 
                                                                                                               "=", 
                                                                                                               $panelId
                                                                                                            ], 
                                                                                                         "type" => "expression" 
                                                                                                      ] 
                                   
                                  ] 
             ], 
            ];
        
            $panelTarget_WasserstoffElektrolyse = [
                [
                    "datasource" => [
                       "type" => "Ensys Visu", 
                       "uid" => "nHHCjxBnk" 
                    ], 
                    "format" => "time_series", 
                    "group" => [
                       ], 
                    "metricColumn" => "none", 
                    "rawQuery" => false, 
            
                    "rawSql" => "SELECT timestamp AS \"time\", power FROM EtWe WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
            
                    "refId" => "A", 
                    "select" => [
                             [
                                [
                                   "params" => [
                                      "power" 
                                   ], 
                                   "type" => "column" 
                                ] 
                             ] 
                          ], 
                    "table" => "EtWe", 
                    "timeColumn" => "timestamp", 
                    "timeColumnType" => "timestamp", 
                    "where" => [
                                         [
                                            "name" => "\$__timeFilter", 
                                            "params" => [
                                            ], 
                                            "type" => "macro" 
                                         ]
                                         ,

                                                                                                      


                                                                                                      [
                                                                                                         "datatype" => "int", 
                                                                                                         "name" => "", 
                                                                                                         "params" => [
                                                                                                               "enTech_idEnTech", 
                                                                                                               "=", 
                                                                                                               $panelId
                                                                                                            ], 
                                                                                                         "type" => "expression" 
                                                                                                      ]
                                     
                                      ] 
                 ], 
                ];

                $panelTarget_WasserstoffBrennstoffzelle = [
                    [
                        "datasource" => [
                           "type" => "Ensys Visu", 
                           "uid" => "nHHCjxBnk" 
                        ], 
                        "format" => "time_series", 
                        "group" => [
                           ], 
                        "metricColumn" => "none", 
                        "rawQuery" => false, 
                
                        "rawSql" => "SELECT timestamp AS \"time\",power FROM EtBsZ WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                
                        "refId" => "A", 
                        "select" => [
                                 [
                                    [
                                       "params" => [
                                          "power" 
                                       ], 
                                       "type" => "column" 
                                    ] 
                                 ] 
                              ], 
                        "table" => "EtBsZ", 
                        "timeColumn" => "timestamp", 
                        "timeColumnType" => "timestamp", 
                        "where" => [
                                             [
                                                "name" => "\$__timeFilter", 
                                                "params" => [
                                                ], 
                                                "type" => "macro" 
                                             ]
                                             ,

                                                                                                      


                                             [
                                                "datatype" => "int", 
                                                "name" => "", 
                                                "params" => [
                                                      "enTech_idEnTech", 
                                                      "=", 
                                                      $panelId
                                                   ], 
                                                "type" => "expression" 
                                             ]
                                          ] 
                     ], 
                    ];
                $panelTarget_WasserstoffSpeicher = [
                    [
                        "datasource" => [
                           "type" => "Ensys Visu", 
                           "uid" => "nHHCjxBnk" 
                        ], 
                        "format" => "time_series", 
                        "group" => [
                           ], 
                        "metricColumn" => "none", 
                        "rawQuery" => false, 
                
                        "rawSql" => "SELECT timestamp AS \"time\", storageTempBottom FROM EtWs WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                
                        "refId" => "A", 
                        "select" => [
                                 [
                                    [
                                       "params" => [
                                          "storageTempBottom" 
                                       ], 
                                       "type" => "column" 
                                    ] 
                                 ] 
                              ], 
                        "table" => "EtWs", 
                        "timeColumn" => "timestamp", 
                        "timeColumnType" => "timestamp", 
                        "where" => [
                                             [
                                                "name" => "\$__timeFilter", 
                                                "params" => [
                                                ], 
                                                "type" => "macro" 
                                             ]
                                             ,

                                                                                                      


                                             [
                                                "datatype" => "int", 
                                                "name" => "", 
                                                "params" => [
                                                      "enTech_idEnTech", 
                                                      "=", 
                                                      $panelId
                                                   ], 
                                                "type" => "expression" 
                                             ]
                                          ] 
                     ], 
                     [
                        "datasource" => [
                           "type" => "Ensys Visu", 
                           "uid" => "nHHCjxBnk" 
                        ], 
                        "format" => "time_series", 
                        "group" => [
                           ], 
                        "metricColumn" => "none", 
                        "rawQuery" => false, 
                
                        "rawSql" => "SELECT timestamp AS \"time\", storageTempMiddle FROM EtWs WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                
                        "refId" => "B", 
                        "select" => [
                                 [
                                    [
                                       "params" => [
                                          "storageTempMiddle" 
                                       ], 
                                       "type" => "column" 
                                    ] 
                                 ] 
                              ], 
                        "table" => "EtWs", 
                        "timeColumn" => "timestamp", 
                        "timeColumnType" => "timestamp", 
                        "where" => [
                                             [
                                                "name" => "\$__timeFilter", 
                                                "params" => [
                                                ], 
                                                "type" => "macro" 
                                             ]
                                             ,

                                                                                                      


                                             [
                                                "datatype" => "int", 
                                                "name" => "", 
                                                "params" => [
                                                      "enTech_idEnTech", 
                                                      "=", 
                                                      $panelId
                                                   ], 
                                                "type" => "expression" 
                                             ]
                                          ] 
                     ], 
                     [
                        "datasource" => [
                           "type" => "Ensys Visu", 
                           "uid" => "nHHCjxBnk" 
                        ], 
                        "format" => "time_series", 
                        "group" => [
                           ], 
                        "metricColumn" => "none", 
                        "rawQuery" => false, 
                
                        "rawSql" => "SELECT timestamp AS \"time\", storageTempTop FROM EtWs WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                
                        "refId" => "C", 
                        "select" => [
                                 [
                                    [
                                       "params" => [
                                          "storageTempTop" 
                                       ], 
                                       "type" => "column" 
                                    ] 
                                 ] 
                              ], 
                        "table" => "EtWs", 
                        "timeColumn" => "timestamp", 
                        "timeColumnType" => "timestamp", 
                        "where" => [
                                             [
                                                "name" => "\$__timeFilter", 
                                                "params" => [
                                                ], 
                                                "type" => "macro" 
                                             ]
                                             ,

                                                                                                      


                                             [
                                                "datatype" => "int", 
                                                "name" => "", 
                                                "params" => [
                                                      "enTech_idEnTech", 
                                                      "=", 
                                                      $panelId
                                                   ], 
                                                "type" => "expression" 
                                             ]
                                          ] 
                     ]

                     
                    ];
                    $panelTarget_WindkraftAnlage = [
                        [
                            "datasource" => [
                               "type" => "Ensys Visu", 
                               "uid" => "nHHCjxBnk" 
                            ], 
                            "format" => "time_series", 
                            "group" => [
                               ], 
                            "metricColumn" => "none", 
                            "rawQuery" => false, 
                    
                            "rawSql" => "SELECT timestamp AS \"time\",power FROM EtWkA WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                    
                            "refId" => "A", 
                            "select" => [
                                     [
                                        [
                                           "params" => [
                                              "power" 
                                           ], 
                                           "type" => "column" 
                                        ] 
                                     ] 
                                  ], 
                            "table" => "EtWkA", 
                            "timeColumn" => "timestamp", 
                            "timeColumnType" => "timestamp", 
                            "where" => [
                                                 [
                                                    "name" => "\$__timeFilter", 
                                                    "params" => [
                                                    ], 
                                                    "type" => "macro" 
                                                 ]
                                                 ,

                                                                                                      


                                                 [
                                                    "datatype" => "int", 
                                                    "name" => "", 
                                                    "params" => [
                                                          "enTech_idEnTech", 
                                                          "=", 
                                                          $panelId
                                                       ], 
                                                    "type" => "expression" 
                                                 ]
                                              ] 
                         ], 
                        ];
                        $panelTarget_ELadestation = [
                            [
                                "datasource" => [
                                   "type" => "Ensys Visu", 
                                   "uid" => "nHHCjxBnk" 
                                ], 
                                "format" => "time_series", 
                                "group" => [
                                   ], 
                                "metricColumn" => "none", 
                                "rawQuery" => false, 
                        
                                "rawSql" => "SELECT timestamp AS \"time\",power FROM EtEl WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                        
                                "refId" => "A", 
                                "select" => [
                                         [
                                            [
                                               "params" => [
                                                  "power" 
                                               ], 
                                               "type" => "column" 
                                            ] 
                                         ] 
                                      ], 
                                "table" => "EtEl", 
                                "timeColumn" => "timestamp", 
                                "timeColumnType" => "timestamp", 
                                "where" => [
                                                     [
                                                        "name" => "\$__timeFilter", 
                                                        "params" => [
                                                        ], 
                                                        "type" => "macro" 
                                                     ]
                                                     ,

                                                                                                      


                                                     [
                                                        "datatype" => "int", 
                                                        "name" => "", 
                                                        "params" => [
                                                              "enTech_idEnTech", 
                                                              "=", 
                                                              $panelId
                                                           ], 
                                                        "type" => "expression" 
                                                     ]
                                                  ] 
                             ], 
                            ];
                        
                            $panelTarget_HausanschlussZaehler = [
                                [
                                    "datasource" => [
                                       "type" => "Ensys Visu", 
                                       "uid" => "nHHCjxBnk" 
                                    ], 
                                    "format" => "time_series", 
                                    "group" => [
                                       ], 
                                    "metricColumn" => "none", 
                                    "rawQuery" => false, 
                            
                                    "rawSql" => "SELECT timestamp AS \"time\",power FROM EtHaZ WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                            
                                    "refId" => "A", 
                                    "select" => [
                                             [
                                                [
                                                   "params" => [
                                                      "power" 
                                                   ], 
                                                   "type" => "column" 
                                                ] 
                                             ] 
                                          ], 
                                    "table" => "EtHaZ", 
                                    "timeColumn" => "timestamp", 
                                    "timeColumnType" => "timestamp", 
                                    "where" => [
                                                         [
                                                            "name" => "\$__timeFilter", 
                                                            "params" => [
                                                            ], 
                                                            "type" => "macro" 
                                                         ]
                                                         ,

                                                                                                      


                                                         [
                                                            "datatype" => "int", 
                                                            "name" => "", 
                                                            "params" => [
                                                                  "enTech_idEnTech", 
                                                                  "=", 
                                                                  $panelId
                                                               ], 
                                                            "type" => "expression" 
                                                         ]
                                                      ] 
                                 ], 
                                ];

                                $panelTarget_WaermenetzBezug = [
                                    [
                                        "datasource" => [
                                           "type" => "Ensys Visu", 
                                           "uid" => "nHHCjxBnk" 
                                        ], 
                                        "format" => "time_series", 
                                        "group" => [
                                           ], 
                                        "metricColumn" => "none", 
                                        "rawQuery" => false, 
                                
                                        "rawSql" => "SELECT timestamp AS \"time\",power FROM EtWnB WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                
                                        "refId" => "A", 
                                        "select" => [
                                                 [
                                                    [
                                                       "params" => [
                                                          "power" 
                                                       ], 
                                                       "type" => "column" 
                                                    ] 
                                                 ] 
                                              ], 
                                        "table" => "EtWnB", 
                                        "timeColumn" => "timestamp", 
                                        "timeColumnType" => "timestamp", 
                                        "where" => [
                                                             [
                                                                "name" => "\$__timeFilter", 
                                                                "params" => [
                                                                ], 
                                                                "type" => "macro" 
                                                             ]
                                                             ,

                                                                                                      


                                                             [
                                                                "datatype" => "int", 
                                                                "name" => "", 
                                                                "params" => [
                                                                      "enTech_idEnTech", 
                                                                      "=", 
                                                                      $panelId
                                                                   ], 
                                                                "type" => "expression" 
                                                             ]
                                                          ] 
                                     ], 
                                    ];
                                
                                    $panelTarget_Biomasseheizkraftwerk = [
                                        [
                                            "datasource" => [
                                               "type" => "Ensys Visu", 
                                               "uid" => "nHHCjxBnk" 
                                            ], 
                                            "format" => "time_series", 
                                            "group" => [
                                               ], 
                                            "metricColumn" => "none", 
                                            "rawQuery" => false, 
                                    
                                            "rawSql" => "SELECT timestamp AS \"time\",power FROM EtBhKw WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                    
                                            "refId" => "A", 
                                            "select" => [
                                                     [
                                                        [
                                                           "params" => [
                                                              "power" 
                                                           ], 
                                                           "type" => "column" 
                                                        ] 
                                                     ] 
                                                  ], 
                                            "table" => "EtBhKw", 
                                            "timeColumn" => "timestamp", 
                                            "timeColumnType" => "timestamp", 
                                            "where" => [
                                                                 [
                                                                    "name" => "\$__timeFilter", 
                                                                    "params" => [
                                                                    ], 
                                                                    "type" => "macro" 
                                                                 ]
                                                                 ,

                                                                                                      


                                                                 [
                                                                    "datatype" => "int", 
                                                                    "name" => "", 
                                                                    "params" => [
                                                                          "enTech_idEnTech", 
                                                                          "=", 
                                                                          $panelId
                                                                       ], 
                                                                    "type" => "expression" 
                                                                 ]
                                                              ] 
                                         ], 
                                         [
                                            "datasource" => [
                                               "type" => "Ensys Visu", 
                                               "uid" => "nHHCjxBnk" 
                                            ], 
                                            "format" => "time_series", 
                                            "group" => [
                                               ], 
                                            "metricColumn" => "none", 
                                            "rawQuery" => false, 
                                    
                                            "rawSql" => "SELECT timestamp AS \"time\", flowTemp FROM EtBhKw WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                    
                                            "refId" => "B", 
                                            "select" => [
                                                     [
                                                        [
                                                           "params" => [
                                                              "flowTemp" 
                                                           ], 
                                                           "type" => "column" 
                                                        ] 
                                                     ] 
                                                  ], 
                                            "table" => "EtBhKw", 
                                            "timeColumn" => "timestamp", 
                                            "timeColumnType" => "timestamp", 
                                            "where" => [
                                                                 [
                                                                    "name" => "\$__timeFilter", 
                                                                    "params" => [
                                                                    ], 
                                                                    "type" => "macro" 
                                                                 ]
                                                                 ,

                                                                                                      


                                                                 [
                                                                    "datatype" => "int", 
                                                                    "name" => "", 
                                                                    "params" => [
                                                                          "enTech_idEnTech", 
                                                                          "=", 
                                                                          $panelId
                                                                       ], 
                                                                    "type" => "expression" 
                                                                 ]
                                                              ] 
                                         ], 
                                        ];
                                    
                                        $panelTarget_Biomasseheizwerk = [
                                            [
                                                "datasource" => [
                                                   "type" => "Ensys Visu", 
                                                   "uid" => "nHHCjxBnk" 
                                                ], 
                                                "format" => "time_series", 
                                                "group" => [
                                                   ], 
                                                "metricColumn" => "none", 
                                                "rawQuery" => false, 
                                        
                                                "rawSql" => "SELECT timestamp AS \"time\",power FROM EtBmHw WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                        
                                                "refId" => "A", 
                                                "select" => [
                                                         [
                                                            [
                                                               "params" => [
                                                                  "power" 
                                                               ], 
                                                               "type" => "column" 
                                                            ] 
                                                         ] 
                                                      ], 
                                                "table" => "EtBmHw", 
                                                "timeColumn" => "timestamp", 
                                                "timeColumnType" => "timestamp", 
                                                "where" => [
                                                                     [
                                                                        "name" => "\$__timeFilter", 
                                                                        "params" => [
                                                                        ], 
                                                                        "type" => "macro" 
                                                                     ]
                                                                     ,

                                                                                                      


                                                                                                      [
                                                                                                         "datatype" => "int", 
                                                                                                         "name" => "", 
                                                                                                         "params" => [
                                                                                                               "enTech_idEnTech", 
                                                                                                               "=", 
                                                                                                               $panelId
                                                                                                            ], 
                                                                                                         "type" => "expression" 
                                                                                                      ]
                                                                  ] 
                                             ], 

                                             [
                                                "datasource" => [
                                                   "type" => "Ensys Visu", 
                                                   "uid" => "nHHCjxBnk" 
                                                ], 
                                                "format" => "time_series", 
                                                "group" => [
                                                   ], 
                                                "metricColumn" => "none", 
                                                "rawQuery" => false, 
                                        
                                                "rawSql" => "SELECT timestamp AS \"time\",flowTemp FROM EtBmHw WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                        
                                                "refId" => "B", 
                                                "select" => [
                                                         [
                                                            [
                                                               "params" => [
                                                                  "flowTemp" 
                                                               ], 
                                                               "type" => "column" 
                                                            ] 
                                                         ] 
                                                      ], 
                                                "table" => "EtBmHw", 
                                                "timeColumn" => "timestamp", 
                                                "timeColumnType" => "timestamp", 
                                                "where" => [
                                                                     [
                                                                        "name" => "\$__timeFilter", 
                                                                        "params" => [
                                                                        ], 
                                                                        "type" => "macro" 
                                                                     ]
                                                                     ,

                                                                                                      


                                                                                                      [
                                                                                                         "datatype" => "int", 
                                                                                                         "name" => "", 
                                                                                                         "params" => [
                                                                                                               "enTech_idEnTech", 
                                                                                                               "=", 
                                                                                                               $panelId
                                                                                                            ], 
                                                                                                         "type" => "expression" 
                                                                                                      ]
                                                                  ] 
                                             ], 
                                            ];
                                        
                                            $panelTarget_Biomasseheizkessel = [
                                                [
                                                    "datasource" => [
                                                       "type" => "Ensys Visu", 
                                                       "uid" => "nHHCjxBnk" 
                                                    ], 
                                                    "format" => "time_series", 
                                                    "group" => [
                                                       ], 
                                                    "metricColumn" => "none", 
                                                    "rawQuery" => false, 
                                            
                                                    "rawSql" => "SELECT timestamp AS \"time\",power FROM EtBmHk WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                            
                                                    "refId" => "A", 
                                                    "select" => [
                                                             [
                                                                [
                                                                   "params" => [
                                                                      "power" 
                                                                   ], 
                                                                   "type" => "column" 
                                                                ] 
                                                             ] 
                                                          ], 
                                                    "table" => "EtBmHk", 
                                                    "timeColumn" => "timestamp", 
                                                    "timeColumnType" => "timestamp", 
                                                    "where" => [
                                                                         [
                                                                            "name" => "\$__timeFilter", 
                                                                            "params" => [
                                                                            ], 
                                                                            "type" => "macro" 
                                                                         ] 
                                                                         ,

                                                                                                      


                                                                                                      [
                                                                                                         "datatype" => "int", 
                                                                                                         "name" => "", 
                                                                                                         "params" => [
                                                                                                               "enTech_idEnTech", 
                                                                                                               "=", 
                                                                                                               $panelId
                                                                                                            ], 
                                                                                                         "type" => "expression" 
                                                                                                      ]
                                                                      ] 
                                                 ], 

                                                 [
                                                    "datasource" => [
                                                       "type" => "Ensys Visu", 
                                                       "uid" => "nHHCjxBnk" 
                                                    ], 
                                                    "format" => "time_series", 
                                                    "group" => [
                                                       ], 
                                                    "metricColumn" => "none", 
                                                    "rawQuery" => false, 
                                            
                                                    "rawSql" => "SELECT timestamp AS \"time\", flowTemp FROM EtBmHk WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                            
                                                    "refId" => "B", 
                                                    "select" => [
                                                             [
                                                                [
                                                                   "params" => [
                                                                      "flowTemp" 
                                                                   ], 
                                                                   "type" => "column" 
                                                                ] 
                                                             ] 
                                                          ], 
                                                    "table" => "EtBmHk", 
                                                    "timeColumn" => "timestamp", 
                                                    "timeColumnType" => "timestamp", 
                                                    "where" => [
                                                                         [
                                                                            "name" => "\$__timeFilter", 
                                                                            "params" => [
                                                                            ], 
                                                                            "type" => "macro" 
                                                                         ] 
                                                                         ,

                                                                                                      


                                                                                                      [
                                                                                                         "datatype" => "int", 
                                                                                                         "name" => "", 
                                                                                                         "params" => [
                                                                                                               "enTech_idEnTech", 
                                                                                                               "=", 
                                                                                                               $panelId
                                                                                                            ], 
                                                                                                         "type" => "expression" 
                                                                                                      ]
                                                                      ] 
                                                 ], 
                                                ];

                                                $panelTarget_Waermespeicher = [
                                                    [
                                                        "datasource" => [
                                                           "type" => "Ensys Visu", 
                                                           "uid" => "nHHCjxBnk" 
                                                        ], 
                                                        "format" => "time_series", 
                                                        "group" => [
                                                           ], 
                                                        "metricColumn" => "none", 
                                                        "rawQuery" => false, 
                                                
                                                        "rawSql" => "SELECT timestamp AS \"time\", storageTempBottom FROM EtWes WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                                
                                                        "refId" => "A", 
                                                        "select" => [
                                                                 [
                                                                    [
                                                                       "params" => [
                                                                          "storageTempBottom" 
                                                                       ], 
                                                                       "type" => "column" 
                                                                    ] 
                                                                 ] 
                                                              ], 
                                                        "table" => "EtWes", 
                                                        "timeColumn" => "timestamp", 
                                                        "timeColumnType" => "timestamp", 
                                                        "where" => [
                                                                             [
                                                                                "name" => "\$__timeFilter", 
                                                                                "params" => [
                                                                                ], 
                                                                                "type" => "macro" 
                                                                             ]
                                                                             ,

                                                                                                      


                                                                             [
                                                                                "datatype" => "int", 
                                                                                "name" => "", 
                                                                                "params" => [
                                                                                      "enTech_idEnTech", 
                                                                                      "=", 
                                                                                      $panelId
                                                                                   ], 
                                                                                "type" => "expression" 
                                                                             ]
                                                                            ] 
                                                                            ],
                                                                            [
                                                                                "datasource" => [
                                                                                   "type" => "Ensys Visu", 
                                                                                   "uid" => "nHHCjxBnk" 
                                                                                ], 
                                                                                "format" => "time_series", 
                                                                                "group" => [
                                                                                   ], 
                                                                                "metricColumn" => "none", 
                                                                                "rawQuery" => false, 
                                                                        
                                                                                "rawSql" => "SELECT timestamp AS \"time\", storageTempMiddle FROM EtWes WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                                                        
                                                                                "refId" => "B", 
                                                                                "select" => [
                                                                                         [
                                                                                            [
                                                                                               "params" => [
                                                                                                  "storageTempMiddle" 
                                                                                               ], 
                                                                                               "type" => "column" 
                                                                                            ] 
                                                                                         ] 
                                                                                      ], 
                                                                                "table" => "EtWes", 
                                                                                "timeColumn" => "timestamp", 
                                                                                "timeColumnType" => "timestamp", 
                                                                                "where" => [
                                                                                                     [
                                                                                                        "name" => "\$__timeFilter", 
                                                                                                        "params" => [
                                                                                                        ], 
                                                                                                        "type" => "macro" 
                                                                                                     ]
                                                                                                     ,

                                                                                                      


                                                                                                      [
                                                                                                         "datatype" => "int", 
                                                                                                         "name" => "", 
                                                                                                         "params" => [
                                                                                                               "enTech_idEnTech", 
                                                                                                               "=", 
                                                                                                               $panelId
                                                                                                            ], 
                                                                                                         "type" => "expression" 
                                                                                                      ]
                                                                                                   
                                                                                                    ] 
                                                                                                    ],
                                                                                                    [
                                                                                                        "datasource" => [
                                                                                                           "type" => "Ensys Visu", 
                                                                                                           "uid" => "nHHCjxBnk" 
                                                                                                        ], 
                                                                                                        "format" => "time_series", 
                                                                                                        "group" => [
                                                                                                           ], 
                                                                                                        "metricColumn" => "none", 
                                                                                                        "rawQuery" => false, 
                                                                                                
                                                                                                        "rawSql" => "SELECT timestamp AS \"time\", storageTempTop FROM EtWes WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                                                                                
                                                                                                        "refId" => "C", 
                                                                                                        "select" => [
                                                                                                                 [
                                                                                                                    [
                                                                                                                       "params" => [
                                                                                                                          "storageTempTop" 
                                                                                                                       ], 
                                                                                                                       "type" => "column" 
                                                                                                                    ] 
                                                                                                                 ] 
                                                                                                              ], 
                                                                                                        "table" => "EtWes", 
                                                                                                        "timeColumn" => "timestamp", 
                                                                                                        "timeColumnType" => "timestamp", 
                                                                                                        "where" => [
                                                                                                                             [
                                                                                                                                "name" => "\$__timeFilter", 
                                                                                                                                "params" => [
                                                                                                                                ], 
                                                                                                                                "type" => "macro" 
                                                                                                                             ]
                                                                                                                             ,

                                                                                                      


                                                                                                                             [
                                                                                                                                "datatype" => "int", 
                                                                                                                                "name" => "", 
                                                                                                                                "params" => [
                                                                                                                                      "enTech_idEnTech", 
                                                                                                                                      "=", 
                                                                                                                                      $panelId
                                                                                                                                   ], 
                                                                                                                                "type" => "expression" 
                                                                                                                             ]
                                                                                                                            ] 
                                                                                                                            ]

                                
                                                    ];
                                                    $panelTarget_Solarthermieanlage = [
                                                        [
                                                            "datasource" => [
                                                               "type" => "Ensys Visu", 
                                                               "uid" => "nHHCjxBnk" 
                                                            ], 
                                                            "format" => "time_series", 
                                                            "group" => [
                                                               ], 
                                                            "metricColumn" => "none", 
                                                            "rawQuery" => false, 
                                                    
                                                            "rawSql" => "SELECT timestamp AS \"time\",power FROM EtSth WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                                    
                                                            "refId" => "A", 
                                                            "select" => [
                                                                     [
                                                                        [
                                                                           "params" => [
                                                                              "power" 
                                                                           ], 
                                                                           "type" => "column" 
                                                                        ] 
                                                                     ] 
                                                                  ], 
                                                            "table" => "EtSth", 
                                                            "timeColumn" => "timestamp", 
                                                            "timeColumnType" => "timestamp", 
                                                            "where" => [
                                                                                 [
                                                                                    "name" => "\$__timeFilter", 
                                                                                    "params" => [
                                                                                    ], 
                                                                                    "type" => "macro" 
                                                                                 ] 
                                                                                 ,

                                                                                                      


                                                                                 [
                                                                                    "datatype" => "int", 
                                                                                    "name" => "", 
                                                                                    "params" => [
                                                                                          "enTech_idEnTech", 
                                                                                          "=", 
                                                                                          $panelId
                                                                                       ], 
                                                                                    "type" => "expression" 
                                                                                 ]
                                                                              ] 
                                                         ], 
                                                        ];
                                                        $panelTarget_Waermepumpe = [
                                                            [
                                                                "datasource" => [
                                                                   "type" => "Ensys Visu", 
                                                                   "uid" => "nHHCjxBnk" 
                                                                ], 
                                                                "format" => "time_series", 
                                                                "group" => [
                                                                   ], 
                                                                "metricColumn" => "none", 
                                                                "rawQuery" => false, 
                                                        
                                                                "rawSql" => "SELECT timestamp AS \"time\",power FROM EtWp WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                                        
                                                                "refId" => "A", 
                                                                "select" => [
                                                                         [
                                                                            [
                                                                               "params" => [
                                                                                  "power" 
                                                                               ], 
                                                                               "type" => "column" 
                                                                            ] 
                                                                         ] 
                                                                      ], 
                                                                "table" => "EtWp", 
                                                                "timeColumn" => "timestamp", 
                                                                "timeColumnType" => "timestamp", 
                                                                "where" => [
                                                                                     [
                                                                                        "name" => "\$__timeFilter", 
                                                                                        "params" => [
                                                                                        ], 
                                                                                        "type" => "macro" 
                                                                                     ]
                                                                                     ,

                                                                                                      


                                                                                     [
                                                                                        "datatype" => "int", 
                                                                                        "name" => "", 
                                                                                        "params" => [
                                                                                              "enTech_idEnTech", 
                                                                                              "=", 
                                                                                              $panelId
                                                                                           ], 
                                                                                        "type" => "expression" 
                                                                                     ]
                                                                                  ] 
                                                             ], 
                                                            ];
                                                        $panelTarget_GebaeudeWaermebedarfszaehler = [
                                                            [
                                                                "datasource" => [
                                                                   "type" => "Ensys Visu", 
                                                                   "uid" => "nHHCjxBnk" 
                                                                ], 
                                                                "format" => "time_series", 
                                                                "group" => [
                                                                   ], 
                                                                "metricColumn" => "none", 
                                                                "rawQuery" => false, 
                                                        
                                                                "rawSql" => "SELECT timestamp AS \"time\", energy FROM EtGWbZ WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                                        
                                                                "refId" => "A", 
                                                                "select" => [
                                                                         [
                                                                            [
                                                                               "params" => [
                                                                                  "energy" 
                                                                               ], 
                                                                               "type" => "column" 
                                                                            ] 
                                                                         ] 
                                                                      ], 
                                                                "table" => "EtGWbZ", 
                                                                "timeColumn" => "timestamp", 
                                                                "timeColumnType" => "timestamp", 
                                                                "where" => [
                                                                                     [
                                                                                        "name" => "\$__timeFilter", 
                                                                                        "params" => [
                                                                                        ], 
                                                                                        "type" => "macro" 
                                                                                     ] 
                                                                                     ,

                                                                                                      


                                                                                                      [
                                                                                                         "datatype" => "int", 
                                                                                                         "name" => "", 
                                                                                                         "params" => [
                                                                                                               "enTech_idEnTech", 
                                                                                                               "=", 
                                                                                                               $panelId
                                                                                                            ], 
                                                                                                         "type" => "expression" 
                                                                                                      ]
                                                                                  ] 
                                                             ], 
                                                            ];
                                                            $panelTarget_Kompresskaeltemasch = [
                                                                [
                                                                    "datasource" => [
                                                                       "type" => "Ensys Visu", 
                                                                       "uid" => "nHHCjxBnk" 
                                                                    ], 
                                                                    "format" => "time_series", 
                                                                    "group" => [
                                                                       ], 
                                                                    "metricColumn" => "none", 
                                                                    "rawQuery" => false, 
                                                            
                                                                    "rawSql" => "SELECT timestamp AS \"time\",power FROM EtKkM WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                                            
                                                                    "refId" => "A", 
                                                                    "select" => [
                                                                             [
                                                                                [
                                                                                   "params" => [
                                                                                      "power" 
                                                                                   ], 
                                                                                   "type" => "column" 
                                                                                ] 
                                                                             ] 
                                                                          ], 
                                                                    "table" => "EtKkM", 
                                                                    "timeColumn" => "timestamp", 
                                                                    "timeColumnType" => "timestamp", 
                                                                    "where" => [
                                                                                         [
                                                                                            "name" => "\$__timeFilter", 
                                                                                            "params" => [
                                                                                            ], 
                                                                                            "type" => "macro" 
                                                                                         ]
                                                                                         ,

                                                                                                      


                                                                                         [
                                                                                            "datatype" => "int", 
                                                                                            "name" => "", 
                                                                                            "params" => [
                                                                                                  "enTech_idEnTech", 
                                                                                                  "=", 
                                                                                                  $panelId
                                                                                               ], 
                                                                                            "type" => "expression" 
                                                                                         ]
                                                                                      ] 
                                                                 ], 
                                                                 [
                                                                    "datasource" => [
                                                                       "type" => "Ensys Visu", 
                                                                       "uid" => "nHHCjxBnk" 
                                                                    ], 
                                                                    "format" => "time_series", 
                                                                    "group" => [
                                                                       ], 
                                                                    "metricColumn" => "none", 
                                                                    "rawQuery" => false, 
                                                            
                                                                    "rawSql" => "SELECT timestamp AS \"time\", flowTemp FROM EtKkM WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                                            
                                                                    "refId" => "B", 
                                                                    "select" => [
                                                                             [
                                                                                [
                                                                                   "params" => [
                                                                                      "flowTemp" 
                                                                                   ], 
                                                                                   "type" => "column" 
                                                                                ] 
                                                                             ] 
                                                                          ], 
                                                                    "table" => "EtKkM", 
                                                                    "timeColumn" => "timestamp", 
                                                                    "timeColumnType" => "timestamp", 
                                                                    "where" => [
                                                                                         [
                                                                                            "name" => "\$__timeFilter", 
                                                                                            "params" => [
                                                                                            ], 
                                                                                            "type" => "macro" 
                                                                                         ]
                                                                                         ,

                                                                                                      


                                                                                                      [
                                                                                                         "datatype" => "int", 
                                                                                                         "name" => "", 
                                                                                                         "params" => [
                                                                                                               "enTech_idEnTech", 
                                                                                                               "=", 
                                                                                                               $panelId
                                                                                                            ], 
                                                                                                         "type" => "expression" 
                                                                                                      ]
                                                                                        
                                                                                      ] 
                                                                 ], 
                                                                ];
                                                                $panelTarget_aboderadkm = [
                                                                    [
                                                                        "datasource" => [
                                                                           "type" => "Ensys Visu", 
                                                                           "uid" => "nHHCjxBnk" 
                                                                        ], 
                                                                        "format" => "time_series", 
                                                                        "group" => [
                                                                           ], 
                                                                        "metricColumn" => "none", 
                                                                        "rawQuery" => false, 
                                                                
                                                                        "rawSql" => "SELECT timestamp AS \"time\",power FROM EtAdAbKm WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                                                
                                                                        "refId" => "A", 
                                                                        "select" => [
                                                                                 [
                                                                                    [
                                                                                       "params" => [
                                                                                          "power" 
                                                                                       ], 
                                                                                       "type" => "column" 
                                                                                    ] 
                                                                                 ] 
                                                                              ], 
                                                                        "table" => "EtAdAbKm", 
                                                                        "timeColumn" => "timestamp", 
                                                                        "timeColumnType" => "timestamp", 
                                                                        "where" => [
                                                                                             [
                                                                                                "name" => "\$__timeFilter", 
                                                                                                "params" => [
                                                                                                ], 
                                                                                                "type" => "macro" 
                                                                                             ] 
                                                                                             ,

                                                                                                      


                                                                                             [
                                                                                                "datatype" => "int", 
                                                                                                "name" => "", 
                                                                                                "params" => [
                                                                                                      "enTech_idEnTech", 
                                                                                                      "=", 
                                                                                                      $panelId
                                                                                                   ], 
                                                                                                "type" => "expression" 
                                                                                             ]
                                                                                          ] 
                                                                     ], 

                                                                     [
                                                                        "datasource" => [
                                                                           "type" => "Ensys Visu", 
                                                                           "uid" => "nHHCjxBnk" 
                                                                        ], 
                                                                        "format" => "time_series", 
                                                                        "group" => [
                                                                           ], 
                                                                        "metricColumn" => "none", 
                                                                        "rawQuery" => false, 
                                                                
                                                                        "rawSql" => "SELECT timestamp AS \"time\", flowTemp FROM EtAdAbKm WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                                                
                                                                        "refId" => "B", 
                                                                        "select" => [
                                                                                 [
                                                                                    [
                                                                                       "params" => [
                                                                                          "flowTemp" 
                                                                                       ], 
                                                                                       "type" => "column" 
                                                                                    ] 
                                                                                 ] 
                                                                              ], 
                                                                        "table" => "EtAdAbKm", 
                                                                        "timeColumn" => "timestamp", 
                                                                        "timeColumnType" => "timestamp", 
                                                                        "where" => [
                                                                                             [
                                                                                                "name" => "\$__timeFilter", 
                                                                                                "params" => [
                                                                                                ], 
                                                                                                "type" => "macro" 
                                                                                             ] 
                                                                                             ,

                                                                                                      


                                                                                                      [
                                                                                                         "datatype" => "int", 
                                                                                                         "name" => "", 
                                                                                                         "params" => [
                                                                                                               "enTech_idEnTech", 
                                                                                                               "=", 
                                                                                                               $panelId
                                                                                                            ], 
                                                                                                         "type" => "expression" 
                                                                                                      ]
                                                                                            
                                                                                          ] 
                                                                     ], 
                                                                    ];
                                                                    $panelTarget_kaeltespeicher = [
                                                                        [
                                                                            "datasource" => [
                                                                               "type" => "Ensys Visu", 
                                                                               "uid" => "nHHCjxBnk" 
                                                                            ], 
                                                                            "format" => "time_series", 
                                                                            "group" => [
                                                                               ], 
                                                                            "metricColumn" => "none", 
                                                                            "rawQuery" => false, 
                                                                    
                                                                            "rawSql" => "SELECT timestamp AS \"time\", storageTemp FROM EtKs WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                                                    
                                                                            "refId" => "A", 
                                                                            "select" => [
                                                                                     [
                                                                                        [
                                                                                           "params" => [
                                                                                              "storageTemp" 
                                                                                           ], 
                                                                                           "type" => "column" 
                                                                                        ] 
                                                                                     ] 
                                                                                  ], 
                                                                            "table" => "EtKs", 
                                                                            "timeColumn" => "timestamp", 
                                                                            "timeColumnType" => "timestamp", 
                                                                            "where" => [
                                                                                                 [
                                                                                                    "name" => "\$__timeFilter", 
                                                                                                    "params" => [
                                                                                                    ], 
                                                                                                    "type" => "macro" 
                                                                                                 ]
                                                                                                 ,

                                                                                                      


                                                                                                      [
                                                                                                         "datatype" => "int", 
                                                                                                         "name" => "", 
                                                                                                         "params" => [
                                                                                                               "enTech_idEnTech", 
                                                                                                               "=", 
                                                                                                               $panelId
                                                                                                            ], 
                                                                                                         "type" => "expression" 
                                                                                                      ]
                                                                                               
                                                                                              ] 
                                                                         ], 
                                                                        ];
                                                                        $panelTarget_Gebaeudekaeltezaehler = [
                                                                            [
                                                                                "datasource" => [
                                                                                   "type" => "Ensys Visu", 
                                                                                   "uid" => "nHHCjxBnk" 
                                                                                ], 
                                                                                "format" => "time_series", 
                                                                                "group" => [
                                                                                   ], 
                                                                                "metricColumn" => "none", 
                                                                                "rawQuery" => false, 
                                                                        
                                                                                "rawSql" => "SELECT timestamp AS \"time\",power FROM EtGKbZ WHERE \$__timeFilter(timestamp) ORDER BY timestamp",
                                                                        
                                                                                "refId" => "A", 
                                                                                "select" => [
                                                                                         [
                                                                                            [
                                                                                               "params" => [
                                                                                                  "power" 
                                                                                               ], 
                                                                                               "type" => "column" 
                                                                                            ] 
                                                                                         ] 
                                                                                      ], 
                                                                                "table" => "EtGKbZ", 
                                                                                "timeColumn" => "timestamp", 
                                                                                "timeColumnType" => "timestamp", 
                                                                                "where" => [
                                                                                                     [
                                                                                                        "name" => "\$__timeFilter", 
                                                                                                        "params" => [
                                                                                                        ], 
                                                                                                        "type" => "macro" 
                                                                                                      ],

                                                                                                      


                                                                                                      [
                                                                                                         "datatype" => "int", 
                                                                                                         "name" => "", 
                                                                                                         "params" => [
                                                                                                               "enTech_idEnTech", 
                                                                                                               "=", 
                                                                                                               $panelId
                                                                                                            ], 
                                                                                                         "type" => "expression" 
                                                                                                      ]
                                                                                                    
                                                                                                  ] 
                                                                             ], 
                                                                            ];
                                                                            $panelTarget_defaultcase = [
                                                                                
                                                                             
                                                                                ];
                                                                        
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                



switch($request->Typ)
{
    case "PV-Anlage":
        $paneldef['targets'] = $panelTarget_PV;
        break;

    case "Stromnetzbezug":
        $paneldef['targets'] = $panelTarget_Stromnetzbezug;
        break;

    case "Batteriespeicher":
        $paneldef['targets'] = $panelTarget_Batteriespeicher;
        break;
    case "Wasserstoff Elektrolyse":
        $paneldef['targets'] = $panelTarget_WasserstoffElektrolyse;
        break;
    case "Wasserstoff Brennstoffzelle":
        $paneldef['targets'] = $panelTarget_WasserstoffBrennstoffzelle;
        break;
    case "Wasserstoff Speicher":
        $paneldef['targets'] = $panelTarget_WasserstoffSpeicher;
        break;
    case "Windkraftanlage":
        $paneldef['targets'] = $panelTarget_WindkraftAnlage;
        break;
    case "E-Ladestation":
        $paneldef['targets'] = $panelTarget_ELadestation;
        break;
    case "Hausanschlusszähler":
        $paneldef['targets'] = $panelTarget_HausanschlussZaehler;
        break;
    case "Wärmenetzbezug":
        $paneldef['targets'] = $panelTarget_WaermenetzBezug;
        break;
    case "Biomasseheizkraftwerk":
        $paneldef['targets'] = $panelTarget_Biomasseheizkraftwerk;
        break;
    case "Biomasseheizwerk":
        $paneldef['targets'] = $panelTarget_Biomasseheizwerk;
        break;
    case "Biomasseheizkessel":
        $paneldef['targets'] = $panelTarget_Biomasseheizkessel;
        break;
    case "Wärmespeicher":
        $paneldef['targets'] = $panelTarget_Waermespeicher;
        break;
    case "Solarthermieanlage":
        $paneldef['targets'] = $panelTarget_Solarthermieanlage;
        break;
    case "Wärmepumpe":
        $paneldef['targets'] = $panelTarget_Waermepumpe;
        break;
    case "Gebäude Wärmebedarfszähler":
        $paneldef['targets'] = $panelTarget_GebaeudeWaermebedarfszaehler;
        break;
    case "Kompressionskältemaschine":
        $paneldef['targets'] = $panelTarget_Kompresskaeltemasch;
        break;
    case "Ab oder Adsorbtionskältemaschine":
        $paneldef['targets'] = $panelTarget_aboderadkm;
        break;
    case "Kältespeicher":
        $paneldef['targets'] = $panelTarget_kaeltespeicher;
        break;
    case "Gebäude Kältebedarfszähler":
        $paneldef['targets'] = $panelTarget_Gebaeudekaeltezaehler;
        break;

    default:
    $paneldef['targets'] = $panelTarget_defaultcase;
    break;
 



}
    





        $oldPanels = $oldDashboard['dashboard']['panels'];

        array_push($oldPanels, $paneldef);
       
        $oldDashboard['dashboard']['panels'] = $oldPanels;

 

  
    
$createEnsysDashboard = Http::withHeaders([

        

    'Authorization' => 'Bearer eyJrIjoiQjFpUjQyZnF6U2xFM0hLb1djbjNLaWlLSVBNYXFxelMiLCJuIjoiTWljcm9ncmlkIFZpc3UiLCJpZCI6NH0=',
    'Content-Type' => 'application/json',
    'Accept' => 'application/json',
    
    
    
    
    ])->post('https://show.microgrid-lab.eu/api/dashboards/db', $oldDashboard );
    echo($createEnsysDashboard);

    //Grafana ET (Panel) erstellen ende
    

        //Tabellen-Eintrag im richtigen Typ für Echtzeitdaten
        switch ($request->Typ) {
            case "PV-Anlage":
                $Controller = new EtPvController();
                $Controller->store($enTech->id);
                break;

            case "Stromnetzbezug":
                $Controller = new EtSnBController();
                $Controller->store($enTech->id);
                break;

            case "Batteriespeicher":
                $Controller = new EtBsController();
                $Controller->store($enTech->id);
                break;

            case "Wasserstoff Elektrolyse":
                $Controller = new EtWeController();
                $Controller->store($enTech->id);
                break;

            case "Wasserstoff Brennstoffzelle":
                $Controller = new EtBsZController();
                $Controller->store($enTech->id);
                break;

            case "Wasserstoff Speicher":
                $Controller = new EtWsController();
                $Controller->store($enTech->id);
                break;

            case "Windkraftanlage":
                $Controller = new EtWkAController();
                $Controller->store($enTech->id);
                break;

            case "E-Ladestation":
                $Controller = new EtElController();
                $Controller->store($enTech->id);
                break;

            case "Hausanschlusszähler":
                $Controller = new EtHaZController();
                $Controller->store($enTech->id);
                break;

            case "Wärmenetzbezug":
                $Controller = new EtWnBController();
                $Controller->store($enTech->id);
                break;

            case "Biomasseheizkraftwerk":
                $Controller = new EtBhKwController();
                $Controller->store($enTech->id);
                break;

            case "Biomasseheizwerk":
                $Controller = new EtBmHwController();
                $Controller->store($enTech->id);
                break;

            case "Biomasseheizkessel":
                $Controller = new EtBmHkController();
                $Controller->store($enTech->id);
                break;

            case "Wärmespeicher":
                $Controller = new EtWesController();
                $Controller->store($enTech->id);
                break;

            case "Solarthermieanlage":
                $Controller = new EtSthController();
                $Controller->store($enTech->id);
                break;

            case "Wärmepumpe":
                $Controller = new EtWpController();
                $Controller->store($enTech->id);
                break;

            case "Gebäude Wärmebedarfszähler":
                $Controller = new EtGWbZController();
                $Controller->store($enTech->id);
                break;

            case "Kompressionskältemaschine":
                $Controller = new EtKkMController();
                $Controller->store($enTech->id);
                break;

            case "Ab oder Adsorbtionskältemaschine":
                $Controller = new EtAdAbKmController();
                $Controller->store($enTech->id);
                break;

            case "Kältespeicher":
                $Controller = new EtKsController();
                $Controller->store($enTech->id);
                break;

            case "Gebäude Kältebedarfszähler":
                $Controller = new EtGKbZController();
                $Controller->store($enTech->id);
                break;
        }




        return redirect("/energiesysteme")->with(['data' => $data]);


        // Http Request für Dashboard Updaten um Panels zu Adden



        // Get key of Ensys ie. uid of panel



return $path; 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnTech  $enTech
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $EnTech = EnTech::find($id);
        $data = DB::table('EnTech')->get();


        return view('energiesysteme', [
            'EnTech' => $EnTech, 'data' => $data

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EnTech  $enTech
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $EnTech = EnTech::find($id);
                
    
        //Input ID imageEditET
        
        //Code von ET hinzufügen Bild

        $image = "";
        /*
        $image = "";
        if ($request->file("imageEditET")) {
            $image = base64_encode(file_get_contents($request->file('imageEditET')));
        }
*/

        if ($request->file("imageEditET")) {
    
        

         $pathh = $request->file('imageEditET')->store('public');
   
      }
      else{
         $pathh = null;
      }
    

        $EnTech = EnTech::where('id', $id)->update([
            'longitude' => $request->input('LaengengradEditET'),
            'latitude' => $request->input('BreitengradEditET'),
            'designation' => $request->input('BezeichnungEditET'),
            'location' => $request->input('OrtEditET'),
            'description' => $request->input('BeschreibungEditET'),
            'picture' => $image,
            'imgpath' => $pathh,

        ],
    
    );




        return redirect('/energiesysteme');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnTech  $enTech
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnTech $enTech)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnTech  $enTech
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $EnTech = EnTech::find($id);

        //Grafana Löschen ET Anfang

$Entech = DB::table('EnTech')->where('id', $id)->first();

$uid = strval($Entech->enSys_idEnSys);

$getCurrentDashboard = Http::withToken('eyJrIjoiQjFpUjQyZnF6U2xFM0hLb1djbjNLaWlLSVBNYXFxelMiLCJuIjoiTWljcm9ncmlkIFZpc3UiLCJpZCI6NH0=')->get('https://show.microgrid-lab.eu/api/dashboards/uid/'. $uid);

$oldDashboard = json_decode($getCurrentDashboard,true);

$oldPanels = $oldDashboard['dashboard']['panels'];
    
        $index = 0;

        foreach($oldPanels as $key => $value)
        {
            if($value['id'] == $id)
            {
                
                break;
            }

            $index++;
        }


unset($oldPanels[$index]);

$oldDashboard['dashboard']['panels'] = $oldPanels;



$deletePanel = Http::withHeaders([

        

    'Authorization' => 'Bearer eyJrIjoiQjFpUjQyZnF6U2xFM0hLb1djbjNLaWlLSVBNYXFxelMiLCJuIjoiTWljcm9ncmlkIFZpc3UiLCJpZCI6NH0=',
    'Content-Type' => 'application/json',
    'Accept' => 'application/json',
    
    
    
    
    ])->post('https://show.microgrid-lab.eu/api/dashboards/db', $oldDashboard );

    echo($deletePanel);



//Grafana Ende

        if ($EnTech == null) {
            dd("Konnte nicht gelöscht werden");
        } else {
            $EnTech->delete();
            return redirect('/energiesysteme');
        }
    }
}
