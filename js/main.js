'use strict';
let selectedLabel, unselectedLabel;

    /* Load the necessary elements here */
$(document).ready(function () {
    if (document.getElementById('param_annee')) {
        cboYearLoader(2);
    }

    if (document.getElementById('type_consultation')) {
        document.getElementById('type_consultation').value = '';
    }

    if (document.getElementById('proceder_param')) {
        document.getElementById('proceder_param').addEventListener('click', () => {
            if (document.getElementById('type_param').value === '')
                event.preventDefault();
        })
    }

    $('[data-toggle="tooltip"]').tooltip();
});

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
    if ($(document).scrollTop > 20 || document.documentElement.scrollTop > 20) {
        $('#goTop').css("display", "block");
    } else {
        $('#goTop').css("display", "none");
    }
};

function topFunction() {
    $('html').animate({scrollTop: 0}, 'slow');
}


/* Setters and loaders */

const setYearCotisation = () => {
    const cbo = document.getElementById('param_annee');
    let response = document.getElementById('feedback');

    if (cbo.value !== '') {
        $.ajax({
            type: 'POST',
            url: 'operations/entrees/cotisations/ajax/ajax_cotisations.php',
            success: function (data) {
                document.getElementById('enregistrer').disabled = false;
                response.innerHTML = data;
                membersNamesLoader('autocompletion');
            }
        })
    }
};

const setDateAdhesion = () => {
    const dateAdhe = document.getElementById('date_adhe');
    let response = document.getElementById('feedback');

    if (dateAdhe.value !== '') {
        $.ajax({
            type: 'POST',
            url: 'operations/entrees/adhesions/ajax/ajax_adhesions.php',
            success: function (data) {
                document.getElementById('enregistrer').disabled = false;
                response.innerHTML = data;
            }
        })
    }
};

const setParameter = (option) => { // 0: operations, 1: consultations
    const cbo = document.getElementById('type_param');
    const links = [
        ['index.php?page=operations/entrees/cotisations/form_cotisations', 'index.php?page=operations/sorties/...'],
        ['index.php?page=operations/entrees/cotisations/liste_cotisations', 'index.php?page=membres/liste_membres'],
        ['index.php?page=recherches/recherche_membres', 'index.php?page=recherches/recherche_operations'],
        ['index.php?page=stats/stats_cotisations', 'index.php?page=stats/stats_depenses', 'index.php?page=stats/stats_membres']
    ];
    const button = document.getElementById('proceder_param');

    if (cbo.value !== '')
        button.setAttribute('href', links[option][cbo.value]);
};

const setGender = (e) => {
    const tr = e.closest('tr'),
        gender = e.value;
    let n = tr.cells.length,
        mtt = tr.cells[n - 2].getElementsByTagName('input')[0];

    mtt.value = gender === 'M' ? 2000 : 1000;
};

const cboYearLoader = (nbr) => {
    let cbo = document.getElementById('param_annee');
    let n, elt;

    for (let i = 0; i < nbr; i++) {
        n = cbo.length - 1;
        elt = cbo.options[n].cloneNode(true);
        elt.value--;
        elt.text = elt.value;
        cbo.appendChild(elt);
    }
};

const membersNamesLoader = (usage) => {
    $.ajax({
        type: 'POST',
        url: 'membres/ajax/ajax_noms_membres.php',
        data: {
            usage: usage
        },
        success: function (data) {
            let input = $('[id^=coti_mbr]');

            for (let i = 0; i < input.length; i++) {
                let listMbr = new Awesomplete(input[i]);
                listMbr.list = JSON.parse(data);
            }
        }
    })
};

