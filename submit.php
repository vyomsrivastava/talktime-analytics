<?php
function generateToken($app_id, $app_secret){
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.symbl.ai/oauth2/token:generate',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
    "type": "application",
    "appId": "'.$app_id.'",
    "appSecret": "'.$app_secret.'"
    }',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
    ),
  ));
  $response = curl_exec($curl);
  return json_decode($response, true);
}

function getConversationAnalytics($token, $conversation_id){
  
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.symbl.ai/v1/conversations/'.$conversation_id.'/analytics',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'x-api-key: '.$token,
      'Authorization: Bearer '.$token
    ),
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  return json_decode($response, true);

}

if($_POST['app_id'] <> "" AND $_POST['app_secret']<> "" AND $_POST['conversation_id']<> ""){
  $token = generateToken($_POST['app_id'], $_POST['app_secret']);
  if(isset($token['accessToken'])){
    $token = $token['accessToken'];
    
    $conversation_stats = getConversationAnalytics($token, $_POST['conversation_id']);
    $talktime = [];
    $members = [];
    
    foreach($conversation_stats['members'] as $member_talks){
      
      array_push($talktime, $member_talks['talkTime']['seconds']);
      array_push($members, $member_talks['name']);
    }
    ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Dashboard Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
<link href="bootstrap.css" rel="stylesheet">

<meta name="theme-color" content="#7952b3">


<style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      body {
        background-color: #f9f9fa
      }

      .flex {
          -webkit-box-flex: 1;
          -ms-flex: 1 1 auto;
          flex: 1 1 auto
      }

      @media (max-width:991.98px) {
          .padding {
              padding: 1.5rem
          }
      }

      @media (max-width:767.98px) {
          .padding {
              padding: 1rem
          }
      }

      .padding {
          padding: 5rem
      }

      .card {
          background: #fff;
          border-width: 0;
          border-radius: .25rem;
          box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
          margin-bottom: 1.5rem
      }

      .card {
          position: relative;
          display: flex;
          flex-direction: column;
          min-width: 0;
          word-wrap: break-word;
          background-color: #fff;
          background-clip: border-box;
          border: 1px solid rgba(19, 24, 44, .125);
          border-radius: .25rem
      }

      .card-header {
          padding: .75rem 1.25rem;
          margin-bottom: 0;
          background-color: rgba(19, 24, 44, .03);
          border-bottom: 1px solid rgba(19, 24, 44, .125)
      }

      .card-header:first-child {
          border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
      }

      card-footer,
      .card-header {
          background-color: transparent;
          border-color: rgba(160, 175, 185, .15);
          background-clip: padding-box
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Symbl.ai</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  
</header>

<div class="container">
  <div class="row">
    <!-- <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse"> -->
    <nav id="sidebarMenu" class="col-md-3">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">
              <span data-feather="home"></span>
              Home
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>

      <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row">
                <div class="container-fluid d-flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">Symbl.ai Conversations API</div>
                            <div class="card-body" style="height: 600px">
                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                    </div>
                                </div> <canvas id="chart-line" width="500" height="500" class="chartjs-render-monitor" style="display: block; width: 500px; height: 500px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
  </div>
</div>


    <!-- <script src="bootstrap.js" ></script> -->

      <!-- <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script> -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" ></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
     
      <script src='chart.js'></script>
    <script>
       $(document).ready(function() {
            var ctx = $("#chart-line");
            var myLineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Member"],
                    datasets: [
                    <?php foreach($conversation_stats['members'] as $member_stats){ ?>
                      {
                        data: [ <?php echo $member_stats['talkTime']['seconds']; ?>],
                        label: "<?php echo $member_stats['name']; ?>",
                        borderColor: "<?php echo '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT); ?>",
                        backgroundColor: "<?php echo '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT); ?>",
                        fill: false
                      },
                    <?php } ?> 
                  ]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Talk Time Analytics (seconds)'
                    },
                    scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Talktime'
                          }
                        }]
                      }     
                }
            });
        });
    </script>
  </body>
</html>

    <?php
  }else{
    header('index.php');
  }
  
}