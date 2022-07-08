@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header" style="border-radius: 15px 15px 0px 0px">
                <h5>โภชนาการวันนี้</h5>
            </div>
            <div class="card-body" id="progressbar">
                <div class="row">
                    <div class="col-md-6" style="text-align: center">
                            <h5>พลังงาน</h5><br>
                            @php
                                $ie = (int) (($calories * 100.0) / $usernutrient->calories);
                                echo $calories . '/' . $usernutrient->calories . ' kcal';
                                echo "<div class='progress'>";
                                echo '<div class="progress-bar" role="progressbar" style="width:' . $ie . '%;" ></div>';
                            @endphp
                            </div>
                    </div>
                    <div class="col-md-6" style="text-align: center">
                        <h5>โปรตีน</h5><br>
                        @php
                            $pt = floatval($protein);
                            $all_pt = floatval($usernutrient->protein);
                            $ipt = (int) (($pt * 100.0) / $all_pt);
                            echo $pt . '/' . $all_pt . ' g';
                            echo "<div class='progress'>";
                            echo '<div class="progress-bar" role="progressbar" style="width:' . $ipt . '%;" ></div>';
                            
                        @endphp
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top:1% ">
                    <div class="col-md-4" style="text-align: center">
                        <h5>โพแทสเซียม</h5><br>
                        @php
                            $pts = floatval($potassium);
                            $all_pts = floatval($usernutrient->potassium);
                            $ipts = (int) (($pts * 100.0) / $all_pts);
                            echo $pts . '/' . $all_pts . ' mg';
                            if ($ipts > 90) {
                                $color = 'tomato';
                            } elseif ($ipts > 50) {
                                $color = 'tan';
                            } else {
                                $color = 'darkseagreen';
                            }
                            echo "<div class='progress'>";
                            echo '<div class="progress-bar " role="progressbar" style="background-color:' . $color . ';width:' . $ipts . '%;" ></div>';
                            
                        @endphp
                        </div>
                    </div>
                    <div class="col-md-4" style="text-align: center">
                        <h5>ฟอสฟอรัส</h5><br>
                        @php
                            $pps = floatval($phosphorus);
                            $all_pps = floatval($usernutrient->phosphorus);
                            $ipps = (int) (($pps * 100.0) / $all_pps);
                            
                            echo $pps . '/' . $all_pps . ' mg';
                            if ($ipps > 90) {
                                $color = 'tomato';
                            } elseif ($ipps > 50) {
                                $color = 'tan';
                            } else {
                                $color = 'darkseagreen';
                            }
                            echo "<div class='progress'>";
                            echo '<div class="progress-bar" role="progressbar" style="background-color:' . $color . ';width:' . $ipps . '%;" ></div>';
                            
                        @endphp
                        </div>
                    </div>
                    <div class="col-md-4" style="text-align: center">
                        <h5>โซเดียม</h5><br>
                        @php
                            $sd = floatval($sodium);
                            $all_sd = floatval($usernutrient->sodium);
                            $isd = (int) (($sd * 100.0) / $all_sd);
                            echo $sd . '/' . $all_sd . ' mg';
                            if ($isd > 90) {
                                $color = 'tomato';
                            } elseif ($isd > 50) {
                                $color = 'tan';
                            } else {
                                $color = 'darkseagreen';
                            }
                            echo "<div class='progress'>";
                            echo '<div class="progress-bar" role="progressbar" style="background-color:' . $color . ';width:' . $isd . '%;" ></div>';
                        @endphp
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="card" style="margin-top: 35px">
                    <div class="card-header" style="border-radius: 15px 15px 0px 0px">
                        รายการอาหารที่ทานวันนี้
                    </div>
                    <div class="card-body" style="padding:3%" >
                        <div class="card-content" style="height: 45vh"  id="todaymeal">
                            @foreach ($todaymeal as $r)
                                
                            <div class="card">
                                <div class="row" style="padding-top:3%;padding-bottom:1%;">
                                    <div class="col-md-9" > 
                                        <p style="padding-left:10%"><strong>{{$r->name}} </strong> </p>
                                        <p style=" padding-left:10%"> {{\Carbon\Carbon::parse($r->date)->diffForHumans() }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <form action="{{ route('meals.destroy', $r->meal_id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button style="background-color:#F37878" type="submit">ลบ</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            
                            </div>
                            <br>
                            @endforeach
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="col-md-7">
              <div class="card" style="margin-top: 35px">
            <div class="card-header" style="border-radius: 15px 15px 0px 0px">
                <h5>เมนูอาหาร</h5>
            </div>
            <div class="card-body" >
                <div class="row"style="padding:3%">
                    <div class="col-md-2" style="text-align: right">
                        <p><i class="fas fa-search"> ค้นหา</i></p>
                    </div>
                    <div class="col-md-10">
                    <input onkeyup="SearchMenu()" style="border-radius: 15px;width:80%"class="form-control" type="text" id="search_menu" name="search_menu" >
                    </div>
                </div>
                <div class="card-content"style="height: 35vh">
                    <table id="menu_table">
                    @foreach ($menus as $r)
                    <tr>
                    <td style="width:50vw">
                        <div class="card" style="padding: 1%;height:50px"  >
                            <div class="row">
                                <div class="col-lg-10" style="padding-left:10% ;min-width: 125">
                                    <p style="padding:1%">{{$r->name}}</p>
                                </div>
                                <div class="col-lg-2" style="padding:1%" >
                                    <button onclick="add_meal({{$r->id}})" >บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                   
                </table>
                </div>
                
            </div>
        </div>  
            </div>
        </div>
        
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header" style="border-radius: 15px 15px 0px 0px">
                <h5>ร้านอาหารใกล้ฉัน</h5>
            </div>
            <div class="card-body" style="height: 80vh">
                <div class="card-content">
                        @php
                    $length = count($nearby);
                    for($i = 0 ; $i<$length;$i++){
                        echo'<div style="padding-top:5% "></div>
                                <div class="card" >';
                        
                        if(isset($nearby[$i]['photos'][0]['photo_reference'])){
                            $ref = $nearby[$i]['photos'][0]['photo_reference'];
                            $img = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photo_reference=";
                            $key = "&key=AIzaSyCNh9acOa_HA38yGz3dJYdqxMX6SA3OMHA";
                        $src = "".$img.$ref.$key;
                        } else {
                            $src = $nearby[$i]['icon'] ;
                        }
                        
                        echo "<div class= 'row'>
                                <div class='col-md-5'>
                                    <a href='https://www.google.com/maps/search/?api=1&query=".$nearby[$i]['name']."'\><img  src='".$src."' width='150px' max-height='50px'></a>
                                    </div>
                                <div class ='col-md-7'>";
                                

                        echo ' <br>
                            <p style="padding-left:10%">'.$nearby[$i]['name'].'</p>
                            <p style="border-radius: 15px;padding-left:10%"><strong>สถานะ </strong>  &nbsp:&nbsp';
                                
                                if(isset($nearby[$i]['opening_hours']['open_now'])&&$nearby[$i]['opening_hours']['open_now'] == 1){
                                    echo "open";
                                } else {
                                    echo "close";
                                }
                        echo'</p>
                    </div>
                            </div>
                        
                </div>';
                    }   @endphp
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
    function add_meal(menu_id){
        $.ajax({
       type:'POST',
       url:'/meals',
       data: { _token: '{{ csrf_token() }}' ,
                menu_id
            },
       success:function(data){$("#todaymeal").load(location.href + " #todaymeal");
        $("#progressbar").load(location.href + " #progressbar");
        
        var x = document.getElementById("toast");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
       }
    });
    }
</script>
<!--For Search Menu -->
<script>
    function SearchMenu() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("search_menu");
      filter = input.value.toUpperCase();
      table = document.getElementById("menu_table");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
    }
</script>