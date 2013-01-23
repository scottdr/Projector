// JavaScript Document

//  ///////////////////////////////////////////////////////////////////////
var ProjectId = getQueryVariable("Id", -1);
var StepId = getQueryVariable("StepId", -1);
var StepNumber = getQueryVariable("StepNumber", 1),
	len,
	count = 0,
	showContent = false;

var lessonSteps = null;

// Ribbon Code To Handle Selecting Ribbon Items & Update Content appropriately 
/* load Data for the Content area below the ribbon, call LoadStep.php with StepId or Step Number to load the contents */
function loadStep(ProjectId,StepId,id) 
{
		var urlLoadStep = "LoadStep.php";
		
			urlLoadStep += "?StepId=" + StepId + '&ProjectId=' + ProjectId;
			
		$.ajax({
			url: urlLoadStep,
			cache: false
		}).done(function( html ) {	
				$('#' + id + ' .lessonContent').html(html);	
				if(showContent){
					global();	
					showContent = false;
				};
		});
}

function loadLessonSteps()
{
	var jsonUrl = "_php/LessonNavigatorInfo.php?Id=" + ProjectId;
	
	$.ajax({
		url: jsonUrl,
		cache: false
	}).done(function( json ) {
			lessonSteps = jQuery.parseJSON( json );
			len = lessonSteps.length;
			$.each(lessonSteps, function(index, data) {
				
				$('<div>', {
					'class': 'content-div',
					id: 'content-id-' + index
				}).html('<div class="row-fluid headerr"><div class="span12"><img src="' + data.RoutineIcon + '"/><div class="lesson-carousel-caption-title">' + data.RoutineName +'</div><div class="lesson-carousel-caption-activity">' + data.StepTitle + '</div></div></div><div class="row-fluid"><div class="span12 lessonContent" style="background-color:transparent;"></div></div>').appendTo('#LessonContent');
				count++;
				loadStep(ProjectId,data.StepId, 'content-id-' + index);
				if(count === len){
					showContent = true;					
				};
			});
	});
}

function global(){
	var pages = $('#LessonContent'),
    children = $('> div', pages),
    pips = $('#pips > div'),
	firstPip = $('#pips > div:first-child'),
    pagHandler = $('#lesson-ribbon'),
    body = $('body'),
    pag = $('#pag'),
	previous = $('.previous', pag),
    next = $('.next', pag),
	popover = $('#popover');

pages.snapview('position', 0).css('width', len * 100 + '%');
children.css('width', 100 / len + '%');

$(document).on('click', '.previous, .next', function (e) {
    // next and prev buttons
    e.preventDefault();	
    var button = $(this), page = pages.snapview('position'), dir = button.is('.previous') ? -1 : 1;

    if ((page + dir) < 0 || (page + dir) === len) {
        return false;
    } else {
        pages.snapview('position', page + dir);
    };
});

$(document).on('click', '.ribbon-item', function (e) {
    // pips
    var index = $(this).index();
    pages.snapview('position', index);
});

$(document).on('click', function (e) {
	if ($(e.target).closest('.pag').length === 0 ) {
		pag.toggleClass('showing');
	};
});

$(document).on('click touchstart', function (e) {
	if ($(e.target).closest('.pag').length === 0) {
		popover.removeClass('show');
	};
});

$(document).on('snap', function () {
    // update pips
    var position = pages.snapview('position');

    pips.removeClass('selected').eq(position).addClass('selected');
    pagHandler.text(position + 1);
    pips.parent().scrollTop(position * 100);
    body.scrollTop(0);
    if (pips.closest('.popover').hasClass('show')) {
        pips.closest('.popover').removeClass('show');
    }

});

firstPip.addClass('selected');	
body.removeClass('be-invisible').addClass('its-visible');

pagHandler.click(function (e) {
	e.preventDefault();
	$(this).next().toggleClass('show');
});
};