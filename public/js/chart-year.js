google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawYear);
// console.log(baseUrl);

let year = document.querySelector('#year');
year.addEventListener('change', () => {
  drawYear();
});

async function drawYear() {

    let data = new google.visualization.DataTable();
      data.addColumn('string', 'Month');
      data.addColumn('number', 'Reportes aprobados');
      data.addColumn('number', 'Reportes rechazados');
      data.addColumn('number', 'Reportes pendientes');

      const dataReport = await getDataYear();

      data.addRows(dataReport);

      let totalReportsYear = 0;
      let totalReportsApproved = 0;
      let totalReportsRejected = 0;
      let totalReportsPending = 0;

      dataReport.forEach(report => {
        totalReportsYear += report[1] + report[2] + report[3] ;
        totalReportsApproved += report[1];
        totalReportsRejected += report[2];
        totalReportsPending += report[3];

      });

      // console.log(totalReportsYear);

      const totalReport = document.querySelector('#totalYear').textContent = totalReportsYear;
      const approvedReport = document.querySelector('#approvedYear').textContent = totalReportsApproved;
      const rejectedReport = document.querySelector('#rejectedYear').textContent = totalReportsRejected;
      const pendingReport = document.querySelector('#pendingYear').textContent = totalReportsPending;

      // data.addRows([
      //   ['Ene', 1, 1, 2],
      //   ['Feb', 12, 9, 2],
      //   ['Mar', 21, 2, 10],
      //   ['Abr', 31, 12, 22],
      //   ['May', 11, 12, 12],
      //   ['Jun', 10, 8, 0],
      //   ['Jul', 41, 12, 6],
      //   ['Ago', 1, 1, 9],
      //   ['Sep', 1, 12, 2],
      //   ['Oct', 12, 5, 1],
      //   ['Nov', 13, 2, 6],
      //   ['Dic', 23, 12, 7],
      // ]);

    /*
    var data = google.visualization.arrayToDataTable([
        ['Meses', 'Reportes', { role: 'style' }],
        ['Feb', 8.94, '#b87333'],            // RGB value
        ['Mar', 10.49, 'silver'],            // English color name
        ['Abr', 19.30, 'gold'],

      ['May', 21.45, 'color: #e5e4e2' ], // CSS-style declaration
      ]);
    */

      let options = {
        title: 'Reportes anuales',
        hAxis: {
          title: 'Meses',
        },
        vAxis: {
          title: 'No. de reportes'
        },
        colors: ['green', 'red', 'orange'],
      };

    let chart = new google.visualization.ColumnChart(document.getElementById('chart_year'));

    chart.draw(data, options);
}

async function getDataYear () {
    try {
        const resp = await fetch(baseUrl+`/reports/year/${year.value}`);
          const { reports } = await resp.json();
          return reports;

      } catch(error) {
          // Manejo del error
          console.error(error);
      }
}




