$(function () {
    var weekdata = [12, 19, 3, 5, 2, 3, 6];
    var monthdata = [2, 3, 5, 7, 3, 6, 8, 12, 6, 7, 2, 3, 5, 7, 3, 6, 8, 5, 3, 9, 2, 3, 5, 7, 3, 6, 8, 6, 11, 2];
    var monthlabels = [];

    monthlabels.length = monthdata.length;
    for (var i = 0; i < monthlabels.length; i++) {
        monthlabels[i] = i + 1;
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

    $("#monthChart").hide();
})