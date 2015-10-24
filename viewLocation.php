<?php
  include('preContent.php');
  if(!isset($_GET['loc']) || empty($_GET['loc']))  {
    echo  "Location get request invalid<br><a href='courses.php'>Go Back</a><br>";
    include('postContent.php');
    die();
  }
  if($db === null){
    echo $dbmsg;
    include('postContent.php');
    die();
  }
	$query = "SELECT * FROM locations WHERE locations.id = " . $_GET['loc']; 
    
  try { 
      $stmt = $db->prepare($query); 
      $stmt->execute(); 
  } 
  catch(PDOException $ex) { 
      die("Failed to run query: " . $ex->getMessage()); 
  } 
         
  $row = $stmt->fetch(); 
?>
<div id="map" style="height: 70%;"></div>
<script>
function initMap() {
  var loc = <?php echo "{lat: ". $row['lat'] . ", lng: " . $row['lon'] . "};"; ?>
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 14,
    center: loc
  });

  var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading"><?php echo $row['name'] ?></h1>'+
      '<div id="bodyContent">'+
      '<p>'+ $row['address'] +
      '</p></div>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
    content: contentString
  });

  var marker = new google.maps.Marker({
    position: loc,
    map: map,
    title: '<?php echo $row['name'] ?>'
  });
  marker.addListener('click', function() {
    infowindow.open(map, marker);
  });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFSUDNh4BTPppKF5GJ8t6Sx0A0fzDGOJI&callback=initMap"
        async defer></script>

<a href="#" onclick="history.go(-1);">Go back?</a>

<?php
    include('postContent.php');
?>


