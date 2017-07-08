$(function() {
    // Donut Chart
    Morris.Donut({
        element: 'donut-asistencia',
        data: [{
            label: "Edwin y Sandra",
            value: 15
        }, {
            label: "Andres y Everly",
            value: 30
        }, {
            label: "Oscar y Xiomara",
            value: 40
        }, {
            label: "Cesar y Ruby",
            value: 20
        }],
        resize: true
    });

    // Bar Chart
    Morris.Bar({
        element: 'bar-asistencia',
        data: [{
            asistencia: 'Mayo 3',
            h: 23
        }, {
            asistencia: 'Mayo 10',
            h: 34
        }, {
            asistencia: 'Mayo 17',
            h: 13
        }, {
            asistencia: 'Mayo 24',
            h: 17
        }, {
            asistencia: 'Mayo 31',
            h: 32
        }, {
            asistencia: 'Junio 14',
            h: 38
        }, {
            asistencia: 'Julio 19',
            h: 34
        }, {
            asistencia: 'Julio 26',
            h: 38
        }, {
            asistencia: 'Agosto 2',
            h: 40
        }, {
            asistencia: 'Agosto 9',
            h: 50
        }],
        xkey: 'asistencia',
        ykeys: ['h'],
        labels: ['Integrantes'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        resize: true
    });	

    // Bar Chart
    Morris.Bar({
        element: 'bar-asistencia-genre',
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
            h: 17, m: 0
        }, {
            asistencia: 'Mayo 31',
            h: 0, m: 25
        }, {
            asistencia: 'Junio 14',
            h: 30, m: 28
        }],
        xkey: 'asistencia',
        ykeys: ['h','m'],
        labels: ['Hombres','Mujeres'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        resize: true
    });	

    // Bar Chart
    Morris.Bar({
        element: 'bar-formacionIglesia',
        data: [{
            asistencia: 'Nuevos',
            h: 40
        }, {
            asistencia: 'Encuentro',
            h: 44
        }, {
            asistencia: 'Pasos',
            h: 66
        }, {
            asistencia: 'Nivel 1',
            h: 24
        }, {
            asistencia: 'Nivel 2',
            h: 28
        }, {
            asistencia: 'Nivel 3',
            h: 18
        }, {
            asistencia: 'Conquistadores',
            h: 28
        }, {
            asistencia: 'Santificación',
            h: 16
        }, {
            asistencia: 'Servicio',
            h: 16
        }, {
            asistencia: 'Semillero',
            h: 8
        }, {
            asistencia: 'Nivel 5',
            h: 4
        }, {
            asistencia: 'Berea',
            h: 4
        }],
        xkey: 'asistencia',
        ykeys: ['h'],
        labels: ['Integrantes'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        resize: true
    });	

    Morris.Donut({
        element: 'donut-estadocivil',
        data: [{
            label: "Union libre",
            value: 48
        }, {
            label: "Recien Casados",
            value: 8
        }, {
            label: "Casados menos 5 años",
            value: 30
        }, {
            label: "Casados mas 5 años",
            value: 20
        }],
        resize: true
    });

    Morris.Donut({
        element: 'donut-EdadHijoMayor',
        data: [{
            label: "Sin hijos",
            value: 6
        }, {
            label: "Hijos 0 - 2 Año",
            value: 52
        }, {
            label: "Hijos 3 - 5 Años",
            value: 28
        }, {
            label: "Hijos 5 - 8 Años",
            value: 12
        }],
        resize: true
    });

    
});
