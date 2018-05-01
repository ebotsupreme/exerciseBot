<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once (__DIR__ . "/config.php");
require_once(SITE_ROOT . "/includes/header.php");

?>
<body>
<div>Exercise Bot</div>
<br>
<div>Choose your day:</div>
<br>
<form action="./view/options.php" name="chooseYourDayForm" id="chooseYourDayForm" method="post">
<div>
    <a class="chooseDayATag" id="monday" href="javascript:void(0);">Monday</a>
    <input type="hidden" value="" name="monday">
</div>
<div>
    <a class="chooseDayATag" id="tuesday" href="javascript:void(0);">Tuesday</a>
    <input type="hidden" value="" name="tuesday">
</div>
<div>
    <a class="chooseDayATag" id="wednesday" href="javascript:void(0);">Wednesday</a>
    <input type="hidden" value="" name="wednesday">
</div>
<div>
    <a class="chooseDayATag" id="thursday" href="javascript:void(0);">Thursday</a>
    <input type="hidden" value="" name="thursday">
</div>
<div>
    <a class="chooseDayATag" id="friday" href="javascript:void(0);">Friday</a>
    <input type="hidden" value="" name="friday">
</div>
<!--    <input type="submit" name="chooseYourDayFormSubmit" id="chooseYourDayFormSubmit">-->
</form>
<script type="text/javascript">
    $(document).ready(function() {

        // this grabs the value of the day and passes it to options page with the value of day in the url
        $(".chooseDayATag").click(function(){
            var htmlString = $(this).attr("id");
            console.log(htmlString);
            $(this).next('input').val(htmlString);

            $("#chooseYourDayForm").submit(window.location.href="//localhost:80/exercise_generator/view/options.php?exerciseDay="+ htmlString);
        })
    })
</script>
</body>
</html>