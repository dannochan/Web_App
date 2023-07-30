<footer class="my-5">
		<img class="adler" src="assets/images/bundesadler.svg.png">
		<img class="flagge" src="assets/images/deutschlandflagge.svg.png">
		<p class="h4 text-muted">Im Auftrag vom<br>Bundesamt für<br>europäische Bildung</p>
		<p class="footnav"><a href="legalnotice.php">Impressum</a> | <a href="privacynote.php">Datenschutz</a><br>
		<small class="text-muted"><i>Gruppe 3 © - 2021/22</i></small></p>
	</footer>
    <!-- Misc. Scripts -->
	<script>
	         // accordion
	          $(function() {
	              $("#accordion").accordion({
	                  collapsible: true,
					  heightStyle: "content"
	              });
	          });
	</script> 
	<script>
	      // tooltips
	      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
	       return new bootstrap.Tooltip(tooltipTriggerEl)
	      })
	</script> 
	<script>
	      // validation
	    (function() {
	       'use strict'
	       var forms = document.querySelectorAll('.needs-validation')
	       Array.prototype.slice.call(forms).forEach(function(form) {
	           form.addEventListener('submit', function(event) {
	               if (!form.checkValidity()) {
	                   event.preventDefault()
	                   event.stopPropagation()
	               }
	               form.classList.add('was-validated')
	           }, false)
	       })
	    })()
	</script> 
	<script>
	   // datepicker
	      $(function() {
	       $('#datepicker').datepicker({
	           prevText: 'Zurück',
	           prevStatus: '',
	           prevJumpText: '&#x3c;&#x3c;',
	           prevJumpStatus: '',
	           nextText: 'Vorwärts;',
	           nextStatus: '',
	           nextJumpText: '&#x3e;&#x3e;',
	           nextJumpStatus: '',
	           currentText: 'Heute',
	           currentStatus: '',
	           todayText: 'Heute',
	           todayStatus: '',
	           clearText: '-',
	           clearStatus: '',
	           closeText: 'Schließen',
	           closeStatus: '',
	           monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
	           monthNamesShort: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
	           dayNames: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
	           dayNamesShort: ['So.', 'Mo.', 'Di.', 'Mi.', 'Do.', 'Fr.', 'Sa.'],
	           dayNamesMin: ['So.', 'Mo.', 'Di.', 'Mi.', 'Do.', 'Fr.', 'Sa.'],
	           showMonthAfterYear: false,
	           showAnim: "slideDown",
	           firstDay: 1,
	           dateFormat: 'yy-mm-dd',
	           changeMonth: true,
	           changeYear: true,
	           yearRange: "1980:2006"
	       });
	      });
	</script> 
	<script>
	       // progress circle
	   $(function() {
	       $(".progress").each(function() {
	           var value = $(this).attr('data-value');
	           var left = $(this).find('.progress-left .progress-bar');
	           var right = $(this).find('.progress-right .progress-bar');
	           if (value > 0) {
	               if (value <= 50) {
	                   right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
	               } else {
	                   right.css('transform', 'rotate(180deg)')
	                   left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
	               }
	           }
	       })

	       function percentageToDegrees(percentage) {
	           return percentage / 100 * 360
	       }
	   });
	</script>
								<script>
									// tooltips
$(function() {
  $('[data-toggle="tooltip"]').tooltip({
    html: true
  });
});
</script>
	</div>
</body>
</html>