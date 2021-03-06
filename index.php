<?php

if (isset($_GET['ajax_update'])) 
{

    echo '{"time" : ', time(),'}';
    die();
}
?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <title>Ajax polling demo</title>
    <script src="./axios.min.js"></script>
</head>

<h1>Ajax demo</h1>

<section class="update-content">
    <p>Unix time: <span id="time">NA</span></p>
</section>

<section class="control">
    <button onClick="startTimer()">Start</button>
    <button onClick="stopTimer()">Stop</button>
</section>

<script type="text/javascript">

var currentTimer = 0;


function update()
{
    //axios.get('/index.php?ajax_update')
    axios.get('/?ajax_update')
    .then(function (response) {

      console.log(response);

      
      document.querySelector('#time').innerHTML = response.data.time;

      //call update after 100ms (set to whatever suits your needs)
      currentTimer = setTimeout(function(){ update(); }, 100);

    })
    .catch(function (error) {
      console.log(error);

       //Try again  1000ms
       currentTimer = setTimeout(function(){ update(); }, 1000);

    });
}


function startTimer() {
    //Let's cheat and just call update
    update();
}

function stopTimer() {
    clearTimeout(currentTimer);
}


///Start the loop
window.onload = update;
    
</script>
