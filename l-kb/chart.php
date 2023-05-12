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
                Chart Perkembangan KB Pertahun
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
                <label class="mb-2" for="yearSelect">Pilih Tahun:</label>
                <select class="form-select" id="yearSelect" onchange="onYearSelectChange()">
                    <option class="text-center" value="">+</option>
                    <option selected value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                </select>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="chart-container">
                        <canvas id="chart-profile-visit"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
var chartData = null
var myChart = null

function getData(tahun) {
    $.ajax({
        url: 'chrt-query.php',
        type: 'GET',
        data: {tahun: tahun},
        dataType: 'json',
        success: function(data) {
            chartData = data

            myChart.data.labels = chartData.labels;
            myChart.data.datasets[0].data = chartData['Banjarmasin Utara']
            myChart.data.datasets[1].data = chartData['Banjarmasin Barat']
            myChart.data.datasets[2].data = chartData['Banjarmasin Selatan']
            myChart.data.datasets[3].data = chartData['Banjarmasin Tengah']

            myChart.update()
        }
    });
}

function getDataByMonth(kecamatan, data) {
    var result = []
    var kecamatanData = data[kecamatan]
    var labels = data.labels    
    
    for (var i = 0; i < labels.length; i++) {
        var month = labels[i]
        var monthData = kecamatanData[month]  
    
        if (monthData) {
            result.push(monthData)
        } else {
            result.push(0)
        }
    }
    return result
}

function initChart() {
    var ctx = document.getElementById('chart-profile-visit').getContext('2d')
    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'Banjarmasin Utara',
                    data: [],
                    backgroundColor: 'red'
                },
                {
                    label: 'Banjarmasin Barat',
                    data: [],
                    backgroundColor: 'blue'
                },
                {
                    label: 'Banjarmasin Selatan',
                    data: [],
                    backgroundColor: 'green'
                },
                {
                    label: 'Banjarmasin Tengah',
                    data: [],
                    backgroundColor: 'orange'
                }
            ]
        },
        options: {
            plugins: {
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Chart Perkembangan KB Tahun ' 
                }
            }
        }
    })
}

initChart();

var selectTahun = document.getElementById('select-tahun')

function onYearSelectChange() {
    var selectedYear = document.getElementById('yearSelect').value
    getData(selectedYear)

    myChart.options.plugins.title.text = 'Chart Perkembangan KB Tahun ' + selectedYear
    myChart.update()
}


var defaultYear = document.getElementById('yearSelect').value
getData(defaultYear)


$(document).ready(function() {
    var lastYear = 2025

    $("#yearSelect").change(function() {
        var selectedYear = $(this).val()
        if (selectedYear === "") {
            lastYear++;
            var newOption = "<option value='" + lastYear + "'>" + lastYear + "</option>"
            $(this).append(newOption)
            $(this).val(lastYear)
        }
    })

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