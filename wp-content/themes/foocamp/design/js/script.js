$j = jQuery.noConflict();

$j(document).ready(function() {

	if(!isResponsive()) {
		CustomizeMenu();
		RollUpMenu();
	}

	aitProgramTabs();
	closeableComments();
	widgetsSize("footer-widgets");
	sliderPrepareFix();
	sliderAlternativeFix();
	ApplyColorbox();
	ApplyFancyboxVideo();
	InitMisc();
	HoverZoomInit();
	OpenCloseShortcode();
});

$j(window).resize(function(){
	sliderAlternativeFix();
});

function RollUpMenu(){
	$j(".mainmenu ul li").hover(function(){
		var submenu = $j(this).children('ul');
		var size = $j(this).children('ul').children('li').size();

		$j(this).children('ul').children('li').each( function(){
			var sub = $j('.sub-menu').children('li');
			//alert(sub);
			liHeight = parseInt(sub.height());

			marT = $j('.sub-menu').children('li').css('marginTop').replace("px", "");
			marB = $j('.sub-menu').children('li').css('marginBottom').replace("px", "");

			paddT = $j('.sub-menu').children('li').css('paddingTop').replace("px", "");
			paddB = $j('.sub-menu').children('li').css('paddingBottom').replace("px", "");

			borderT = $j('.sub-menu').children('li').css('border-top-width').replace("px", "");
			borderB = $j('.sub-menu').children('li').css('border-bottom-width').replace("px", "");

			outerH = $j('.sub-menu').children('li').outerHeight();
		});

		var submenuHeight = ((liHeight*size)+(marT*size)+(marB*size)+(paddT*size)+(paddB*size)+(borderB*size));

		submenu.css("display","block");
		submenu.height("1px");

		$j(this).children('ul').stop('true','true').animate({
			height: submenuHeight
		});
	}, function(){
		$j(this).children('ul').css("display","none");
		$j(this).children('ul').css('height','1px');
	});

}

function CustomizeMenu(){
	$j(".mainmenu > ul > li").each(function(){
		if($j(this).has('ul').length){
			$j(this).addClass("parent");
		}
	});
}

function isResponsive(){
	result = false;
	if($j(window).width() <= 497){
		result = true;
	}
	return result;
}

function aitProgramTabs()
{
	var tabContent = $j('.ait-program .program-days .day-program');

	tabContent.css({
		position: 'absolute',
		visibility: 'hidden'
	});

	var tabButtons = $j('.ait-program .day-names .day-name');
/*		contentCols= tabContent.children(),
		maxHeight = Math.max.apply(null, contentCols.map(function(index) {
			if (index <= 2)
				return $j(this).outerHeight(true);
			else
				return 0;
		}).get());

	contentCols.each(function(index) {
		if (index <= 2) {
			$j(this).height(maxHeight);
		}
	});
*/
	tabContent.css({
		position: 'static',
		visibility: 'visible'
	});

	var firstTab   = tabContent.fadeOut(400)
		.delay(400)
		.first()
		.css({position: 'static'})
		.fadeIn(400);

	tabButtons.filter(function() {
		return $j(this).data('ait-day') == firstTab.data('ait-day');
	}).addClass('active');

	tabButtons.click(function() {
		tabButtons.removeClass('active');

		var dayData = $j(this).addClass('active').data('ait-day');

		tabContent.fadeOut(400).delay(400).filter(function() {
			return $j(this).data('ait-day') == dayData;
		}).css({position: 'static'}).fadeIn(400);
	});
}


function closeableComments() {
	var comments = $j('.closeable #comments'),
		commentlist = comments.find('.commentlist'),
		button 	 = comments.parent().find('.open-button');

	if(comments.children().length == 0) {
		$j('.closeable').remove();
	} else {
		button.show();

		if(button.hasClass('comments-closed') && commentlist.is(':visible')) {
			commentlist.hide();
		}

		button.click(function() {
			if (button.hasClass('comments-closed')) {
				commentlist.not(':animated').slideDown('slow') && button.removeClass('comments-closed').addClass('comments-opened').text('Close Comments');
			} else if (button.hasClass('comments-opened')) {
				commentlist.not(':animated').slideUp('slow') && button.removeClass('comments-opened').addClass('comments-closed').text('Show Comments');
			} else {
				commentlist.slideToggle();
			}
		});
	}
}

function widgetsSize(sidebar) {
	$j('.' + sidebar + ' .widget-container').each( function(index) {
		$j(this).addClass('col-' + (index + 1));
	});
}

function sliderPrepareFix(){
	if(isResponsive()){
		$j('.rev_slider_wrapper').addClass('reloadMe');
	}
}

function sliderAlternativeFix() {
	if($j(window).width() <= 768 && $j(window).width() >= 497) {
		if($j('.slider-alternative.tablet').children('img').attr('src') !== "") {
			$j('.rev_slider_wrapper').hide();
			$j('.slider-alternative.tablet').show();
		} else {
			$j('.rev_slider_wrapper').show();
			$j('.slider-alternative.tablet').hide();
		}
	} else if($j(window).width() <= 497) {
		if($j('.slider-alternative.mobile').children('img').attr('src') !== "") {
			$j('.rev_slider_wrapper').hide();
			$j('.slider-alternative.mobile').show();
		} else {
			$j('.rev_slider_wrapper').show();
			$j('.slider-alternative.mobile').hide();
		}
	} else {
		$j('.rev_slider_wrapper').show();
		$j('.slider-alternative').hide();

		if($j('.rev_slider_wrapper').hasClass('reloadMe')){
			$j('.rev_slider_wrapper').removeClass('reloadMe');
			location.reload();
		}
	}
}

