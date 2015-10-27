<?php
  $activePage = "home";
	include('preContent.php');
	require("common.php");
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
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-align-left text-success"> 25/10/15</span>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-info-sign text-danger"> 15/10/15</span>
                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-comment text-warning"> 02/10/15</span>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-edit text-danger"> 28/09/15</span>
                            Sunt in culpa qui officia deserunt mollit anim id est laborum
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-edit text-warning"> 01/09/15</span>
                            Lorem ipsum dolor sit amet ipsum dolor sit amet
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-edit text-success"> 20/08/15</span>
                            Lorem ipsum dolor sit amet ipsum dolor sit amet
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>         
<?php
	include('postContent.php');
?>