const memberDataLoader = (e) => {
    // check the emptiness of the field
    if (e.value) {
        let mbr = e.value.split(' ');
        let nomMbr,
            prenMbr = '',
            sql;
        let annee = document.getElementById('param_annee').value;

        const mois = [];

        for (let i = 0; i < mbr.length; i++) {
            if (i === 0)
                nomMbr = `${mbr[i]}`;
            else if (prenMbr[i])
                prenMbr += ` ${mbr[i]}`;
            else
                prenMbr += `${mbr[i]}`;
        }

        sql = `SELECT id_mois, montant_operation FROM operations o INNER JOIN membres m ON o.id_membre = m.id_membre WHERE m.nom_membre = '${nomMbr}' AND m.pren_membre = '${prenMbr}' AND annee_operation = '${annee}' ORDER BY id_mois;`;

        $.ajax({
            type: 'POST',
            data: {
                info: sql.trim()
            },
            url: 'operations/entrees/cotisations/ajax/ajax_mbr_coti_mois.php',
            success: function (data) {
                const tr = e.closest('tr'); //console.log(tr);
                const trChildrenList = tr.childNodes; //console.log(tr_children_list);
                let trTdInput = [], j = 0;

                for (let i = 5; i < trChildrenList.length; i += 2) {
                    trTdInput[j] = trChildrenList[i].childNodes[1];

                    if (i === 29 || j === 11)
                        break;
                    j++;
                }
                // console.log(tr_td_input.length);
                for (let elt of trTdInput) {
                    if (elt.getAttribute('readonly'))
                        elt.removeAttribute('readonly');
                    elt.value = '';
                }

                if (data) {
                    const arrCoti = JSON.parse(data);

                    for (let i = 0; i < trTdInput.length; i++) {

                        for (let j = 0; j < arrCoti.length; j++) {

                            // recuperation de l'id_mois et convertion en entier
                            let mois = arrCoti[j].id_mois.slice(1);
                            mois = parseInt(mois);

                            if (i === mois - 1) {
                                // On vide tous les champs de saisie sauf celui du nom du membre, et on les rends modifiables

                                trTdInput[i].value = arrCoti[j].montant_operation;
                                trTdInput[i].setAttribute('readonly', true);
                            }
                        }
                    }
                }
            }
        })
    }
};

const setGraphLabelColor = (rdoName) => {
    let elt, radios;

    radios = document.getElementsByName(rdoName);

    for (const radio of radios) {
        if (radio.checked) {
            elt = radio.nextSibling;

            while (elt) {
                if (elt.nodeName === 'LABEL') {
                    selectedLabel = elt;
                    break;
                }
                elt = elt.nextSibling;
            }
            if (selectedLabel)
                selectedLabel.classList.add('text-primary');
        } else {
            elt = radio.nextSibling;

            while (elt) {
                if (elt.nodeName === 'LABEL') {
                    unselectedLabel = elt;
                    break;
                }
                elt = elt.nextSibling;
            }
            if (unselectedLabel)
                unselectedLabel.classList.remove('text-primary');
        }
    }
};

const setCategorie = (cbo) => {
    let val = cbo.value;

    if (val) {
        // console.log(cbo.value);
        let select = document.getElementById('cate');
        let option = document.createElement('option');

        for (const childNode of select.childNodes) {
            if (childNode.nodeName === 'OPTION') {
                console.log(childNode.nodeName);
                console.log(childNode.innerHTML);

            }
        }
        /*let test = true;
        console.log(test);

        while (select.firstChild.nodeName === 'OPTION' && test) {
            if (select.firstChild.innerText !== 'Catégorie')
                select.removeChild(select.firstChild);
            else
                test = false;
        }
        console.log(test);

        if (cbo.value === '0') {
            option.value = 'CAT03';
            option.innerText = 'Festivité';
            select.appendChild(option);

        }
        else if (cbo.value === '1') {
            option.value = 'CAT01';
            option.innerText = 'Adhésion';
            select.appendChild(option);

            option.value = 'CAT02';
            option.innerText = 'Cotisation';
            select.appendChild(option);
        }*/
    }
};



/* Custom functions */

const procederConsultation = (fieldId) => {
    let param = '',
        annee = document.getElementById('param_annee').value,
        response = document.getElementById('feedback');

    if (!document.getElementById(fieldId).disabled)
        param = document.getElementById(fieldId).value;

    $.ajax({
        type: 'POST',
        url: 'consultations/ajax_resultat_consultation.php',
        data: {
            param: param,
            year: annee
        },
        success: function (data) {
            response.innerHTML = data;
        }
    })
};

const addRow = (tableId, rowNbr, option) => {
    // We take in account the table body only
    const tab = document.getElementById(tableId).tBodies[0];
    let newRow, len, m, input, select;

    const n = tab.rows.length - 1;
    for (let i = 0; i < rowNbr; i++) {
        newRow = tab.rows[n].cloneNode(true);
        len = tab.rows.length;
        newRow.cells[0].innerHTML = ++len;

        m = newRow.cells.length;
        for (let j = 1; j < m - 1; j++) {
            input = newRow.cells[j].getElementsByTagName('input')[0];
            if (input) {
                input.id += len;
                input.value = '';
                if (!option)
                    input.removeAttribute('readonly');
            }

            select = newRow.cells[j].getElementsByTagName('select')[0];
            if (select)
                select.id += len;
        }

        tab.appendChild(newRow);
    }

    // To remove the add button at the end of each <tr> except the last one
    for (let j = 0; j < len - 1; j++) {
        let node = tab.rows[j].cells[m - 1];
        if (node)
            node.parentNode.removeChild(node);
    }

    // To add a <td> to smooth things 😝
    for (let j = 0; j < len - 1; j++) {
        let node = tab.rows[j].cells[m - 2];
        let td = document.createElement('td');
        node.parentNode.appendChild(td);
    }

    if (!option)
        membersNamesLoader('autocompletion');
};

