    // Radialize the colors
Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});

// Build the chart
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: 'Procentdel : <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y} kr',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Kroner',
        data: [
            @foreach($contributions as $contribution)
                { name: '{{ $contribution->activity_type }}', y: {{ $contribution->total_amount }} },
            @endforeach
        ]
    }],
});

Highcharts.chart('container2', {
    chart: {
        type: 'area'
    },
    accessibility: {
        description: 'En graf der viser tilkomsten af medlemmer for foreningen Enggaardens venner gennem tiden'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: 'Antal nyankomne medlemmer i Enggaardens venner gennem tiden'
    },
    xAxis: {
        title: {
            text: 'Tidspunkt'
        },
        categories: [
            @foreach ($memberData as $entry)
                '{{ $entry->month }}',
            @endforeach
        ]
    },
    yAxis: {
        title: {
            text: 'Antal medlemmer'
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
    tooltip: {
        pointFormat: 'Enggaardens venner fik <b>{point.y}</b><br/> nye medlemmer i denne måned'
    },
    plotOptions: {
        area: {
            marker: {
                enabled: false,
                symbol: 'circle',
                radius: 2,
                states: {
                    hover: {
                        enabled: true
                    }
                }
            }
        }
    },
    series: [{
        name: 'Enggaardens venner',
        data: [
            @foreach ($memberData as $point)
                {{ $point->number }},
            @endforeach
        ]
    }]
});
