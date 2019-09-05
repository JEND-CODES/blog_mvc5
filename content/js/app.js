// Requête AJAX pour Data visualisation des Likes par Chapitres

$(document).ready(function () {
    $.ajax({
        url: "http://localhost/blog_mvc4/blog/request.php",
        method: "GET",
        success: function (data) {
            console.log(data);
            var chapter = [];
            var score = [];

            for (var i in data) {
                chapter.push("Chapitre " + data[i].chapi);
                score.push(data[i].alarm);
            }

            var chartdata = {
                labels: chapter,
                datasets: [
                    {
                        label: 'Likes ',
                        backgroundColor: 'rgba(0, 47, 95, 0.65)',
                        borderColor: 'black',
                        borderWidth: 0,
                        hoverBackgroundColor: '#4db6ac',
                        hoverBorderColor: 'black',
                        data: score
          }
        ]
            };

            var ctx = $("#mycanvas");

            var barGraph = new Chart(ctx, {
                type: 'horizontalBar',
                data: chartdata,
                options: {
                    legend: {
                        display: false,
                    },

                    tooltips: {
                        backgroundColor: 'rgba(0, 47, 95, 1)',
                        xPadding: 10,
                        yPadding: 10,
                        cornerRadius: 6,
                        titleFontSize: 14,
                        titleMarginBottom: 5,
                        bodyFontSize: 16,

                        callbacks: {
                            //to hide tootips title
                            title: function () {},

                            label: function (tooltipItem, data) {
                                return "    Likes + " + tooltipItem.xLabel;
                            },
                        },
                        custom: function (tooltip) {
                            if (!tooltip) return;
                            // disable displaying the color square box;
                            tooltip.displayColors = false;
                        },

                    },
                },

            });
        },
        error: function (data) {
            console.log(data);
        }
    });
});
