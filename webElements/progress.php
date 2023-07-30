<style>
/*** RADIAL PROGRESS ***/
/* Circumference = 2πr */
/* π = 3.1415926535898 */
/* r = 35 */

svg.radial-progress {
    height: auto;
    max-width: 200px;
    padding: 1em;
    transform: rotate(-90deg);
    width: 100%;
  }
  
  svg.radial-progress circle {
    fill: rgba(0,0,0,0);
    stroke: #cccccc;
    stroke-dashoffset: 219.91148575129; /* Circumference */
    stroke-width: 7;
  }
  
  svg.radial-progress circle.incomplete { opacity: 0.25; }
  
  svg.radial-progress circle.complete { stroke-dasharray: 219.91148575129; /* Circumference */ }
  
  svg.radial-progress text {
    fill: #000000;
    font: 400 1em/1;
    text-anchor: middle;
    font-weight: bold;
  }
  
  svg.radial-progress:nth-of-type(6n+1) circle { stroke: #00457d; }
</style>

<svg class="radial-progress" data-percentage="<?php echo $value ?>" viewBox="0 0 80 80">
    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
    <circle class="complete" cx="40" cy="40" r="35" ></circle>
    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"><?php echo $value ?> %</text>
</svg> 

<script>
$(function(){

// Remove svg.radial-progress .complete inline styling
$('svg.radial-progress').each(function( index, value ) { 
    $(this).find($('circle.complete')).removeAttr( 'style' );
});

// Activate progress animation on scroll
$(window).scroll(function(){
    $('svg.radial-progress').each(function( index, value ) { 
        // If svg.radial-progress is approximately 25% vertically into the window when scrolling from the top or the bottom
        if ( 
            $(window).scrollTop() > $(this).offset().top - ($(window).height() * 0.75) &&
            $(window).scrollTop() < $(this).offset().top + $(this).height() - ($(window).height() * 0.25)
        ) {
            // Get percentage of progress
            percent = $(value).data('percentage');
            // Get radius of the svg's circle.complete
            radius = $(this).find($('circle.complete')).attr('r');
            // Get circumference (2πr)
            circumference = 2 * Math.PI * radius;
            // Get stroke-dashoffset value based on the percentage of the circumference
            strokeDashOffset = circumference - ((percent * circumference) / 100);
            // Transition progress for 1.25 seconds
            $(this).find($('circle.complete')).animate({'stroke-dashoffset': strokeDashOffset}, 1250);
        }
    });
}).trigger('scroll');

});
</script>

