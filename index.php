<!DOCTYPE html>
<html>
<!------------------------------------------ Head --------------------------------------------------->
    <head>
        <title>Nicole's</title>
        <link rel="stylesheet" href="style/style.css">
    </head>
<!-------------------------------------- End of Head ------------------------------------------------>
   
<!----------------------------------------- Body ----------------------------------------------------> 
    <body background="Images/Back-Ground.jpg">
        <div class="container">
            <div class="header"><img src="Images/Header.png"></div>
            <div class="current"><img src="Images/Home-Page.png"></div>
            
            <div class="content">
                <div>
                    <h1 style="text-align:center;">Welcome to Nicole's Restaurant!</h1>
                    <p>an online restaurant and catering service. You can choose from the menu 
                        below and call our number, then we will deliver. Order at: <b>(763) 951-3950</b>
                        or: <b>order@nicoles-cuisine.com</b></p>
                </div>

                <hr>

                <h1 style="text-align:center;" id="Menu">Menu</h1>
                <p>Our menu rotates once a month. Everyday has a different main dish. Click on the day to 
                    see its menu. Dishes ingredients are color coded. Green for <span class="Vegetarian">vegetables,
                    </span> red for <span class="Carnivore">meat,</span> and blue for 
                    <span class="Pescatarian">fish.</span></p>

                <div id="Control_Pannel"><?php include "Pages/Control_Pannel.php"; ?></div>

<!-- ========================================= PHP =============================================== --> 
                <?php
              	
              	//Set time zone to Minneapolis, Minnesota
              	date_default_timezone_set('America/Chicago');        
                //Week number of year, weeks starting on Monday. Example: 42 (the  42nd week in the year) http://php.net/manual/en/function.date.php. % 4 results in: 1, 2, 3, or 0
                $Week = (date('W')) % 4;
                
                if ($Week == "0") {
                    $Week = 4;
                }
                //A textual representation of a day, three letters. Mon through Sun http://php.net/manual/en/function.date.php
                $Day = date('D');

                $Page = "Pages/" . "W" . $Week . "/" . "W" . $Week . "_" . $Day . ".php";

                ?>
<!-- ====================================== End of PHP =========================================== --> 

                <!--Shows the content of current day's menu in page-->
                <div id="Page"><?php include $Page; ?></div>

<!-- ====================================== JavaScript =========================================== -->
                <script> 
                    // Default week
                    var week = "W1";
                    // Default day
                    var day = "Mon";
                    // Array contains possible weeks
                    var weeks = ["W1", "W2", "W3", "W4"];
                    for (var i = 0; i < 4; i++) {
                        chooseWeek(weeks[i]);
                    }
                    // Array contains possible days
                    var days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
                    for (var i = 0; i < 7; i++) {
                        chooseDay(days[i]);
                    }
                    // Variable holds current week
                    var currentWeek = "W" + "<?php echo $Week ?>";
                    changeWeek(currentWeek);
                    // Variable holds current day
                    var currentDay = "<?php echo $Day ?>";
                    changeDay(currentDay);
//------------------------------------- Function chooseWeek ------------------------------------------
// Displays the week's menu when the corresponding image is clicked. Default day is Monday. Takes 1 parameter from the "weeks" array, line 61, which contains 4 possible values: W1, W2, W3, W4
                    function chooseWeek(choice) {
                        var clicked = document.getElementById(choice);
                        clicked.addEventListener("click", function(){
                        // When a certain week is clicked, function changeWeek(), line 106, is called.  This function takes 1 parameter, the week chosen, and changes the weeks images to show the active selection
                            changeWeek(choice);
                            week = choice;
                            day = "Mon";
                        // Function showContent(), line 144, is called. Takes 2 parameters, week and day, and includes the corresponding page which contains that day's menu
                            showContent(week, day);
                        });
                    }

//------------------------------------- Function chooseDay -------------------------------------------
// Displays the day's menu for the corresponding week when the corresponding image is clicked. Takes 1 parameter from the "days" array, line 66, which contains 7 possible values: the days of the week
                    function chooseDay(choice) {
                        var clicked = document.getElementById(choice);
                        clicked.addEventListener("click", function(){
                            // When a certain day is clicked, function changeDay(), line 126, is called. This function takes 1 parameter, the day chosen, and changes the days images to show the active selection
                            changeDay(choice);
                            day = choice;
                            // Function showContent(), line 144, is called. Takes 2 parameters, week and day, and includes the corresponding page which contains that day's menu
                            showContent(week, day);  
                        });
                    }

//----------------------------------- Function changeWeek -------------------------------------------
// Takes 1 parameter, the week chosen, and changes the weeks images to show the active selection 
                    function changeWeek(choice) {
                        var clicked = document.getElementById(choice);
                        clicked.className = "button Active";
                        week = choice;
                        // Calls function changeDay() and passes the value "Mon" to it. This shows the image corresponding to Monday to be active and resets the rest to inactive
                        changeDay("Mon");
                        for (var i = 1; i <= 4; i++) {
                            var id = "W" + i;
                            var btnId = document.getElementById(id);
                            if (id !== choice) {
                                btnId.className = "button " + id;
                            }
                        }
                    }

//----------------------------------- Function changeDay -------------------------------------------
// Takes 1 parameter, the day chosen, and changes the days images to show the active selection
                    function changeDay(choice) {
                        var clicked = document.getElementById(choice);
                        clicked.className = "button Active";
                        // Shows the image corresponding to selection to be active and resets the rest to inactive
                        for (var i = 0; i < 7; i++) {
                            var imgId = document.getElementById(days[i]);
                            if (days[i] !== choice) {
                               imgId.className = "button " + days[i];
                            }
                        }
                    }
                    
//------------------------------------- Function showContent -----------------------------------------
// Function to dynamically show content on page. Takes 2 parameters: Week and day
                    function showContent(week, day) {
                        // Empty the content of the page
                        document.getElementById("Page").innerHTML = "";
                        // Create http request
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                // Show content in page
                                document.getElementById("Page").innerHTML = this.responseText;
                            }
                        };
                        // Request content with these parameters
                        xhttp.open("GET", "Pages/" + week + "/" + week + "_" + day + ".php", true);
                        // Send content to browser
                        xhttp.send();
                    }

                </script>
<!-- ==================================== End of JavaScript ====================================== -->
            </div>
        </div>
    </body>
<!----------------------------------------- End of Body --------------------------------------------->
</html>