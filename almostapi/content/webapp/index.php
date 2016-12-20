<?php
include 'db_conn.php';

/* 
 * During our downtime, we'll at least make the people 
 * THINK.
 */

$nick = "mysonogist";
$reason_id = 1;

if(isset($_GET['reason'])) {
    list($reason_id, $nick) = explode(" ", $_GET['reason'], 2);
}

$res = $conn->query(
        "SELECT text from reasons WHERE id=" .
        $conn->real_escape_string($reason_id)
);

$reason = $res && $res->num_rows ? $res->fetch_assoc()['text']: "an evil hacker";

?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Down for maintenance</title>
  <style type="text/css">
  .centered {
    text-align: center;
    }
    </style>
</head>

<body>
   <a href="https://github.com/H1psterCod3r"><img style="position: absolute; top: 0; left: 0; border: 0;" src="https://camo.githubusercontent.com/121cd7cbdc3e4855075ea8b558508b91ac463ac2/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f6c6566745f677265656e5f3030373230302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_left_green_007200.png"></a>
  <div class='centered'>
        <h1>Down for maintenance</h1>
        This website is down because you <?=$nick?> are <?=$reason?>. <br/>
  </div>
</body>
</html>