const fieldCheck = (field) => {
    return document.getElementById(field).value === '';
};

const clearFields = (tag) => {
    let elts = document.getElementsByTagName(tag);

    for (const elt of elts) {
        elt.value = '';
    }
};

const callModal = (id, msg) => {
    if (msg)
        document.getElementById(id).getElementsByTagName('p')[0].textContent = msg;
    $('#' + id).modal('show');
};


/* Savers */

const saveCotisations = () => {
    let annee = document.getElementById('param_annee');

    if (annee.value !== '') {
        const arr = document.getElementById('arr_cotisations').tBodies[0];
        let rows = arr.rows;
        let rowsNbr = rows.length;

        let nomMbr = $('[id^=coti_mbr]');
        let jan = $('[id^=jan]');
        let fev = $('[id^=fev]');
        let mars = $('[id^=mars]');
        let avr = $('[id^=avr]');
        let mai = $('[id^=mai]');
        let juin = $('[id^=juin]');
        let juil = $('[id^=juil]');
        let aout = $('[id^=aout]');
        let sep = $('[id^=sep]');
        let oct = $('[id^=oct]');
        let nov = $('[id^=nov]');
        let dec = $('[id^=dec]');

        let infoMbr = [nomMbr, jan, fev, mars, avr, mai, juin, juil, aout, sep, oct, nov, dec];
        let data = [];

        let m = 0;
        for (let i = 0; i < rowsNbr; i++) {

            if (infoMbr[0][i].value) {
                let rowCells = rows[i].cells;
                let rowCellsNbr = rowCells.length;
                let n = 0;
                data.push([]);

                for (let j = 1; j < rowCellsNbr; j++) {

                    let infoMbrNbr = infoMbr.length;
                    if (j <= infoMbrNbr) {

                        let info = infoMbr[j - 1][i].value;
                        if (info) {

                            let input = infoMbr[j - 1][i];
                            if (n === 0)
                                data[m][n++] = info;
                            else {
                                if (!input.readOnly) {
                                    data[m][n++] = j - 1 + '-' + info;
                                }
                            }
                        }
                    }
                }
                m++;
            }
        }

        let dateOpe = document.getElementById('date_ope').value;
        if (data.length && dateOpe && data[0].length > 1) { // DONE: le cas des noms renseignés mais pas les montants est pris en compte ici
            $.ajax({
                type: 'POST',
                url: 'operations/entrees/cotisations/ajax/ajax_save_cotisations.php',
                data: {
                    data: data,
                    date_ope: dateOpe,
                    year: annee.value
                },
                success: function (data) {
                    // console.log(JSON.parse(data));
                    // callModal('successModal');
                    if (data === 'Data saved!') {
                        callModal('successModal');

                        let response = document.getElementById('feedback');
                        response.innerHTML = '';

                        console.log(data);
                        annee.selectedIndex = 0;
                        dateOpe = '';
                        document.getElementById('enregistrer').disabled = true;
                    } else
                        callModal('errorModal', data);

                }
            });
        }
    }
    else
        callModal('errorModal', "Veuillez sélectionner l'année SVP.");
};

const saveAdhesions = () => {
    let date = document.getElementById('date_adhe');

    if (date.value !== '') {
        const arr = document.getElementById('arr_adhesions').tBodies[0];
        let rows = arr.rows;
        let rowsNbr = rows.length;

        let nom = $('[id^=nom]');
        let pren = $('[id^=pren]');
        let gender = $('[id^=genre]');
        let loc = $('[id^=loc]');
        let contact = $('[id^=contact]');
        let mtt = $('[id^=mtt]');

        let infoMbr = [nom, pren,loc, contact, gender, mtt];
        let data = [];

        let m = 0;
        for (let i = 0; i < rowsNbr; i++) {
            let rowCells = rows[i].cells;
            let rowCellsNbr = rowCells.length;

            if (infoMbr[0][i].value) {

                let n = 0;
                data.push([]);

                for (let j = 1; j < rowCellsNbr; j++) {

                    let infoMbrNbr = infoMbr.length;
                    // console.log(infoMbrNbr);
                    if (j <= infoMbrNbr) {

                        let info = infoMbr[j - 1][i].value;
                        if (info) {
                            data[m][n++] = info;
                        }
                    }
                }
                m++;
            }
        }

        // console.table(data);
        if (data.length && data[0].length > 1) {
            $.ajax({
                type: 'POST',
                url: 'operations/entrees/adhesions/ajax/ajax_save_adhesions.php',
                data: {
                    arr: data,
                    dateAdhe: date.value
                },
                success: function (data) {
                    console.log('Done...');
                    console.log((data));

                    if (data === 'Data saved') {
                        callModal('successModal', 'La liste des adhérents a bien été enregistrée 👍');
                        date.value = '';
                        document.getElementById('feedback').innerHTML = '';
                        document.getElementById('enregistrer').disabled = true;
                    }
                    else
                        callModal('errorModal', data);
                }
            })
        }
    } else
        callModal('errorModal');
};

