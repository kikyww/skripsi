<?php
include 'sidebar.php';
include '../koneksi.php';

$queryKb = mysqli_query($konek, "SELECT *, COUNT(id_kb) AS count FROM tb_kb");
$dataKb = $queryKb->fetch_assoc();

$queryInv = mysqli_query($konek, "SELECT *, COUNT(id_intervensi) AS inv FROM tb_intervensi");
$dataInv = $queryInv->fetch_assoc();

$queryKeluarga = mysqli_query($konek, "SELECT *, SUM(status_kb = 'KB') AS status, SUM(DATE_SUB(CURDATE(), INTERVAL 50 YEAR) <= lahir_keluarga) AS pus FROM tb_keluarga");
$dataKeluarga = $queryKeluarga->fetch_assoc();


?> 

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Akseptor Aktif</h6>
                                    <h6 class="font-extrabold mb-0"><?= $dataKeluarga['status'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total KB</h6>
                                    <h6 class="font-extrabold mb-0"><?= $dataKb['count'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">PUS</h6>
                                    <h6 class="font-extrabold mb-0"><?= $dataKeluarga['pus'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Intervensi</h6>
                                    <h6 class="font-extrabold mb-0"><?= $dataInv['inv'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="section">
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <div class="card-header">
                Chart Perkembangan KB Pertahun
            </div>
            <div class="buttons">
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
</div>

<script>
var chartData = null
var myChart = null

function getData(tahun) {
    $.ajax({
        url: '../l-kb/chrt-query.php',
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
            myChart.data.datasets[4].data = chartData['Banjarmasin Timur']

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
                },
                {
                    label: 'Banjarmasin Timur',
                    data: [],
                    backgroundColor: 'purple'
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
include 'footer.php';
?>