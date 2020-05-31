@extends('template')

@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Hora', 'Média Vendas'],
          @foreach ($vendas_hora as $v)
          [{{ $v->hora }},  {{ $v->media }}],
          @endforeach
        ]);

        var options = {
          title: 'Média de vendas por hora',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawGauge);

      function drawGauge() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Online', {{ $usuarios_online }}]
        ]);

        var options = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>
@endsection

@section('conteudo')
	<div class="row">
		<div class="col-md-6" id="curve_chart">

		</div>
		<div class="col-md-6" id="chart_div">

		</div>
	</div>  
@endsection