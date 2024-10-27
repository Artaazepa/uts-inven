"use strict";

var statistics_chart = document.getElementById("myChart");
if (statistics_chart) {
    var ctx = statistics_chart.getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            datasets: [{
                label: 'Statistics',
                data: [640, 387, 530, 302, 430, 270, 488],
                borderWidth: 5,
                borderColor: '#6777ef',
                backgroundColor: 'transparent',
                pointBackgroundColor: '#fff',
                pointBorderColor: '#6777ef',
                pointRadius: 4
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        stepSize: 150
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: '#fbfbfb',
                        lineWidth: 2
                    }
                }]
            },
        }
    });
}

// Hapus atau komentari bagian ini jika tidak digunakan
// var canvas = document.getElementById("canvasID");
// if (canvas) {
//     var ctx = canvas.getContext("2d");
// } else {
//     console.error("Canvas element not found!");
// }

// Tambahkan pengecekan untuk elemen #visitorMap
if ($('#visitorMap').length) {
    $('#visitorMap').vectorMap(
    {
      map: 'world_en',
      backgroundColor: '#ffffff',
      borderColor: '#f2f2f2',
      borderOpacity: .8,
      borderWidth: 1,
      hoverColor: '#000',
      hoverOpacity: .8,
      color: '#ddd',
      normalizeFunction: 'linear',
      selectedRegions: false,
      showTooltip: true,
      pins: {
        id: '<div class="jqvmap-circle"></div>',
        my: '<div class="jqvmap-circle"></div>',
        th: '<div class="jqvmap-circle"></div>',
        sy: '<div class="jqvmap-circle"></div>',
        eg: '<div class="jqvmap-circle"></div>',
        ae: '<div class="jqvmap-circle"></div>',
        nz: '<div class="jqvmap-circle"></div>',
        tl: '<div class="jqvmap-circle"></div>',
        ng: '<div class="jqvmap-circle"></div>',
        si: '<div class="jqvmap-circle"></div>',
        pa: '<div class="jqvmap-circle"></div>',
        au: '<div class="jqvmap-circle"></div>',
        ca: '<div class="jqvmap-circle"></div>',
        tr: '<div class="jqvmap-circle"></div>',
      },
    });
}

// weather
if (typeof $.simpleWeather === 'function') {
    getWeather();
    setInterval(getWeather, 600000);

    function getWeather() {
        $.simpleWeather({
            location: 'Bogor, Indonesia',
            unit: 'c',
            success: function(weather) {
                var html = '';
                html += '<div class="weather">';
                html += '<div class="weather-icon text-primary"><span class="wi wi-yahoo-' + weather.code + '"></span></div>';
                html += '<div class="weather-desc">';
                html += '<h4>' + weather.temp + '&deg;' + weather.units.temp + '</h4>';
                html += '<div class="weather-text">' + weather.currently + '</div>';
                html += '<ul><li>' + weather.city + ', ' + weather.region + '</li>';
                html += '<li> <i class="wi wi-strong-wind"></i> ' + weather.wind.speed+' '+weather.units.speed + '</li></ul>';
                html += '</div>';
                html += '</div>';

                $("#myWeather").html(html);
            },
            error: function(error) {
                $("#myWeather").html('<div class="alert alert-danger">'+error+'</div>');
            }
        });
    }
} else {
    console.log('SimpleWeather not available');
    $("#myWeather").html('<div class="alert alert-warning">SimpleWeather tidak tersedia</div>');
}

$(document).ready(function() {
    console.log('Document ready');
    
    $(document).on('click', '.edit-maintenance', function(e) {
        e.preventDefault();
        console.log('Edit button clicked');
        
        var id = $(this).data('id');
        console.log('Maintenance ID:', id);
        
        $.ajax({
            url: '/maintenance-schedule/' + id + '/edit',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log('Data received:', response);
                $('#item_name').val(response.item_name);
                $('#scheduled_date').val(response.scheduled_date);
                $('#status').val(response.status);
                $('#description').val(response.description);
                $('#editMaintenanceForm').attr('action', '/maintenance-schedule/' + id);
                $('#maintenance_schedule_edit_modal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log('Response Text:', xhr.responseText);
                alert('Terjadi kesalahan saat mengambil data. Silakan coba lagi.');
            }
        });
    });
});
