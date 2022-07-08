@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header" style="border-radius: 15px 15px 0px 0px">
            <h5>โปรไฟล์</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="padding:2%">
                        <h5>ข้อมูลส่วนตัว</h5>
                        <p>ชื่อ-นามสกุล : {{ $user->name }}</p>
                        <p>อีเมล : {{ $user->email }}</p>

                        <button style="width:70px;margin-left:70%;background-color:#F37878" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">Log
                            out</button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                        <div class="row">
                            <div class="col-md-5">
                                <br>
                                <h5>น้ำหนัก-ส่วนสูง</h5>
                                <p>น้ำหนักล่าสุด : {{ $userinf->weight }} kg</p>
                                <p>ส่วนสูงล่าสุด : {{ $userinf->height }} cm</p>
                                <button style="border-radius: 25px;width:50px" onclick="WHform()">อัพเดท</button>
                            </div>
                            <div class="col-md-7">
                                <div class="card"
                                    style="height:100px;margin-top:12%;display:none;padding-top:8%;padding-left:8%"
                                    id="whform">
                                    <form method="post" action="{{ route('userinformations.store') }}">
                                        @csrf
                                        <div class="row">
                                            <p>น้ำหนัก <input style="width: 60px;height:20px;" type="text"
                                                    name="weight"> kg</p>
                                        </div>
                                        <div class="row">
                                            <p>ส่วนสูง <input style="width:60px;height:20px;" type="text" name="height">
                                                cm<button style="margin-left:8%;:20px;" type="submit">บันทึก</button></p>

                                        </div>



                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="col-md-8">
                    <div class="card" style="padding:2%" id="nutrient">
                        <h5>ค่าโภชนาการที่ต้องการต่อวัน</h5>
                        <div class="row">
                            <div class="col-md-6" style="padding: 2%">
                                <p>ค่าโภชนาการที่แนะนำ (คำนวณจากน้ำหนักและส่วนสูง) <a
                                        href="https://sriphat.med.cmu.ac.th/th/knowledge-403">อ้างอิง</a></p>
                                <div class="card"
                                    style="margin-top:2%;padding-left:3%;padding-top:2%;width:70%;background-color: #C4DFAA">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>พลังงาน</p>
                                        </div>
                                        <div class="col-sm-4" style="text-align: end">{{ $nutrient->calories }}</div>
                                        <div class="col-sm-2">kcal</div>
                                    </div>
                                </div>
                                <div class="card"
                                    style="margin-top:2%;padding-left:3%;padding-top:2%;width:70%;background-color: #C4DFAA">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>โปรตีน</p>
                                        </div>
                                        <div class="col-sm-4" style="text-align: end">{{ $nutrient->protein }}</div>
                                        <div class="col-sm-2">g</div>
                                    </div>
                                </div>
                                <div class="card"
                                    style="margin-top:2%;padding-left:3%;padding-top:2%;width:70%;background-color: #C4DFAA">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>โพแทสเซียม</p>
                                        </div>
                                        <div class="col-sm-4" style="text-align: end">{{ $nutrient->potassium }}</div>
                                        <div class="col-sm-2">mg</div>
                                    </div>
                                </div>
                                <div class="card"
                                    style="margin-top:2%;padding-left:3%;padding-top:2%;width:70%;background-color: #C4DFAA">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>ฟอสฟอรัส</p>
                                        </div>
                                        <div class="col-sm-4" style="text-align: end">{{ $nutrient->phosphorus }}</div>
                                        <div class="col-sm-2">mg</div>
                                    </div>
                                </div>
                                <div class="card"
                                    style="margin-top:2%;padding-left:3%;padding-top:1%;width:70%;background-color: #C4DFAA">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>โซเดียม</p>
                                        </div>
                                        <div class="col-sm-4" style="text-align: end">{{ $nutrient->sodium }}</div>
                                        <div class="col-sm-2">mg</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding: 2%">
                                <p>ค่าโภชนาการที่ตั้งค่าไว้ <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#nutreintform"
                                        style="border-radius: 25px; padding-left:1%">แก้ไข</button></p>
                                <div class="card"
                                    style="margin-top:2%;padding-left:3%;padding-top:2%;width:70%;background-color: #F5F0BB">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>พลังงาน</p>
                                        </div>
                                        <div class="col-sm-4" style="text-align: end">{{ $usernutrient->calories }}</div>
                                        <div class="col-sm-2">kcal</div>
                                    </div>
                                </div>
                                <div class="card"
                                    style="margin-top:2%;padding-left:3%;padding-top:2%;width:70%;background-color: #F5F0BB">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>โปรตีน</p>
                                        </div>
                                        <div class="col-sm-4" style="text-align: end">{{ $usernutrient->protein }}</div>
                                        <div class="col-sm-2">g</div>
                                    </div>
                                </div>
                                <div class="card"
                                    style="margin-top:2%;padding-left:3%;padding-top:2%;width:70%;background-color: #F5F0BB">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>โพแทสเซียม</p>
                                        </div>
                                        <div class="col-sm-4" style="text-align: end">{{ $usernutrient->potassium }}
                                        </div>
                                        <div class="col-sm-2">mg</div>
                                    </div>
                                </div>
                                <div class="card"
                                    style="margin-top:2%;padding-left:3%;padding-top:2%;width:70%;background-color: #F5F0BB">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>ฟอสฟอรัส</p>
                                        </div>
                                        <div class="col-sm-4" style="text-align: end">{{ $usernutrient->phosphorus }}
                                        </div>
                                        <div class="col-sm-2">mg</div>
                                    </div>
                                </div>
                                <div class="card"
                                    style="margin-top:2%;padding-left:3%;padding-top:1%;width:70%;background-color: #F5F0BB">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>โซเดียม</p>
                                        </div>
                                        <div class="col-sm-4" style="text-align: end">{{ $usernutrient->sodium }}</div>
                                        <div class="col-sm-2">mg</div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Edit-->
        <div class="modal fade" id="nutreintform" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <!-- Modal content-->
                <div class="modal-content" style="border-radius: 15px;">

                    <div class="modal-body" style="padding: 10%">
                        <h3>แก้ไขปริมาณสารอาหารที่ต้องการต่อวัน</h3>
                        <p style="display: none;color:#F37878" id="validate">โปรดกรอกข้อมูลให้ครบ (ตัวเลขและจุดทศนิยมเท่านั้น)</p>
                        <div class="card"
                            style="margin-top:2%;padding-left:3%;padding-top:2%;width:70%;background-color: #C4DFAA">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>พลังงาน</p>
                                </div>
                                <div class="col-sm-4" style="text-align: end"><input style="width: 100%" type="text"
                                        id="editcalories"></div>
                                <div class="col-sm-2">kcal</div>
                            </div>
                        </div>
                        <div class="card"
                            style="margin-top:2%;padding-left:3%;padding-top:2%;width:70%;background-color: #C4DFAA">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>โปรตีน</p>
                                </div>
                                <div class="col-sm-4" style="text-align: end"><input style="width: 100%" type="text"
                                        id="editprotein"></div>
                                <div class="col-sm-2">g</div>
                            </div>
                        </div>
                        <div class="card"
                            style="margin-top:2%;padding-left:3%;padding-top:2%;width:70%;background-color: #C4DFAA">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>โพแทสเซียม</p>
                                </div>
                                <div class="col-sm-4" style="text-align: end"><input style="width: 100%" type="text"
                                        id="editpotassium"></div>
                                <div class="col-sm-2">mg</div>
                            </div>
                        </div>
                        <div class="card"
                            style="margin-top:2%;padding-left:3%;padding-top:2%;width:70%;background-color: #C4DFAA">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>ฟอสฟอรัส</p>
                                </div>
                                <div class="col-sm-4" style="text-align: end"><input style="width: 100%" type="text"
                                        id="editphosphorus"></div>
                                <div class="col-sm-2">mg</div>
                            </div>
                        </div>
                        <div class="card"
                            style="margin-top:2%;padding-left:3%;padding-top:1%;width:70%;background-color: #C4DFAA">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>โซเดียม</p>
                                </div>
                                <div class="col-sm-4" style="text-align: end"><input style="width: 100%" type="text"
                                        id="editsodium"></div>
                                <div class="col-sm-2">mg</div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <button onclick="editnutrient()">บันทึก</button>
                            </div>
                            <div class="col-md-6">
                                <button id="close_modal" name="close_modal_edit" type="button"
                                    style="background-color: #F37878" data-bs-dismiss="modal">ยกเลิก</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <div id="toast">
        <div class="card" style="padding:10px;;padding:-left:10px;background-color:#90C8AC;width:150px;">
            <h5><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg> &nbsp; &nbsp; บันทึกสำเร็จ</h5>
        </div>
    </div>
@endsection

<script>
    function WHform() {
        var x = document.getElementById("whform");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    function editnutrient() {
        var calories = document.getElementById('editcalories').value ;
        var protein = document.getElementById('editprotein').value ;
        var potassium = document.getElementById('editpotassium').value ;
        var phosphorus = document.getElementById('editphosphorus').value ;
        var sodium = document.getElementById('editsodium').value ;

        
            $.ajax({
                type: 'POST',
                url: '/usernutrients',
                data: {
                    _token: '{{ csrf_token() }}',
                    calories,
                    protein,
                    potassium,
                    phosphorus,
                    sodium
                },
                error: function (xhr, status) {
                    var x = document.getElementById('validate');
                    x.style.display = "block";
                },
                success: function(data) {
                    $('#close_modal').click();
                    $("#nutrient").load(location.href + " #nutrient");
                    var x = document.getElementById("toast");
                    x.className = "show";
                    setTimeout(function() {
                        x.className = x.className.replace("show", "");
                    }, 3000);

                }
            });
        


    }
</script>
