<html>
<head>
<link href="song_styles.css" rel="stylesheet" type="text/css" />

<title>Virtual Campfire</title>
<script src="sorttable.js"></script>

<script>

function choose(url) { 
  window.currentAudioElement = document.getElementById('player');
  if (typeof window.currentAudioElement === 'undefined') { 
    alert('your browser does not like audio.');
  } else {
    if (!window.currentAudioElement.paused) {
      window.currentAudioElement.pause();
      window.currentAudioElement.currentTime = 0;   
    }
    window.currentAudioElement.src = url;
    window.currentAudioElement.play();
  }
}

</script>

</head>
<body>

<a href="https://github.com/timp/virtualcampfire"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/652c5b9acfaddf3a9c326fa6bde407b87f7be0f4/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6f72616e67655f6666373630302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_orange_ff7600.png"></a>

<audio 
  id="player" 
  type="audio/mpeg"
  loop >
</audio>
<div id="left" style='float:left; width:20%; textalign:left;'>
<div id="logo"></div>
<ul class="para">
<li>Click on song titles to play them</li>
<li>Click on headings to sort the list</li>
<li>Email <a href="mailto:fergus@virtualcampfire.co.uk">Fergus</a> to contribute songs or feedback</li>
</ul>
</div>
<h1 align='center'>Virtual Campfire</h1>
<table id="songlist" class="sortable">
<tr><th>Song</th><th class="download">mp3</th><th class="filesize">Size (MB)</th></tr>
<?php	
	$handle = opendir(".");

while ($filename = readdir($handle)) {
	if (preg_match("/mp3$/", $filename) )
	{
		$files[] = $filename;
	}
}

natcasesort($files);

foreach($files as $filename) {
    $filetime=filemtime($filename);
    $file_mb = round((filesize($filename) / 1048576), 2);
	$title=str_replace(".mp3", "", $filename );	
	$title=str_replace("_", " ", $title );	
	$title=str_replace("-", " ", $title );	
	print 
'<tr class="song">
  <td>
   <div class="song">
    <a onclick="choose(\''.rawurlencode($filename).'\')">'.$title.'</a>
   </div>
  </td>
  <td class="download">
     <a href="'.$filename.'" title="On some systems you\'ll need to right-click the \'Download\' link and choose \'Save as\' or similar, to stop it just playing the song in your browser.">Download</a>
  </td>
  <td class="filesize">'.$file_mb.'</td>
</tr>
';
}
?>
</table>
<p class="para">
This page was originally put together by <a href="http://leomurray.co.uk">Leo Murray</a> and Jack Freedman. <a href="http://oolong.co.uk">Fergus</a> just took over the development of it in September 2009.
</p>

<p class="para">
The table-sorting code is thanks to <a href="http://www.kryogenix.org/code/browser/sorttable/">Stuart Langridge</a>.
</p>

</body>
</html>
