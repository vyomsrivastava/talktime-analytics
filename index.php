
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Floating labels example for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/floating-labels/">

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="floating-labels.css" rel="stylesheet">
  </head>

  <body>
    <form class="form-signin" action="submit.php" method="POST">
      <div class="text-center mb-4">
        <img class="mb-4" src="https://symbl.ai/wp-content/uploads/2020/07/Symbl-Logo-1.svg" alt="" >
        <h1 class="h3 mb-3 font-weight-normal">Symbl.ai Conversations API</h1>
        <p>Please enter your <code>APP ID, App Secret</code> and <code>Conversation ID</code></p>
      </div>

      <div class="form-label-group">
        <input type="text" id="inputEmail" name="app_id" class="form-control" placeholder="APP ID" required autofocus>
        <label for="inputEmail">APP ID</label>
      </div>

      <div class="form-label-group">
        <input type="text" id="inputPassword" name="app_secret" class="form-control" placeholder="APP SECRET" required>
        <label for="inputPassword">App Secret</label>
      </div>

      <div class="form-label-group">
        <input type="text" id="inputCon" name="conversation_id" class="form-control" placeholder="Conversation ID" required>
        <label for="inputCon">Conversation ID</label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Generate Graph</button>
     
    </form>
  </body>
</html>
