<?php 
include '../utilities/sidebar.php';
include '../koneksi.php';

$id_user = $_SESSION['id_user'];

if(!isset($id_user)){
    header('Location: ../index.php');
}
?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chart Laporan KB</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <div class="card-header">
                Chart Total PUS dan Non-PUS Pada Kecamatan
            </div>
            <div class="buttons">
                <a class="btn btn-secondary" style="margin-right:10px;" href="report.php"><i class="fa fa-arrow-left"></i></a>
                <button class="btn btn-primary" style="margin-right:30px;" id="btn-cetak">Cetak</button>
            </div>
        </div>
        <div id="cetaks">
            <div class="d-flex justify-content-end">
                <button class="btn btn-secondary" style="margin-right:10px;" onclick="exportChartAsJPG()" type="submit">JPG</button>
                <button class="btn btn-secondary" style="margin-right:30px;" onclick="exportChartAsPNG()" type="submit">PNG</button>
            </div>
        </div>
        <div class="card-header">
            <div class="w-25">
                <label class="mb-2" for="kecSelect">Pilih Tahun:</label>
                <select class="form-select" id="kecSelect" onchange="onKecSelectChange()">
                    <option selected value="Banjarmasin Utara">Banjarmasin Utara</option>
                    <option value="Banjarmasin Barat">Banjarmasin Barat</option>
                    <option value="Banjarmasin Timur">Banjarmasin Timur</option>
                    <option value="Banjarmasin Tengah">Banjarmasin Tengah</option>
                    <option value="Banjarmasin Selatan">Banjarmasin Selatan</option>
                </select>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="chart-container" style="width:350px; height:350px; margin:auto;">
                        <canvas id="chart-profile-visit"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
var chartData = null;
var myChart = null;

function getData(kec) {
  $.ajax({
    url: 'chrt-query.php',
    type: 'GET',
    data: { kec: kec },
    dataType: 'json',
    success: function(data) {
      chartData = data;
      console.log(data)
      updateChart();
    },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}

function updateChart() {
  if (chartData) {
    var labels = ['Non-PUS', 'PUS'];
    var datasets = [];

    var data = [chartData.non_pus, chartData.pus];
    var backgroundColor = [getRandomColor(), getRandomColor()];

    datasets.push({
      data: data,
      backgroundColor: backgroundColor
    });

    myChart.data.labels = labels;
    myChart.data.datasets = datasets;

    myChart.options.title.text = 'Chart Selisih PUS dan Non-PUS pada Kecamatan ' + labels.join(', ');

    myChart.update();
  }
}

function initChart() {
  var ctx = document.getElementById('chart-profile-visit').getContext('2d');
  myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: [],
      datasets: [{
        data: [],
        backgroundColor: []
      }]
    },
    options: {
      tooltips: {
        callbacks: {
          label: function (tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function (previousValue, currentValue, currentIndex, array) {
              return previousValue + currentValue;
            });
            var currentValue = dataset.data[tooltipItem.index];
            var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
            return dataset.label + ': ' + currentValue + ' (' + percentage + '%)';
          }
        }
      },
      title: {
        display: true,
        text: 'Chart Selisih PUS dan Non-PUS pada Kecamatan '
      },
      legend: {
        position: 'top',
        labels: {
          generateLabels: function(chart) {
            var labels = Chart.defaults.plugins.legend.labels.generateLabels(chart);
            labels.forEach(function(label) {
              var datasetIndex = label.datasetIndex;
              var color = chart.data.datasets[datasetIndex].backgroundColor[0];
              label.fillStyle = color;
            });
            return labels;
          }
        }
      }
    }
  });

  updateChart();
}

initChart();


function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}


function onKecSelectChange() {
  var selectedKec = document.getElementById('kecSelect').value;
  getData(selectedKec);

  myChart.options.title.text = 'Chart Selisih PUS dan Non-Pus pada Kecamatan ' + selectedKec;
  myChart.update();
}

var defaultKec = document.getElementById('kecSelect').value;
getData(defaultKec);



$(document).ready(function() {
    $("#cetaks").hide()
    var isCetakShow = $('#cetaks').hide()
    var isCetakHide = false
    
    $('#btn-cetak').click(function(){
        if(isCetakShow){
            $('#cetaks').show()
        } if(isCetakHide) {
            $('#cetaks').hide()
        }
        isCetakHide = !isCetakHide
    })
})

function exportChartAsPNG() {
    var canvas = document.getElementById('chart-profile-visit')
    var link = document.createElement('a')
    
    link.href = canvas.toDataURL('image/png')
    link.download = "PerkembanganKB.png"
    link.click();
}

function exportChartAsJPG() {
    var canvas = document.getElementById('chart-profile-visit')
    var tempCanvas = document.createElement('canvas')
    var tempCtx = tempCanvas.getContext('2d')

    tempCanvas.width = canvas.width
    tempCanvas.height = canvas.height
    tempCtx.fillStyle = '#ffffff'
    tempCtx.fillRect(0, 0, tempCanvas.width, tempCanvas.height)
    tempCtx.drawImage(canvas, 0, 0)

    var link = document.createElement('a')
    link.href = tempCanvas.toDataURL('image/jpeg')
    link.download = 'PerkembanganKB.jpg'
    link.click()
}

</script>

<?php
include '../utilities/footer.php';
?>