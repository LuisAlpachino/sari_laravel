google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBasic);

let yearMonth = document.querySelector('#yearMonth');
yearMonth.addEventListener('change', () => {
    drawBasic();
});

let month = document.querySelector('#month');
month.addEventListener('change', () => {
    drawBasic();
})

async function drawBasic() {

    const dataReport = await getData();
    
    var data = google.visualization.arrayToDataTable([
        ['Reportes', 'No. de reportes'],
        ...dataReport
    ]);

    const totalReportsMonth = dataReport[0][1] + dataReport[1][1] + dataReport[2][1]

    const totalReport = document.querySelector('#totalMonth').textContent = totalReportsMonth;
    const approvedReport = document.querySelector('#approvedMonth').textContent = dataReport[0][1];
    const rejectedReport = document.querySelector('#rejectedMonth').textContent = dataReport[1][1];
    const pendingReport = document.querySelector('#pendingMonth').textContent = dataReport[2][1]

    let options = {
        title: 'Reportes del mes',
        colors: ['green', 'red', 'orange'],
    };

    let chart = new google.visualization.PieChart(document.getElementById('chart_month'));

    chart.draw(data, options);


    /*
    let data = new google.visualization.DataTable();
    data.addColumn('number', 'X');
    data.addColumn('number', 'Reportes aprobados');
    data.addColumn('number', 'Reportes rechazados');
    data.addColumn('number', 'Reportes pendientes');


    const dataReport = await getData();

    data.addRows(dataReport);

    let options = {
        hAxis: {
        title: 'Días',
        ticks: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31]
        },
        vAxis: {
        title: 'No. de reportes'
        },
        colors: ['green', 'red', 'orange'],
        // series: {
        //     0: {curveType: 'function'},
        //     1: {curveType: 'function'},
        //     2: {curveType: 'function'},
        // }
    };

    let chart = new google.visualization.LineChart(document.getElementById('chart_month'));

    chart.draw(data, options);

    */
}

async function getData () {
    try {
        const resp = await fetch(baseUrl+`/reports/month/${yearMonth.value}/${month.value}`);
          const {reports } = await resp.json();
          return reports;

      } catch(error) {
          // Manejo del error
          console.error(error);
      }
}


