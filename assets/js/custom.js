function topNavToSelect() {
	// building select menu
	$('<select class="upper-nav" />').appendTo('.upperHeader .container');

	// building an option for select menu
	$('<option />', {
		'selected': 'selected',
		'value' : '',
		'text': 'Choise Page...'
	}).appendTo('.upperHeader .container select');

	$('.upperHeader ul.inline li a').each(function(){
		var target = $(this);

		$('<option />', {
			'value' : target.attr('href'),
			'text': target.text()
		}).appendTo('.upperHeader .container select');
	});
	// on clicking on link
	$('.upperHeader .container select').on('change',function(){
		window.location = $(this).find('option:selected').val();
	});
}

// building select .navbar for mobile width only
function NavToSelect() {

	// building select menu
	$('<select />').appendTo('.navbar');

	// building an option for select menu
	$('<option />', {
		'selected': 'selected',
		'value' : '',
		'text': 'Choise Page...'
	}).appendTo('.navbar select');

	$('.navbar ul li a').each(function(){
		var target = $(this);

		$('<option />', {
			'value' : target.attr('href'),
			'text': target.text()
		}).appendTo('.navbar select');
	});
	// on clicking on link
	$('.navbar select').on('change',function(){
		window.location = $(this).find('option:selected').val();
	});

}


// bootstrap tooltip invocking
function showtooltip() {
	$('a[rel=tooltip], button[rel=tooltip], input[rel=tooltip]')
	.tooltip({
		animation:false
	});
}

function cartContent() {
	$('.cart-content').find('table').click(function(e){
		e.stopPropagation();
	});
}

// flexslider on home page
function flexSlideShow() {
	$('.flexslider').flexslider({
		 animation: "slide",
		 slideshowSpeed: 4000,
		 directionNav: false,
		 pauseOnHover: true
	});
}

// bootstrap carousel in caregories grid and list
function productSlider() {
	$('.carousel').carousel();
}


// link fancybox plugin on product detail
function productFancyBox() {
//	$(".fancybox").fancybox({
//		openEffect	: 'none',
//		closeEffect	: 'none'
//	});
}

// dropdown mainnav
function dropdownMainNav() {

	$('div.navbar > ul.nav > li').hover(
		function () {
			// hide the css default behavir
			$(this).children('div').css('display', 'none');
			//show its submenu
			$(this).children('div').slideDown(150);
		}, 
		function () {
			//hide its submenu
			$(this).children('div').slideUp(350);		
		}
	);

}

// display your twiter feed here
function latestTweets() {
	
    $(".tweet").tweet({
        username: "seaofclouds",
        join_text: "auto",
        avatar_size: 0,
        count: 3,
        auto_join_text_default: "we said,", 
        auto_join_text_ed: "we",
        auto_join_text_ing: "we were",
        auto_join_text_reply: "we replied to",
        auto_join_text_url: "we were checking out",
        loading_text: "loading tweets..."
    });
}

// open and hide the side panel
function openSidePanel() {
	$('.switcher > a.Widget-toggle-link').on('click', function(e){
		e.preventDefault();
		var left = $('.switcher').css('left');
		if(left <= '-170px'){
			$(".switcher").animate({
				left: 0
			}, 200, function(){
				$(this).find('a.Widget-toggle-link').text('-');
			});
		}else{
			$(".switcher").animate({
				left: '-170px'
			}, 200, function(){
				$(this).find('a.Widget-toggle-link').text('+');
			});
		}
	});
}


// change background pattern
function changeBackgroundPattern() {
	/* cookie vars */
	var cookie_name1 = "site_pattern";
	var cookie_options1 = { path: '/', expires: 30 };
	var get_cookie1 = $.cookie('site_pattern');
	if(get_cookie1 == null){get_cookie1 = 'retina_wood'}
	// backgrounds
	$('head')
	.append('<link rel="stylesheet" id="active-bg" href="css/backgrounds/'+get_cookie1+'.css">');

	$(".switcher > .switcher-content > .pattern-switch").find('a').bind('click', function(e) {
		$('#active-bg').remove();
		e.preventDefault();
		var bgName = $(this).text();
		$.cookie(cookie_name1, bgName, cookie_options1);
		$('head')
		.append('<link rel="stylesheet" id="active-bg" href="css/backgrounds/'+bgName+'.css">');
	});
}


// change layoutStyle
function changeLayoutStyle() {
	/* cookie vars */
	var cookie_name2 = "site_layout";
	var cookie_options2 = { path: '/', expires: 30 };
	var get_cookie2 = $.cookie('site_layout');
	if(get_cookie2 == null){get_cookie2 = 'Wide'}
	//layout
	$('head')
	.append('<link rel="stylesheet" id="active-bg" href="css/layout/'+get_cookie2+'.css">');
	$(".switcher > .switcher-content > .layout-switch").find('a').bind('click', function(e){
		$('#active-layout').remove();
		e.preventDefault();
		var layoutName = $(this).text();
		$.cookie(cookie_name2, layoutName, cookie_options2);
		$('head')
		.append('<link rel="stylesheet" id="active-layout" href="css/layout/'+layoutName+'.css">');

	});
}


// change site color
function changeColorStyle() {
	/* cookie vars */
	var cookie_name3 = "site_color";
	var cookie_options3 = { path: '/', expires: 30 };
	var get_cookie3 = $.cookie('site_color');
	if(get_cookie3 == null){get_cookie3 = 'orange'}
	//layout
	$('head')
	.append('<link rel="stylesheet" id="active-bg" href="css/color/'+get_cookie3+'.css">');
	$(".switcher > .switcher-content > .color-switch").find('a').bind('click', function(e){
		$('#active-color').remove();
		e.preventDefault();
		var colorName = $(this).text();
		$.cookie(cookie_name3, colorName, cookie_options3);
		$('head')
		.append('<link rel="stylesheet" id="active-color" href="css/color/'+colorName+'.css">');

	});
}


// range price product
function rangePriceSlider() {
	$("#slider-range").slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
}


// jquery placeholder plugin to work just in IE Only
function placeholderForIEOnly() {
//	$('input, textarea').placeholder();
}



$(document).ready(function(){
	topNavToSelect();
	NavToSelect();
	showtooltip();
	cartContent();
	flexSlideShow();
	productSlider();
	productFancyBox();
	dropdownMainNav();
	latestTweets();
	openSidePanel();
	changeBackgroundPattern();
	changeLayoutStyle();
	changeColorStyle();
	rangePriceSlider();
	placeholderForIEOnly();
});