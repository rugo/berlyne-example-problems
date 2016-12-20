<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Music Shop</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="style.css" type="text/css" charset="utf-8" />
<script type="text/javascript">
  function updateSource(song) { 
        var audio = document.getElementById('audio');

        var source = document.getElementById('mpSource');
        source.src='stream_song.php?file=' + song;

        audio.load();
        audio.play(); 
    }
</script>
</head>
<body>
<div id="wrapper">
  <h1><em>MUSIC</em> SHOP</h1>
  <div id="nav">
    <ul>
      <li><a href="index.php"><span>01</span> Home</a></li>
      <li><a href="music_player.php"><span>02</span> MUSIC PLAYER</a></li>
      <li><a href="music_videos.php"><span>04</span> MUSIC VIDEOS</a></li>
      <li><a href="contact.php"><span>05</span> CONTACT</a></li>
    </ul>
  </div>
  <div id="topcon">
    <div id="topcon-inner">
      <h2>Welcome to the Music Shop</h2>
      <p>Your best source for german folk music. Also check out our big collection of merchandise.</p>
      <p>You can buy songs and download them immediately or buy them on amazon using or affiliate link.</p>    </div>
  </div>
  <div id="content">
    <div id="body"  align="center">
        <h1>Sample Player</h1>
        <p>Click on the album cover to play a song.</p>
        <audio id="audio" controls="controls">
            <source id="mpSource" src="" type="audio/mp3"></source>
            Your browser does not support the audio format.
        </audio>

        <table>
            <tr>
                <td>Wildecker Herzbuben</td>
                <td><img src="images/wildecker.jpg" onclick="updateSource('wildecker.mp3')"></td>
            </tr>
            <tr>
                <td>Sternenregen</td>
                <td><img src="images/sternenregen.jpg" onclick="updateSource('sternenregen.mp3')"></td>
            </tr>
            <tr>
                <td>Margret Almer</td>
                <td><img src="images/munter.jpg" onclick="updateSource('munter.mp3')"></td>
            </tr>

        </table>

        </div>
      </div>
      <div class="clear"> </div>
    </div>
  </div>
</div>
</body>
</html>
