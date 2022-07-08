@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header" style="border-radius: 15px 15px 0px 0px">
                <h5>พบแพทย์ <button type="button" data-bs-toggle="modal" data-bs-target="#appform" style="margin-left:10%;background-color:beige" >+</button></h5>
            </div>
            <div class="card-body" style="padding:3%" >
               <div class="card-content" style="height:75vh" id="appointmentlist">
                @if ($appointment != null)
                    @foreach ($appointment as $r)
                        <div class="card" style="padding:3%;margin-top:2%">
                            <div class="row" style="margin-top:10px;margin-left:10px">
                                <div class="col-sm-8">
                                    <h6>{{$r->hospital}}</h6>
                                    <p>{{$r->department}} : {{$r->doctor}}</p>
                                    <p>หมายเหตุ : {{$r->note}}</p>
                                </div>
                                <div class="col-sm-4" style="margin-top:20px;">
                                    <h4>D - {{$r->date_diff}}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header" style="border-radius: 15px 15px 0px 0px">
                <h5>ค่าโภชนาการย้อนหลัง</h5>
            </div>
            <div class="card-body">
                <div class="row">

                </div>
                <div id="chart" style="height: 75vh"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="appform" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <!-- Modal content-->
            <div class="modal-content" style="border-radius: 15px;">
                
                <div class="modal-body" style="padding: 10%">
                    <h3>เพิ่มนัดพบแพทย์</h3>
                    <p style="display: none;color:#F37878" id="validate">โปรดกรอกข้อมูลให้ครบ </p>
                    <p style="margin-left:10%;"> โรงพยาบาล <input style="margin-left:10%;width:150px;border-radius:15px; " type="text" id="hospital"></p>
                    <p style="margin-left:10%;"> แผนก <input style="margin-left:17%;width:150px;border-radius:15px; " type="text" id="department"></p>
                    <p style="margin-left:10%;"> แพทย์ <input style="margin-left:17%;width:150px;border-radius:15px; " type="text" id="doctor"></p>
                    <p style="margin-left:10%;"> หมายเหตุ <input style="margin-left:13%;width:150px;border-radius:15px; " type="text" id="note"></p>
                    <p style="margin-left:10%;"> วันที่ &nbsp; <input style="width:200px" type="date" id="date"></p>

                  
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button onclick = "addappointment()">บันทึก</button>
                        </div>
                        <div class="col-md-6">
                            <button id = "close_modal" name = "close_modal_edit" type="button" style="background-color: #F37878" data-bs-dismiss="modal">ยกเลิก</button>
                        </div>
                    </div>
                    
                </div>
                
            </div>
    </div>
</div>
</div>
</div>

<div id="toast" >
<div class="card" style="padding:10px;;padding:-left:10px;background-color:#90C8AC;width:150px;" >
    <h5><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
      </svg> &nbsp; &nbsp;  บันทึกสำเร็จ</h5>
</div>
</div>

@endsection

<script>
    function addappointment(){
        var hospital = document.getElementById('hospital').value;
        var department = document.getElementById('department').value;
        var doctor = document.getElementById('doctor').value;
        var note = document.getElementById('note').value;
        var date = document.getElementById('date').value;
        $.ajax({
            type:'POST',
            url:'/appointments',
            data: { _token: '{{ csrf_token() }}' ,
                hospital,department,doctor,note,date
                },
                error: function (xhr, status) {
                    var x = document.getElementById('validate');
                    x.style.display = "block";
                },
            success:function(data){
                $('#close_modal').click();
        $("#appointmentlist").load(location.href + " #appointmentlist");
        var x = document.getElementById("toast");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);


       }
        });
    }
</script>
<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chart", am4charts.XYChart);

// Add data
chart.data = @php echo $chart_data; @endphp

// Create category axis
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "date";
categoryAxis.renderer.opposite = true;

// Create value axis
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inversed = false;
valueAxis.title.text = "ปริมาณ";
valueAxis.renderer.minLabelPosition = 0.01;

// Create series
var series1 = chart.series.push(new am4charts.LineSeries());
series1.dataFields.valueY = "calories";
series1.dataFields.categoryX = "date";
series1.name = "calories";
series1.bullets.push(new am4charts.CircleBullet());
series1.legendSettings.valueText = "{valueY}";
series1.visible  = false;

var series2 = chart.series.push(new am4charts.LineSeries());
series2.dataFields.valueY = "protein";
series2.dataFields.categoryX = "date";
series2.name = 'protein';
series2.bullets.push(new am4charts.CircleBullet());
series2.legendSettings.valueText = "{valueY}";

var series3 = chart.series.push(new am4charts.LineSeries());
series3.dataFields.valueY = "potassium";
series3.dataFields.categoryX = "date";
series3.name = 'potassium';
series3.bullets.push(new am4charts.CircleBullet());
series3.legendSettings.valueText = "{valueY}";

var series4 = chart.series.push(new am4charts.LineSeries());
series4.dataFields.valueY = "phosphorus";
series4.dataFields.categoryX = "date";
series4.name = 'phosphorus';
series4.bullets.push(new am4charts.CircleBullet());
series4.legendSettings.valueText = "{valueY}";

var series5 = chart.series.push(new am4charts.LineSeries());
series5.dataFields.valueY = "sodium";
series5.dataFields.categoryX = "date";
series5.name = 'sodium';
series5.bullets.push(new am4charts.CircleBullet());
series5.legendSettings.valueText = "{valueY}";

// Add chart cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.behavior = "zoomY";


let hs1 = series1.segments.template.states.create("hover")
hs1.properties.strokeWidth = 5;
series1.segments.template.strokeWidth = 1;

let hs2 = series2.segments.template.states.create("hover")
hs2.properties.strokeWidth = 5;
series2.segments.template.strokeWidth = 1;

let hs3 = series3.segments.template.states.create("hover")
hs3.properties.strokeWidth = 5;
series3.segments.template.strokeWidth = 1;

// Add legend
chart.legend = new am4charts.Legend();
chart.legend.itemContainers.template.events.on("over", function(event){
  var segments = event.target.dataItem.dataContext.segments;
  segments.each(function(segment){
    segment.isHover = true;
  })
})

chart.legend.itemContainers.template.events.on("out", function(event){
  var segments = event.target.dataItem.dataContext.segments;
  segments.each(function(segment){
    segment.isHover = false;
  })
})

chart.scrollbarX = new am4charts.XYChartScrollbar();
chart.scrollbarX.series.push(series1);
chart.scrollbarX.parent = chart.bottomAxesContainer;

dateAxis.start = 0.79;
dateAxis.keepSelection = true;

}); // end am4core.ready()
</script>