const saveMember = () => {
    let arr = document.getElementsByTagName('input');
    let myForm = document.getElementById('form_membre');
    let test = true;

    for (const elt of arr) {
        if (elt.required) {
            if (fieldCheck(elt.id)) {
                test = false;
                break;
            }
        }
    }

    if (test) {
        // Save info
        let nom = arr[0].value.trim();
        let prenoms = arr[1].value.trim();
        let adresse = arr[2].value.trim();
        let contact = arr[3].value.trim();

        $.ajax({
            type: 'POST',
            data: {
                name: nom,
                pname: prenoms,
                addr: adresse,
                contact: contact
            },
            url: 'membres/ajax/ajax_save_membre.php',
            success: function (data) {
                if (data === 'Error')
                    callModal('errorModal');
                else {
                    console.log(`${data} has been successfully saved.`);
                    clearFields('input');
                    callModal('successModal');
                    myForm.reset();
                }
            }
        })
    } else {
        // Call modal
        callModal('errorModal');
    }
};


/* Searchers */

const filterMember = (usage) => {
    let info, mbr = document.getElementById('membre').value;

    info = mbr ? mbr : '';

    $.ajax({
        type: 'POST',
        data: {
            usage: usage,
            info: info
        },
        url: 'membres/ajax/ajax_noms_membres.php',
        success: function (data) {
            let arr = JSON.parse(data),
                n = arr.length, row;
            const tab = document.getElementById('liste_membres');
            // console.log(arr);

            while (tab.firstChild)
                tab.removeChild(tab.firstChild);

            for (let i = 0; i < n; i++) {
                row = tab.insertRow(-1);

                let m = arr[i].length;
                for (let j = 0; j < m; j++) {

                    let newCell = row.insertCell(-1);

                    let elt = '';
                    let info = '';

                    if (j === 0) {
                        elt = i + 1;
                    } else if (arr[i][j] !== null) {
                        elt = arr[i][j];
                    }

                    info = document.createTextNode(elt);
                    newCell.appendChild(info);
                }
            }

            for (let i = 0; i < tab.rows.length; i++) {

                // Styling the row
                let tr = tab.rows[i];
                tr.classList.add('row', 'mx-0');

                // Styling the first cell of each line
                let cell = tab.rows[i].cells[0];
                cell.classList.add('col-1');
                cell.classList.add('text-center', 'text-primary', 'font-weight-light');

                // Styling the 2nd cell of each line
                cell = tab.rows[i].cells[1];
                cell.classList.add('col-4');

                // Styling the 3rd cell of each line
                cell = tab.rows[i].cells[2];
                cell.classList.add('col-2');

                // Styling the 4th cell of each line
                cell = tab.rows[i].cells[3];
                cell.classList.add('col-2');

                // Styling the 5th cell of each line
                cell = tab.rows[i].cells[4];
                cell.classList.add('col-1', 'text-primary', 'font-weight-bold');

                // Styling the 6th cell of each line
                cell = tab.rows[i].cells[tab.rows[i].cells.length - 1];
                cell.classList.add('col-2');

            }
        }
    })
};

