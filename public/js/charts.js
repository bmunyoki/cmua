$(document).ready(function(){
    'use strict';
    const token = $("#token").val();


    setTimeout(function(){
        $('#bar').html('<p>Loading ... </p>');
        loadBarGraph();
    },1000);

    setTimeout(function(){
        $('#pie').html('<p>Loading ... </p>');
        loadPieChart();
    },2000);

    setTimeout(function(){
        $('#prevalence').html('<p>Loading ... </p>');
        loadPrevalenceMap();
    },2000);


    function loadPieChart(){
        var formData = {'_token':token};

        $.ajax({
            type        : 'POST',
            url         : '/dashboard/pie-chart',
            data        : formData,
            success     : function(result) {
                if (result.res == 1) {
                    //Success
                    Highcharts.chart('pie', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Active Cases by Criteria'
                        },
                        credits: {
                            enabled: false
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Cases',
                            colorByPoint: true,
                            data: [{
                                name: 'FGM',
                                y: result.fgm
                            }, {
                                name: 'Early Child Marriage',
                                y: result.em
                            }, {
                                name: 'Child Abuse',
                                y: result.ca
                            }]
                        }],
                        exporting: {
                            buttons: {
                                contextButton: {
                                        menuItems: [{
                                            textKey: 'downloadPNG',
                                            onclick: function () {
                                                this.exportChart();
                                            }
                                        }, {
                                            textKey: 'downloadPDF',
                                            onclick: function () {
                                                this.exportChart({
                                                    type: 'application/pdf'
                                                });
                                            }
                                        }]
                                }
                            }
                        }
                    });
                } else {
                    //Failed
                    displayErrorMessage('pie');
                } 
            }      
        })
    }


    function loadBarGraph(){
        var formData = {'_token':token};

        $.ajax({
            type        : 'POST',
            url         : '/dashboard/bar-chart',
            data        : formData,
            success     : function(data) {
                if (data.res == 1) {
                    //Success
                    Highcharts.chart('bar', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Year to Date Active Cases'
                        },
                        credits: {
                            enabled: false
                        },
                        xAxis: {
                            categories: data.months,
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'No. of Cases'
                            }
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'FGM',
                            data: data.fgm

                        }, {
                            name: 'Early Marriage',
                            data: data.em

                        }, {
                            name: 'Child Abuse',
                            data: data.ca

                        }],
                        exporting: {
                            buttons: {
                                contextButton: {
                                        menuItems: [{
                                            textKey: 'downloadPNG',
                                            onclick: function () {
                                                this.exportChart();
                                            }
                                        }, {
                                            textKey: 'downloadPDF',
                                            onclick: function () {
                                                this.exportChart({
                                                    type: 'application/pdf'
                                                });
                                            }
                                        }]
                                }
                            }
                        }
                    });
                } else {
                    //Failed
                    displayErrorMessage('bar');
                } 
            }      
        })
    }

    function loadPrevalenceMap(){
        var formData = {'_token':token};

        $.ajax({
            type        : 'POST',
            url         : '/dashboard/prevalence-map',
            data        : formData,
            success     : function(data) {
                if (data.res == 1) {
                    //Success
                    var map = new google.maps.Map(document.getElementById("prevalence"), {
                        center: new google.maps.LatLng(1.098, 36.701),
                        zoom: 9,
                        gestureHandling: 'greedy',
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    var infoWindowContent = [];

                    for (var i = 0, length = data.cases.length; i < length; i++) {
                        infoWindowContent[i] = getInfoWindowDetails(data.cases[i].firstname, data.cases[i].lastname, data.cases[i].description);
                        var latLng = new google.maps.LatLng(data.cases[i].latitude, data.cases[i].longitude);

                        // Creating a marker and putting it on the map
                        var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
                        var marker = new google.maps.Marker({
                            position: latLng,
                            map: map,
                            icon: image
                        });

                        var infoWindow = new google.maps.InfoWindow();

                        google.maps.event.addListener(marker, 'mouseover', (function(marker, i){
                            return function(){
                                infoWindow.setContent(infoWindowContent[i]);
                                infoWindow.open(map, marker);
                            }
                        })(marker, i));
                    }

                    function getInfoWindowDetails(firstname, lastname, description){
                        var contentString = '<div id="content" style="max-width: 300px;">'+
                        '<div id="siteNotice">'+
                        '</div>'+
                        '<h2>'+firstname + ' ' + lastname +'</h2>'+
                        '<div id="bodyContent">'+
                        '<p>'+description.slice(0, 75)+' ... </p>'+
                        '</div>'+
                        '</div>';

                        return contentString;
                    }

                } else {
                    //Failed
                    displayErrorMessage('pie');
                } 
            }      
        })
    }

    function displayErrorMessage(canvas){
        var canvas = document.getElementById(canvas);
        var ctx = canvas.getContext("2d");
        ctx.font="12px Verdana";
        var gradient=ctx.createLinearGradient(0,0,canvas.width,0);
        gradient.addColorStop("0","#64DD17");
        gradient.addColorStop("0.5","#1E88E5");
        gradient.addColorStop("1.0","#FF0000");
        ctx.fillStyle=gradient;
        ctx.fillText("Failed to load graph. Refresh browser and try again.",10,30);
        ctx.fillText("If persists, contact bmunyoki@heptanalytics.com.",10,50);
    }
    
})
