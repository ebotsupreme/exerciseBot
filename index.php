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
    <a class="chooseDayATag" id="tuesday">Tuesday</a>
    <input type="hidden" value="Tuesday" name="tuesday">
</div>
<div>
    <a class="chooseDayATag">Wednesday</a>
    <input type="hidden" value="Wednesday" name="wednesday">
</div>
<div>
    <a class="chooseDayATag">Thursday</a>
    <input type="hidden" value="Thursday" name="thursday">
</div>
<div>
    <a class="chooseDayATag">Friday</a>
    <input type="hidden" value="Friday" name="friday" class="disappear">
</div>

</form>
<script type="text/javascript">
    $(document).ready(function() {
        $(".chooseDayATag").click(function(){
            var htmlString = $(this).attr("id");
            console.log(htmlString);
            $("#chooseYourDayForm").submit();
        })
    })
</script>
</body>
</html>