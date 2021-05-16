$(function () {




    $.ajax({
        url: "getworkload.php",
        type: "POST",
        dataType: "json",
        error: function () {
            alert('Error loading XML document');
        },
        success: function (data, status) {
            console.log(data);
            createCharts(data);
        }
    });

    var createCharts = function (data) {
        var day = new Date();
        var dayCount = new Date(day.getFullYear(), day.getMonth() + 1, 0).getDate();
        //console.log(dayCount);
        var weekdata = data.weekData;
        var monthdata = data.monthData;
        var monthlabels = [];
        var i;

        monthdata.splice(dayCount + 1, monthdata.length - dayCount);

        monthlabels.length = monthdata.length;
        for (i = 0; i < monthlabels.length; i++) {
            monthlabels[i] = i + 1;
        }

        for (i = 0; i < weekdata.length; i++) {
            weekdata[i] = parseInt(weekdata[i]);
        }

        for (i = 0; i < monthdata.length; i++) {
            monthdata[i] = parseInt(monthdata[i]);
        }

        var ctx = document.getElementById("weekChart");
        var weekChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Monday", "Tuesday", "Wednesday", "Tursday", "Friday", "Saturday", "Sunday"],
                datasets: [{
                    label: 'workload hours',
                    data: weekdata,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Current week workload" + "       Total hours:" + sum(weekdata),
                    fontSize: 20,
                    fontColor: '#000',
                    padding: 30
                },
                legend: { display: false },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return value + " h";
                            }
                        }
                    }]
                }
            }
        });

        ctx = document.getElementById("monthChart");
        var monthChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthlabels,
                datasets: [{
                    label: 'workload hours',
                    data: monthdata,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Current month workload" + "       Total hours:" + sum(monthdata),
                    fontSize: 20,
                    fontColor: '#000',
                    padding: 30
                },
                legend: { display: false },
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Day'
                        },
                        ticks: {
                            beginAtZero: true,
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return value + " h";
                            }
                        }
                    }]
                }
            }
        });

        $("#monthChart").hide();

    }

    function sum(arr) {
        var s = 0;
        for (var i = arr.length - 1; i >= 0; i--) {
            s += arr[i];
        }
        return s;
    }

    $('.form-select').change(function () {
        var value = $(this).val();
        if (value == 2) {
            $("#weekChart").hide();
            $("#monthChart").show();
        } else {
            $("#weekChart").show();
            $("#monthChart").hide();
        }
    });



})