$('#nav').ready( function (){
	$('ul.bar').addClass('nav navbar-nav');
	$('ul.bar > li > a').each(function (){
		if ($(this).next().is('ul')) {
			rewrite_native_nav_to_dropdown($(this).parent('li'));
		}
		if ($(this).text() === '更多') {
			rewrite_nav_dropdown($(this));
		}
	$('#nav').show();
	});

	$('.m-nav ul li').first().addClass('first');
});
$(document).ready( function (){

	// $('#search').focus();
	$(window).scrollTop(0);

	$('.readmore a').text('Read More ··· ···');

	$('img').each( function() {
		if ( $(this).attr('width') > 1090 ) {
			$(this).attr('width', 1090);
		}
	});

});

var rewrite_native_nav_to_dropdown = function (index_native) {
	index_native.addClass('dropdown');
	index_native.children('a').addClass('dropdown-toggle');
	index_native.children('a').attr('data-toggle','dropdown');
	index_native.children('a').append(' <b class="caret"></b>');
	index_native.children('ul.sub-nav').addClass('dropdown-menu');
};

var rewrite_nav_dropdown = function (index) {
	index.parent().addClass('dropdown');
	index.addClass('dropdown-toggle');
	index.attr('data-toggle','dropdown');
	index.append(' <b class="caret"></b>');

	nav_2_html = '';
	index.parent('li').nextAll('li').each(function (){
		//隐藏正常菜单
		$(this).css('display','none');

		nav_2_html = nav_2_html + '<li>' + $(this).html() + '</li>';
	});
	index.after('<ul class="dropdown-menu">'+nav_2_html+'</ul>');
};