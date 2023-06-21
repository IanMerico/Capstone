        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>
        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
        <!-- chart scripts -->  
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
        <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
        <script src="../js/Chart.min.js"></script>
        <script src="../js/jquery-1.9.1.js"></script>
        <script src="assets/js/jquery-3.5.1.js"></script>
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Include the DataTable CSS file -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <!-- Include the DataTable JavaScript file -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <!-- Replace "test" with your own sandbox Business account app client ID -->
        <script src="https://www.paypal.com/sdk/js?client-id=AZVVBSSlCFeDabXj8DqGAjR5JllR3K4k9OST6wIXRf1FdbNkzwWM9MS8UeWkMV2eWj0f5mLj7LcgqjrG&currency=PHP"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>
        <script>
            // Function to calculate the average age for a given array of ages
            function calculateAverageAge(ages) {
                var sum = 0;
                for (var i = 0; i < ages.length; i++) {
                    sum += ages[i];
                }
                return (sum / ages.length).toFixed(2);
            }
        </script>
        <script>
                var ctx = document.getElementById('sales-chart').getContext('2d');
                var salesChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                    labels: ['Total Sales'],
                    datasets: [{
                        label: 'Total Sales',
                        data: [<?= $total_sales ?>],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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
        </script>
        <script>
            var gender_data = <?php echo json_encode($gender_data); ?>;
            var ctx = document.getElementById('gender-chart').getContext('2d');
            var gender_chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: Object.keys(gender_data),
                    datasets: [{
                        data: Object.values(gender_data),
                        backgroundColor: [
                            'rgb(54, 162, 235)',
                            'rgb(255, 99, 132)',
                            'rgb(255,69,0)'
                        ]
                    }]
                }
            });
        </script>
        <script>
            var ctx = document.getElementById('chartjs_bar').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($product); ?>,
                    datasets: [{
                        backgroundColor: [
                            "#5969ff",
                            "#ff40907b",
                            "#25d5f2",
                            "#ffc750",
                            "#2ec551",
                            "#7040fa",
                            "#ff004e"
                        ],
                        data: <?php echo json_encode($sales); ?>,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function (value, index, values) {
                                    return '₱' + value;
                                }
                            }
                        }]
                    }
                }
            });
        </script>
        <script>
        // Initialize the chart and create a bar chart with the data
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo $json_data; ?>.map(function(item) { return item.product_name }),
                datasets: [{
                    label: 'Total Price',
                    data: <?php echo $json_data; ?>.map(function(item) { return item.total_price }),
                    backgroundColor: <?php echo $json_data; ?>.map(function() {
                        // Generate a random color for each data point
                        var r = Math.floor(Math.random() * 256);
                        var g = Math.floor(Math.random() * 256);
                        var b = Math.floor(Math.random() * 256);
                        return 'rgba(' + r + ', ' + g + ', ' + b + ', 0.2)';
                    }),
                    borderColor: <?php echo $json_data; ?>.map(function() {
                        // Generate a random color for each data point
                        var r = Math.floor(Math.random() * 256);
                        var g = Math.floor(Math.random() * 256);
                        var b = Math.floor(Math.random() * 256);
                        return 'rgba(' + r + ', ' + g + ', ' + b + ', 1)';
                    }),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        </script>
        <script>
        // create the Chart.js chart
                var salesData = <?php echo $salesDataJson; ?>;
                var salesChart = new Chart(document.getElementById("salesChart"), {
                    type: 'line',
                    data: {
                        labels: Object.keys(salesData),
                        datasets: [{
                            label: 'Sales',
                            data: Object.values(salesData),
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            xAxes: [{
                                type: 'time',
                                time: {
                                    unit: 'day',
                                    displayFormats: {
                                        day: 'MMM D'
                                    }
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
        </script>
        <script>
                $(document).ready(function() {
        $('td.status').each(function() {
            var status = $(this).text().toLowerCase();
            if (status === 'visible') {
            $(this).addClass('visible');
            } else if (status === 'hidden') {
            $(this).addClass('hidden');
            }
        });
        });
        </script>   
        <script>
            tinymce.init({
                selector: "#productsdescription",
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                height: 300,
                toolbar: 'undo redo | blocks |' + 'bold italic backcolor | alignleft aligncenter' + 'alignright alignjustify | bullist numlist outdent indent |' + 'removeformat | help', 
                contern_style: 'body { font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"; font-size:14px }'
            });
        </script>
        <script>
            $(function() {
                $('#print').click(function() {
                    var printContents = document.getElementById("out_print").innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                });
            });
        </script>
        <script>
            function previewImage(event) {
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('previewImage').src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            window.addEventListener('DOMContentLoaded', (event) => {
                document.getElementById('avatarInput').addEventListener('change', previewImage);
            });
        </script>
        <script>
            const avatarInput = document.getElementById('avatarInput');
            const previewImage = document.getElementById('previewImage');

            avatarInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                }

                reader.readAsDataURL(file);
            });
        </script>
        <script>
            const togglePassword = document.querySelector('#togglePassword');
            const passwordInput = document.querySelector('#password');

            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        </script>
        <script>
            var ctx = document.getElementById("correlationChart").getContext("2d");
            var chart = new Chart(ctx, {
                type: "scatter",
                data: {
                    labels: ' . json_encode($features) . ',
                    datasets: [{
                        label: "Correlation with Feedback",
                        data: ' . json_encode($correlationValues) . ',
                        backgroundColor: "rgba(75, 192, 192, 0.6)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        borderWidth: 1,
                        pointRadius: 5
                    }]
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: "Features"
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: "Correlation"
                            },
                            suggestedMin: -1,
                            suggestedMax: 1
                        }
                    }
                }
            });
        </script>
        <script>
        // Get the cluster sizes and centroids from PHP
            var clusterSizes = <?php echo json_encode($clusterSizes); ?>;
            var clusterCentroids = <?php echo json_encode($clusterCentroids); ?>;

            // Prepare data for the chart
            var clusterLabels = Object.keys(clusterSizes);
            var sizeData = Object.values(clusterSizes);
            var centroidData = Object.values(clusterCentroids);

            // Create the chart
            var ctx = document.getElementById('clusterChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'scatter',
                data: {
                    labels: clusterLabels,
                    datasets: [
                        {
                            label: 'Cluster Size',
                            data: sizeData,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)'
                        },
                        {
                            label: 'Centroid Value',
                            data: centroidData,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)'
                        }
                    ]
                },
                options: {
                    scales: {
                        x: {
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Cluster'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            precision: 0,
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                title: function (context) {
                                    return 'Cluster ' + context[0].dataIndex;
                                },
                                label: function (context) {
                                    var label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed.y;
                                    return label;
                                }
                            }
                        },
                        annotation: {
                            annotations: []
                        }
                    }
                }
            });
            // Add explanations for centroids and clusters
            var annotation = chart.options.plugins.annotation;
            for (var i = 0; i < clusterLabels.length; i++) {
                var centroid = centroidData[i];
                var clusterMean = computeMean(clusterLabels[i]); // Assuming you have a function to compute the mean

                annotation.annotations.push({
                    type: 'line',
                    mode: 'vertical',
                    scaleID: 'x',
                    value: centroid,
                    borderColor: 'black',
                    borderWidth: 1,
                    label: {
                        backgroundColor: 'rgba(0,0,0,0.6)',
                        color: 'white',
                        content: 'Centroid ' + (i + 1) + ' (' + centroid + ')',
                        enabled: true
                    }
                });

                annotation.annotations.push({
                    type: 'line',
                    mode: 'vertical',
                    scaleID: 'x',
                    value: clusterMean,
                    borderColor: 'black',
                    borderWidth: 1,
                    label: {
                        backgroundColor: 'rgba(0,0,0,0.6)',
                        color: 'white',
                        content: 'Cluster ' + (i + 1) + ' Mean (' + clusterMean + ')',
                        enabled: true
                    }
                });
            }
            // Update the chart with the new annotations
            chart.update();
            // Function to compute the mean for a cluster (replace with your implementation)
            function computeMean(clusterLabel) {
                // ... Compute the mean for the specified cluster
                return meanValue;
            }
        </script>


