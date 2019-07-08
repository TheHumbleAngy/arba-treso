<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 06-Jul-19
     * Time: 10:07 AM
     */
?>

<div class="bg-white col-xl-10 mx-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h2 class="w-50 text-center py-2 mx-auto mb-4 cadre-titre">Statistiques - Membres <span>👪</span></h2>

        <div class="col-12 mx-auto my-2 cadre p-4">
            <div class="row justify-content-center">
                <label for="genre" class="col-4">
                    <select class="custom-select custom-select" id="prop">
                        <option value="">Proprieté</option>
                        <option value="genre">Genre</option>
                        <option value="nom">Nom</option>
                        <option value="localite">Localité</option>
                    </select>
                    <small id="textHelp" class="form-text text-muted">
                        Sélectionnez
                    </small>
                </label>
                <div class="col offset-md-1">
                    <h4 class="col px-0">Graphique</h4>
                    <div class="row mx-0">
                        <div class="custom-control custom-radio custom-control-inline col">
                            <input type="radio" id="histo" name="graph" class="custom-control-input" onchange="setGraphLabelColor(this.name)">
                            <label class="custom-control-label" for="histo">Histogramme <i class="far fa-chart-bar"></i></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline col">
                            <input type="radio" id="secteurs" name="graph" class="custom-control-input" onchange="setGraphLabelColor(this.name)">
                            <label class="custom-control-label" for="secteurs">Secteurs <i class="fas fa-chart-pie"></i></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline col">
                            <input type="radio" id="barres" name="graph" class="custom-control-input" onchange="setGraphLabelColor(this.name)">
                            <label class="custom-control-label" for="barres">Barres <i class="fas fa-bars"></i></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2 justify-content-center">
                <div class="col-4 col-md-3 col-lg-2">
                    <button class="btn btn-primary col" onclick="displayGraph('membres')">
                        Actualiser <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <div id="feedback" class="my-4">
        <canvas id="myChart" height="100vh"></canvas>
    </div>

    <script>
        let myChart = document.getElementById('myChart').getContext('2d');
        let massPopChart = new Chart(myChart, {
            type: 'pie', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                // labels: labels,
                datasets: [{
                    label: 'Population',
                    data: [12, 19, 3, 5, 2, 3],
                    // data: dataValues,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    hoverBorderWidth: 3,
                    // hoverBorderColor: '#777'
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'My Title',
                    fontSize: 16
                }
            }
        })
    </script>
</div>