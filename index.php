<?php
    $activePage = "home";
	include('preContent.php');

    $query = " 
        SELECT DATE_FORMAT(date, '%d/%m/%Y') as date, content FROM news
        ORDER BY date DESC
    "; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $rows = $stmt->fetchAll(); 
?>


<div class="col-md-6">
  <h4>About us</h4>
  <p>
    Napier Management Training ia a company who specialises in delivering world class management training programmes. 
    Currently we deliver courses in 5 areas: PRINCE2, ITIL, Change Management, Programme Management and Management of Risk. 
    We deliver each of these courses once a month in one of three locations (Aberdeen, Edinburgh and Glasgow) over 10 months of the year. 
  </p>
  <h4>Training Methodology</h4>
  <p>
    Each of our courses are taught over a 3 or 5 day (depends on individual course) in an class room environment. 
    Our courses are taught by the top experts in management training and fully prepare you for the world of project management. 
    At each of our courses you will be provided with a comprehensive manual to aid you in your training.
  </p>
  <p>
    Our courses are normally assessed by a final exam at the end of your training. 
    For further information on course assessment please use the menu bar to find out more about individual courses. 
  </p>
</div>
<div class="col-md-6">
    <div class="notice-board">
        <div class="panel panel-default">
            <div class="panel-heading">
                News Feed
            </div>
            <div class="panel-body" style="max-height: 300px;  overflow: scroll;">
                <ul>
                    <?php foreach($rows as $row): ?> 
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-align-left text-success"><?php echo $row['date']; ?></span>
                            <?php echo $row['content']; ?>
                        </a>
                    </li>
                    <?php endforeach; ?> 
                </ul>
            </div>
        </div>
    </div>
</div>         
<?php
	include('postContent.php');
?>