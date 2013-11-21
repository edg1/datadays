<?php //netteCache[01]000471a:2:{s:4:"time";s:21:"0.85208400 1385030971";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:82:"/var/www/ed.be/datadays/wp-content/themes/foocamp/Templates/snippets/countdown.php";i:2;i:1385030726;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/ed.be/datadays/wp-content/themes/foocamp/Templates/snippets/countdown.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'dkpom8bxnw')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
if ($options->countdownEnable): ?>

<?php $countdownColor = $options->countdownColor ?>

<section class="section countdown-section wrapper">
    <div class="countdown-container">

<?php $startDate = strtotime($options->countdownStartDate) ;$endDate   = strtotime($options->countdownEndDate) ?>

        <script type="text/javascript">
            $j(document).ready(function(){
                JBCountDown({
                    secondsColor : <?php echo NTemplateHelpers::escapeJs($countdownColor) ?>,
                    secondsGlow  : "none",
                    
                    minutesColor : <?php echo NTemplateHelpers::escapeJs($countdownColor) ?>,
                    minutesGlow  : "none",
                    
                    hoursColor   : <?php echo NTemplateHelpers::escapeJs($countdownColor) ?>,
                    hoursGlow    : "none",
                    
                    daysColor    : <?php echo NTemplateHelpers::escapeJs($countdownColor) ?>,
                    daysGlow     : "none",
                    
                    startDate   : "<?php echo NTemplateHelpers::escapeJs($startDate) ?>",
                    endDate     : "<?php echo NTemplateHelpers::escapeJs($endDate) ?>",
                    now         : "<?php echo strtotime('now') ?>",
                    seconds     : "<?php echo date("s") ?>"
                });
            });
        </script>

        <div class="clock wrapper">
            
            <!-- Days -->
            <div class="clock_days countdown-time-value">
                <div class="bgLayer">
                    <canvas id="canvas_days" width="122" height="122">
                        Your browser does not support the HTML5 canvas tag.
                    </canvas>
                    <p class="val" style="color: <?php echo htmlSpecialChars(NTemplateHelpers::escapeCss($countdownColor)) ?>;">0</p>
                    <p class="type_days type-time" style="background: <?php echo htmlSpecialChars(NTemplateHelpers::escapeCss($countdownColor)) ?>
;"><?php echo $options->daysHolder ?></p>
                </div>
            </div>
            <!-- Days -->
            <!-- Hours -->
            <div class="clock_hours countdown-time-value">
                <div class="bgLayer">
                    <canvas id="canvas_hours" width="122" height="122">
                        Your browser does not support the HTML5 canvas tag.
                    </canvas>

                    <p class="val" style="color: <?php echo htmlSpecialChars(NTemplateHelpers::escapeCss($countdownColor)) ?>;">0</p>
                    <p class="type_hours type-time" style="background: <?php echo htmlSpecialChars(NTemplateHelpers::escapeCss($countdownColor)) ?>
;"><?php echo $options->hoursHolder ?></p>
                </div>
            </div>
            <!-- Hours -->
            <!-- Minutes -->
            <div class="clock_minutes countdown-time-value">
                <div class="bgLayer">
                    <canvas id="canvas_minutes" width="122" height="122">
                        Your browser does not support the HTML5 canvas tag.
                    </canvas>
                    <div class="text">
                        <p class="val" style="color: <?php echo htmlSpecialChars(NTemplateHelpers::escapeCss($countdownColor)) ?>;">0</p>
                        <p class="type_minutes type-time" style="background: <?php echo htmlSpecialChars(NTemplateHelpers::escapeCss($countdownColor)) ?>
;"><?php echo $options->minutesHolder ?></p>
                    </div>
                </div>
            </div>
            <!-- Minutes -->
            <!-- Seconds -->
            <div class="clock_seconds countdown-time-value">
                <div class="bgLayer">
                    <canvas id="canvas_seconds" width="122" height="122">
                        Your browser does not support the HTML5 canvas tag.
                    </canvas>
                    <p class="val" style="color: <?php echo htmlSpecialChars(NTemplateHelpers::escapeCss($countdownColor)) ?>;">0</p>
                    <p class="type_seconds type-time" style="background: <?php echo htmlSpecialChars(NTemplateHelpers::escapeCss($countdownColor)) ?>
;"><?php echo $options->secondsHolder ?></p>
                </div>
            </div>
            <!-- Seconds -->

        </div>

        <div class="clock-done" style="display: none; color: <?php echo $countdownColor ?>;">
            <?php echo $options->countdownText ?>

        </div>

    </div>
</section>
<?php endif ;
