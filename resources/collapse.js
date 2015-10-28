var disqus_shortname = 'ljohnso16';
		// console.log('123');

jQuery(function($) {
		// console.log('started');

	$("#registry-hover").hover(
	  function () {
		$(this).prevAll().addClass("registry-shiftLeft");
		$(this).nextAll().addClass("registry-shiftRight");
	  },
	  function () {
		$(this).prevAll().removeClass("registry-shiftLeft");
		$(this).nextAll().removeClass("registry-shiftRight");
	  }
	);

	$(document).on('click', '.panel-heading span.clickable', function(e){
		var $this = $(this);
		if($this.hasClass('panel-collapsed')) {
			$this.parents('.panel').find('.panel-body').slideDown();
			$this.removeClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
			(function() {
				var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			})();
		} else {
			$this.parents('.panel').find('.panel-body').slideUp();
			$this.addClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		}
	});

});
