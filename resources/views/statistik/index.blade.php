@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-4">Statistik Aset </h1>
    
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="card flex-fill w-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Grafik Penambahan Aset Tahunan</h5>
                        </div>
                        <div class="card-body py-3">
                            <div class="chart chart-sm">
                                <canvas id="chartjs-dashboard-line"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pie Statistik Kategori --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Kategori Aset</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="chart chart-xs">
                                <canvas id="chartjs-dashboard-pie"></canvas>
                            </div>
                        </div>

                        <table class="table mb-0">
                            <tbody>
                                @foreach ($kategori as $k)
                                    <tr>
                                        <td>{{ $k->nama }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pie Statistik Gedung --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Gedung Sebaran Aset</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="chart chart-xs">
                                <canvas id="chartjs-dashboard-pie-gedung"></canvas>
                            </div>
                        </div>
    
                        <table class="table mb-0">
                            <tbody>
                                @foreach ($gedung as $g)
                                    <tr>
                                        <td>{{ $g->nama_gedung }}</td>
                                        <td class="text-end">{{ $g->total}} aset</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pie Statistik Lantai --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Lantai Sebaran Aset</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="chart chart-xs">
                                <canvas id="chartjs-dashboard-pie-lantai"></canvas>
                            </div>
                        </div>
    
                        <table class="table mb-0">
                            <tbody>
                                @foreach ($lantai as $l)
                                    <tr>
                                        <td>{{ $l->nama_lantai }}</td>
                                        <td class="text-end">{{ $l->total}} aset</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pie Statistik Ruangan --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Ruangan Sebaran Aset</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="chart chart-xs">
                                <canvas id="chartjs-dashboard-pie-ruangan"></canvas>
                            </div>
                        </div>
    
                        <table class="table mb-0">
                            <tbody>
                                @foreach ($ruangan as $r)
                                    <tr>
                                        <td>{{ $r->nama_ruangan }}</td>
                                        <td class="text-end">{{ $r->total}} aset</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<div class="card-header">
						<h5 class="card-title">Grafik Total Harga Aset</h5>
						
					</div>
					<div class="card-body">
						<div class="chart">
							<canvas id="chartjs-line"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    {{-- Grafik Aset --}}
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "{{ $chart->type }}",
				data: {
					labels: {!! json_encode($chart->labels) !!},
					datasets: [{
						label: "Data",
						data: {!! json_encode($chart->data) !!},
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>

    {{-- Pie Statistik Kategori--}}
    <script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: {!! json_encode($pieChart->labels) !!},
					datasets: [{
						data: {!! json_encode($pieChart->data) !!},
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger,
							window.theme.success,
							window.theme.secondary,
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
	</script>

     {{-- Pie Statistik Gedung--}}
     <script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie-gedung"), {
				type: "pie",
				data: {
					labels: {!! json_encode($gedungChart->labels) !!},
					datasets: [{
						data: {!! json_encode($gedungChart->data) !!},
						backgroundColor: [
                            window.theme.success,
							window.theme.secondary,
							window.theme.primary,
							window.theme.warning,
							window.theme.danger,
							window.theme.info,
							window.theme.light,
							window.theme.dark
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
	</script>

    {{-- Pie Statistik Lantai--}}
    <script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie-lantai"), {
				type: "pie",
				data: {
					labels: {!! json_encode($lantaiChart->labels) !!},
					datasets: [{
						data: {!! json_encode($lantaiChart->data) !!},
						backgroundColor: [
                            window.theme.success,
							window.theme.secondary,
							window.theme.primary,
							window.theme.warning,
							window.theme.danger,
							window.theme.info,
							window.theme.light,
							window.theme.dark
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
	</script>

    {{-- Pie Statistik Ruangan--}}
    <script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie-ruangan"), {
				type: "pie",
				data: {
					labels: {!! json_encode($ruanganChart->labels) !!},
					datasets: [{
						data: {!! json_encode($ruanganChart->data) !!},
						backgroundColor: [
                            window.theme.success,
							window.theme.secondary,
							window.theme.primary,
							window.theme.warning,
							window.theme.danger,
							window.theme.info,
							window.theme.light,
							window.theme.dark
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
	</script>

	{{-- Total Harga Statistik --}}
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Line chart
			new Chart(document.getElementById("chartjs-line"), {
				type: "line",
				data: {
					labels: {!! json_encode($keuanganChart->labels) !!},
					datasets: [{
						data :  {!! json_encode($keuanganChart->data) !!},
						fill: true,
						borderColor: window.theme.primary,
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false,
						callbacks: {
							label: function(tooltipItem, data) {
								var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
								return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
							}
						}
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.05)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 500,
								callback: function(value, index, values){
									return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
								},
							},
							display: true,
							borderDash: [5, 5],
							gridLines: {
								color: "rgba(0,0,0,0)",
								fontColor: "#fff"
							}
						}]
					}
				}
			});
		});
	</script>
	
@endsection