const searchMember = (type) => {

    if (type === 'recherche') {
        let nom, prenoms, genre, localite, sql;
        let response = document.getElementById('feedback');

        nom = document.getElementById('nom').value;
        prenoms = document.getElementById('prenoms').value;
        genre = document.getElementById('genre').value;
        localite = document.getElementById('localite').value;

        sql = "SELECT * FROM membres WHERE ";

        /* Searching name */
        if (nom)
            sql += `nom_membre = '${nom}'`;

        /* Searching prenoms */
        if (nom && prenoms)
            sql += ` AND pren_membre = '${prenoms}'`;
        else if (prenoms)
            sql += `pren_membre = '${prenoms}'`;

        /* Searching gender */
        if ((nom && genre) || (prenoms && genre))
            sql += ` AND genre_membre = '${genre}'`;
        else if (genre)
            sql += `genre_membre = '${genre}'`;

        /* Searching address */
        if ((nom && localite) || (prenoms && localite) || (genre && localite))
            sql += ` AND adresse_membre LIKE '%${localite}%'`;
        else if (localite)
            sql += `adresse_membre LIKE '%${localite}%'`;

        if (sql !== "SELECT * FROM membres WHERE ") {
            $.ajax({
                type: 'POST',
                data: {
                    info: sql.trim()
                },
                url: 'recherches/ajax/ajax_search_membres.php',
                success: function (data) {
                    response.innerHTML = data;
                }
            })
        }
    }
};


/* Stats */

const canvasCreator = (id, height, parentId) => {
    let nested = document.getElementById(id);
    let top = document.getElementById(parentId);
    if (nested)
        top.removeChild(nested);

    let canvas = document.createElement('canvas');
    canvas.id = id;
    canvas.style.height = height;

    top.appendChild(canvas);
};

const chartDrawer = (chart, type, title, labels, label, dataValues) => {
    let myChart = document.getElementById(chart).getContext('2d');

    return new Chart(myChart, {
        type: type, // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data: {
            labels: labels,
            datasets: [{
                label: label,
                data: dataValues,
                backgroundColor: [
                    'rgba(230, 25, 75, 0.2)',
                    'rgba(0, 130, 200, 0.2)',
                    'rgba(255, 225, 25, 0.2)',
                    'rgba(60, 180, 75, 0.2)',
                    'rgba(245, 130, 48, 0.2)',
                    'rgba(145, 30, 180, 0.2)',
                    'rgba(70, 240, 240, 0.2)',
                    'rgba(240, 50, 230, 0.2)',
                    'rgba(210, 245, 60, 0.2)',
                    'rgba(0, 128, 128, 0.2)',
                    'rgba(170, 110, 40, 0.2)',
                    'rgba(128, 128, 0, 0.2)'
                ],
                borderColor: [
                    'rgba(230, 25, 75, 1)',
                    'rgba(0, 130, 200, 1)',
                    'rgba(255, 225, 25, 1)',
                    'rgba(60, 180, 75, 1)',
                    'rgba(245, 130, 48, 1)',
                    'rgba(145, 30, 180, 1)',
                    'rgba(70, 240, 240, 1)',
                    'rgba(240, 50, 230, 1)',
                    'rgba(210, 245, 60, 1)',
                    'rgba(0, 128, 128, 1)',
                    'rgba(170, 110, 40, 1)',
                    'rgba(128, 128, 0, 1)'
                ],
                borderWidth: 1,
                hoverBorderWidth: 3,
            }]
        },
        options: {
            title: {
                display: true,
                text: title,
                fontSize: 18
            }
        }
    })
};

const displayGraph = (entity) => {
    let prop, graphType, labels, label, title, dataValues;

    prop = document.getElementById('prop').value;
    labels = [];
    dataValues = [];

    if (prop && selectedLabel) {
        canvasCreator('myChart', '50vh', 'feedback');

        graphType = selectedLabel.textContent.trim();

        switch (prop) {
            case 'localite':
                $.ajax({
                    url: 'stats/ajax/ajax_data_membres.php?entity=' + entity + '&prop=' + prop,
                    type: 'GET',
                    async: false,
                    success: function (arr) {
                        let data = JSON.parse(arr);
                        labels = data[0];
                        dataValues = data[1];
                        prop = 'localité';
                    }
                });
                break;

            default:
                $.ajax({
                    url: 'stats/ajax/ajax_data_membres.php?entity=' + entity + '&prop=' + prop,
                    type: 'GET',
                    async: false,
                    success: function (arr) {
                        let data = JSON.parse(arr);
                        labels = data[0];
                        dataValues = data[1];
                    }
                });
                break;
        }

        switch (graphType) {
            case 'Histogramme':
                graphType = 'bar';
                break;
            case 'Barres':
                graphType = 'horizontalBar';
                break;
            default:
                graphType = 'pie';
                break;
        }

        title = prop.substr(0, 1).toUpperCase() + prop.substr(1);
        label = entity.substr(0, 1).toUpperCase() + entity.substr(1).toLowerCase();

        chartDrawer('myChart', graphType, title, labels, label, dataValues);
    }
};