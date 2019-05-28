 
 $(".date_bilan_search").datetimepicker({
            language:  'fr',
            weekStart: 1,
            autoclose: 1,
            startView: 4,
            minView: 4,
            format : 'yyyy'
        });
    function bilan(data) {
            var ctx = document.getElementById("chart1").getContext("2d");
            window.myLine = new Chart(ctx,{
            type: 'bar',
            data: {
                labels: ["Maintenance", "Reparation","Vente"],
                datasets: [{
                    label: "Ordinateur",
                    backgroundColor: 'rgb(255, 205, 86)',
                    data: data.ordi,
                },{
                    label: "Reseau",
                    backgroundColor: 'rgb(75, 192, 192)',
                    data: data.reso,
                }, {
                    label: "Peripherique",
                    backgroundColor: 'rgb(0, 166, 90)',
                    data: data.peri,
                }, {
                    label: "Electrique",
                    backgroundColor: 'rgb(204, 204, 204)',
                    data: data.el,
                }]
            },
            options: {
                //responsive: true,
                title:{
                    display:true,
                    text:'Materiel'
                },
                tooltips: {
                    mode: 'index',
                },
                hover: {
                     mode: 'index',
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: ''
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value (Ar)'
                        }
                    }]
                }
            }
        });
            var ctx2 = document.getElementById("chart2").getContext("2d");
            window.myLine = new Chart(ctx2,{
                type: 'doughnut',
                data: {
                 datasets: [{
                data : data.dog,
                backgroundColor: [
                    'rgb(75, 192, 192)',
                    'rgb(255, 205, 86)',
                    'rgb(0, 166, 90)',
                    'rgb(204, 204, 204)',
                ],
            }],
            labels: [
                "Ordinateur",
                "Reseau",
                "Peripherique",
                "Electrique",
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            title: {
                display: true,
                text: 'Bilan Acquisition',
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });

}
        initialiser();
        function initialiser(){
            $.ajax({
                type:'get',
                url:'getBilan',
                success:function(data){
                    bilan(data);
                }
            });
        }
        function populate(){
            $.ajax({
                type:'get',
                url:'bilan',
                success:function(data){
                    $('.ajax_bilan').html(data);
                }
            });
        }
        $(document).on('click','.bilanrefresh',function(){
            $('input[name="keyDate"]').val("");
            initialiser();
            populate();
        });
        function refreshCanvas(date){

            $.ajax({
                type:'get',
                url : 'canvas?date='+date,
                success:function(data){
                    bilan(data);
                }
            });
        }
    $(document).on('click','.goSearch',function(){
        $('.date_bilan').html("");
        $('.date_bilan').parent().removeClass('has-error');
        var date = $('input[name="keyDate"]').val();
        if(date.trim() != ""){
            $.ajax({
                type:'get',
                url:'searchBilan?date='+date,
                success:function(data){
                    $('.ajax_bilan').html(data);
                    refreshCanvas(date);
                }
            });
        }
    });


