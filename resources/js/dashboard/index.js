$(document).ready(function(){
    var currentUserId = $('[name="current_user_id"]').val();
    var data = [];
    var labels = [];
    var backgroundColor = [];
    var borderColor = [];
    $.ajax({
        url:'/api/get-dashboard-data/'+currentUserId,
        type:'GET',
        success:function(response){
            data = response.data;
            labels = response.labels;
            backgroundColor = response.backgroundColor;
            borderColor = response.borderColor;


            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: '# of Votes',
                        data: data,
                        backgroundColor: backgroundColor,
                        borderColor: borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    });
});