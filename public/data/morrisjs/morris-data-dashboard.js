$(function() {
    // Bar Chart
    Morris.Bar({
        element: 'bar-asistencia-bck',
        data: [{
            asistencia: 'Mayo 3',
            p: 23
        }, {
            asistencia: 'Mayo 10',
            p: 34
        }, {
            asistencia: 'Mayo 17',
            p: 13
        }, {
            asistencia: 'Mayo 24',
            p: 17
        }, {
            asistencia: 'Mayo 31',
            p: 32
        }, {
            asistencia: 'Junio 14',
            p: 38
        }, {
            asistencia: 'Julio 19',
            p: 34
        }],
        xkey: 'asistencia',
        ykeys: ['p'],
        labels: ['Integrantes'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        resize: true
    });	

    // Bar Chart
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            asistencia: 'Mayo 3',
            h: 23, m: 34
        }, {
            asistencia: 'Mayo 10',
            h: 34, m: 23
        }, {
            asistencia: 'Mayo 17',
            h: 13, m: 24
        }, {
            asistencia: 'Mayo 24',
            h: 21, m: 18
        }, {
            asistencia: 'Mayo 31',
            h: 30, m: 27
        }],
        xkey: 'asistencia',
        ykeys: ['h','m'],
        labels: ['Hombres','Mujeres'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        resize: true
    });	
    
});
