/*

$(function () {

  'use strict';

  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.box-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999
  });
  $('.connectedSortable .box-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');

  

  // SLIMSCROLL FOR CHAT WIDGET
  $('#direct-chat').slimScroll({
    height: '300px'
  });
	

// sparkline
	$("#lineToday").sparkline([1,4,3,7,6,4,8,9,6,8,12], {
		type: 'line',
		width: '100%',
		height: '200',
		lineColor: '#ffffff',
		fillColor: '#398bf7',
		lineWidth: 2,
		spotRadius: 3,
	});
// world-map
jQuery('#world-map-markers').vectorMap(
{
    map: 'world_mill_en',
    backgroundColor: '#fff',
    borderColor: '#818181',
    borderOpacity: 0.25,
    borderWidth: 1,
    color: '#f4f3f0',
    regionStyle : {
        initial : {
          fill : '#c9d6de'
        }
      },
    markerStyle: {
      initial: {
                    r: 9,
                    'fill': '#fff',
                    'fill-opacity':1,
                    'stroke': '#000',
                    'stroke-width' : 5,
                    'stroke-opacity': 0.4
                },
                },
    enableZoom: true,
    hoverColor: '#0a89c1',
    markers : [{
        latLng : [21.00, 78.00],
        name : 'I Love My India'
      
      }],
    hoverOpacity: null,
    normalizeFunction: 'linear',
    scaleColors: ['#b6d6ff', '#005ace'],
    selectedColor: '#c9dfaf',
    selectedRegions: [],
    showTooltip: true,
    onRegionClick: function(element, code, region)
    {
        var message = 'You clicked "'
            + region
            + '" which has the code: '
            + code.toUpperCase();

        alert(message);
    }
});	
// usa	
$('#usa').vectorMap({
	map : 'us_aea_en',
	backgroundColor : 'transparent',
	regionStyle : {
		initial : {
			fill : '#c9d6de'
		}
	}
});


// LINE CHART

    var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: [
        {y: '2007', item1: 1234},
        {y: '2008', item1: 2345},
        {y: '2009', item1: 4896},
        {y: '2010', item1: 8954},
        {y: '2011', item1: 5698},
        {y: '2012', item1: 6987},
        {y: '2013', item1: 7896},
        {y: '2014', item1: 19001},
        {y: '2015', item1: 9632},
        {y: '2016', item1: 18001}
      ],
		xkey: 'y',
		ykeys: ['item1'],
		labels: ['Analatics'],
		lineWidth:2,
		pointFillColors: ['rgba(30,136,229,1)'],
		lineColors: ['rgba(30,136,229,1)'],
		hideHover: 'auto',
    });
	
	    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: [
        {y: 'Mon', a: 5, b: 3, c: 3},
        {y: 'Tue', a: 4, b: 2, c: 7},
        {y: 'Wed', a: 3, b: 9, c: 4},
        {y: 'Thu', a: 7, b: 5, c: 3},
        {y: 'Fri', a: 5, b: 4, c: 9},
        {y: 'Sat', a: 10, b: 6, c: 3},
		{y: 'Sun', a: 8, b: 9, c: 4}
      ],
		barColors: ['#745af2', '#fc4b6c', '#06d79c'],
		barSizeRatio: 0.5,
		barGap:5,
		xkey: 'y',
		ykeys: ['a', 'b', 'c'],
		labels: ['Morning', 'Evening', 'Night'],
		hideHover: 'auto'
    });

}); // End of use strict

*/
