{if $options->countdownEnable}

{var $countdownColor = $options->countdownColor}

<section class="section countdown-section wrapper">
    <div class="countdown-container">

        {var $startDate = strtotime($options->countdownStartDate)}
        {var $endDate   = strtotime($options->countdownEndDate)}

        <script type="text/javascript">
            $j(document).ready(function(){
                JBCountDown({
                    secondsColor : {$countdownColor},
                    secondsGlow  : "none",
                    
                    minutesColor : {$countdownColor},
                    minutesGlow  : "none",
                    
                    hoursColor   : {$countdownColor},
                    hoursGlow    : "none",
                    
                    daysColor    : {$countdownColor},
                    daysGlow     : "none",
                    
                    startDate   : "{$startDate}",
                    endDate     : "{$endDate}",
                    now         : "{? echo strtotime('now');}",
                    seconds     : "{? echo date("s");}"
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
                    <p class="val" style="color: {$countdownColor};">0</p>
                    <p class="type_days type-time" style="background: {$countdownColor};">{!$options->daysHolder}</p>
                </div>
            </div>
            <!-- Days -->
            <!-- Hours -->
            <div class="clock_hours countdown-time-value">
                <div class="bgLayer">
                    <canvas id="canvas_hours" width="122" height="122">
                        Your browser does not support the HTML5 canvas tag.
                    </canvas>

                    <p class="val" style="color: {$countdownColor};">0</p>
                    <p class="type_hours type-time" style="background: {$countdownColor};">{!$options->hoursHolder}</p>
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
                        <p class="val" style="color: {$countdownColor};">0</p>
                        <p class="type_minutes type-time" style="background: {$countdownColor};">{!$options->minutesHolder}</p>
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
                    <p class="val" style="color: {$countdownColor};">0</p>
                    <p class="type_seconds type-time" style="background: {$countdownColor};">{!$options->secondsHolder}</p>
                </div>
            </div>
            <!-- Seconds -->

        </div>

        <div class="clock-done" style="display: none; color: {!$countdownColor};">
            {!$options->countdownText}
        </div>

    </div>
</section>
{/if}