function ApplyColorbox(){
	// Apply fancybox on all images
	$j("a[href$='gif']").colorbox({rel: 'group', maxHeight:"95%"});
	$j("a[href$='jpg']").colorbox({rel: 'group', maxHeight:"95%"});
	$j("a[href$='png']").colorbox({rel: 'group', maxHeight:"95%"});
}

function ApplyFancyboxVideo(){
	// AIT-Portfolio videos
	$j(".ait-portfolio a.video-type").click(function() {

		var address = this.href
		if(address.indexOf("youtube") != -1){
			// Youtube Video
			$j.fancybox({
				'padding'		: 0,
				'autoScale'		: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'title'			: this.title,
				'width'			: 680,
				'height'		: 495,
				'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
				'type'			: 'swf',
				'swf'			: {
					'wmode'		: 'transparent',
					'allowfullscreen'	: 'true'
				}
			});
		} else if (address.indexOf("vimeo") != -1){
			// Vimeo Video
			// parse vimeo ID
			var regExp = /http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
			var match = this.href.match(regExp);

			if (match){
			    $j.fancybox({
					'padding'		: 0,
					'autoScale'		: false,
					'transitionIn'	: 'elastic',
					'transitionOut'	: 'elastic',
					'title'			: this.title,
					'width'			: 680,
					'height'		: 495,
					'href'			: "http://player.vimeo.com/video/"+match[2]+"?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff",
					'type'			: 'iframe'
				});
			} else {
			    alert("not a vimeo url");
			}
		}
		return false;
	});

	// Images shortcode
	$j("a.sc-image-link.video-type").click(function() {

		var address = this.href
		if(address.indexOf("youtube") != -1){
			// Youtube Video
			$j.fancybox({
				'padding'		: 0,
				'autoScale'		: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'title'			: this.title,
				'width'			: 680,
				'height'		: 495,
				'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
				'type'			: 'swf',
				'swf'			: {
					'wmode'		: 'transparent',
					'allowfullscreen'	: 'true'
				}
			});
		} else if (address.indexOf("vimeo") != -1){
			// Vimeo Video
			// parse vimeo ID
			var regExp = /http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
			var match = this.href.match(regExp);

			if (match){
			    $j.fancybox({
					'padding'		: 0,
					'autoScale'		: false,
					'transitionIn'	: 'elastic',
					'transitionOut'	: 'elastic',
					'title'			: this.title,
					'width'			: 680,
					'height'		: 495,
					'href'			: "http://player.vimeo.com/video/"+match[2]+"?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff",
					'type'			: 'iframe'
				});
			} else {
			    alert("not a vimeo url");
			}
		}
		return false;
	});
}

function InitMisc() {
	$j('#content input, #content textarea').each(function() {
		var id 	 = $j(this).attr('id'),
			name = $j(this).attr('name');

		if(id == undefined) {
			id = "";
		}

		if( name == undefined ) {
			name = "";
		}

		if (id.length == 0 && name.length != 0) {
			$j(this).attr('id', name);
		}
	});

	$j('.mainpage label').inFieldLabels();

	$j('.rule .top').click(function(event) {
		$j("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});

	$j('.sc-notification').children('a.close').click( function(event) {
		event.preventDefault();
		$j(this).parent().fadeOut('slow');
	});

	var more = $j('.more-link')
	if (more.not(':visible')) {
		more.parent().remove();
	};

}

function HoverZoomInit() {
	//// Post images
	//$j('#container .entry-thumbnail a').hoverZoom({overlayColor:'#ffffff',overlayOpacity: 0.8,zoom:0});

	// default wordpress gallery
	$j('.entry-content .gallery-item a').hoverZoom({overlayColor:'#333',overlayOpacity: 0.8,zoom:0});

	// ait-portfolio
	$j('.entry-content .ait-portfolio a').hoverZoom({overlayColor:'#333',overlayOpacity: 0.8,zoom:0});

	// schortcodes
	$j('.entry-content a.sc-image-link').hoverZoom({overlayColor:'#333',overlayOpacity: 0.8,zoom:0});

}

function OpenCloseShortcode(){

	//$j('#content .frame .frame-close.closed').parent().find('.frame-wrap').hide();
	$j('#content .frame .frame-close.closed .close.text').hide();
	$j('#content .frame .frame-close.closed .open.text').show();

	$j('#content .frame .frame-close').click(function(){
		if($j(this).hasClass('closed')){
			var $butt = $j(this);
			$j(this).parent().find('.frame-wrap').slideDown('slow',function(){
				$butt.removeClass('closed');
				$butt.find('.close.text').show();
				$butt.find('.open.text').hide();
			});
		} else {
			var $butt = $j(this);
			$j(this).parent().find('.frame-wrap').slideUp('slow',function(){
				$butt.addClass('closed');
				$butt.find('.close.text').hide();
				$butt.find('.open.text').show();
			});

		}

	});
}