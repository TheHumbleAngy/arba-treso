let choix = '';

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
    scrollFunction()
};

const scrollFunction = () => {
    if ($(document).scrollTop > 20 || document.documentElement.scrollTop > 20) {
        $('#goTop').css("display", "block");
    } else {
        $('#goTop').css("display", "none");
    }
};

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    $('html').animate({scrollTop: 0}, 'slow');
}

function separateurMilliers(nStr) {
    // To pass the value as a string
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    let rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ' ' + '$2');
    }

    return x1 + x2;
}

function fusionMilliers(str) {
    str = str.toString().replace(' ', '');
    str = str.includes(',') ? str.replace(',', '.') : str;

    return str;
}

const choixProceder = () => {
    const rdo = document.getElementsByName('rdoChoix');
    choix = 0;

    for (let i = 0; i < rdo.length; i++) {
        if (rdo[i].checked) {
            choix = parseInt(rdo[i].value);

            break;
        }
    }

    document.querySelector('#particulier_mbr').disabled = choix !== 2;
};

const choixCotisation = () => {
    const cbo = document.getElementById('param_annee');
    let response = document.getElementById('feedback');

    if (response.childNodes.length === 0 && cbo.value !== '') {
        $.ajax({
            type: 'POST',
            url: 'operations/ope_annee.php',
            success: function (data) {
                document.getElementById('enregistrer').disabled = false;
                response.innerHTML = data;
                load_noms_membres('autocompletion');
            }
        })
    }
};

const choixConsultation = () => {
    const cbo = document.getElementById('type_consultation');
    const links = ['index.php?page=operations/liste_cotisations', 'index.php?page=membres/liste_membres'];
    const button = document.getElementById('proceder_consultation');

    if (cbo.value !== '')
        button.setAttribute('href', links[cbo.value]);
};

const procederConsultation = () => {
    let param = '', annee = document.getElementById('param_annee').value,
        response = document.getElementById('feedback');

    choixProceder();

    if (!document.querySelector('#particulier_mbr').disabled)
        param = document.getElementById('particulier_mbr').value;

    $.ajax({
        type: 'POST',
        url: 'operations/resultat_consultation.php',
        data: {
            choix: choix,
            param: param,
            year: annee
        },
        success: function (data) {
            response.innerHTML = data;
        }
    })
};

const load_noms_membres = (usage) => {
    $.ajax({
        type: 'POST',
        url: 'membres/noms_membres.php',
        data: {
            usage: usage
        },
        success: function (data) {
            let input = $('[id^=coti_mbr]');

            for (let i = 0; i < input.length; i++) {
                let list_mbr = new Awesomplete(input[i]);
                list_mbr.list = JSON.parse(data);
            }
        }
    })
};

const addRow = (nbr) => {
    // We take in account the table body only
    const tab = document.getElementById('tab_cotisations').tBodies[0];
    let new_row, len, m, cel;

    const n = tab.rows.length - 1;
    for (let j = 0; j < nbr; j++) {
        new_row = tab.rows[n].cloneNode(true);
        len = tab.rows.length;
        new_row.cells[0].innerHTML = len;

        m = new_row.cells.length;
        for (let k = 1; k < m - 1; k++) {
            cel = new_row.cells[k].getElementsByTagName('input')[0];
            cel.id += len;
            cel.value = '';
            cel.removeAttribute('readonly');
        }

        tab.appendChild(new_row);
    }

    // To remove the add button at the end of each <tr> except the last one
    for (let j = 0; j < len; j++) {
        let node = tab.rows[j].cells[m - 1];
        if (node)
            node.parentNode.removeChild(node);
    }

    // To add a <td> to smooth things 😝
    for (let j = 0; j < len; j++) {
        let node = tab.rows[j].cells[m - 2];
        let td = document.createElement('td');
        // console.log(`len = ${len}`);
        // console.log(`tab.rows[${j}].cells[${m} - 1]`);
        node.parentNode.appendChild(td);
    }

    load_noms_membres('autocompletion');
};

const loadMembreData = (e) => {
    // Verifier que le champ n'est pas vide
    if (e.value) {
        let mbr = e.value.split(' ');
        let nom_mbr, pren_mbr, sql, date = new Date();
        let an = date.getFullYear();

        const mois = [];

        pren_mbr = '';

        for (let i = 0; i < mbr.length; i++) {
            if (i === 0)
                nom_mbr = `${mbr[i]}`;
            else if (pren_mbr[i])
                pren_mbr += ` ${mbr[i]}`;
            else
                pren_mbr += `${mbr[i]}`;
        }

        sql = `SELECT id_mois, montant_cotisation
            FROM operations o INNER JOIN membres m ON o.id_membre = m.id_membre
            WHERE m.nom_membre = '${nom_mbr}' AND m.pren_membre = '${pren_mbr}' AND annee_cotisation = '${an}' ORDER BY id_mois;`;

        //console.dir(`${sql}`);
        $.ajax({
            type: 'POST',
            data: {
                info: sql.trim()
            },
            url: 'operations/ajax_mbr_coti_mois.php',
            success: function (data) {
                if (data) {
                    const arr_coti = JSON.parse(data);
                    //console.log(arr_coti);

                    const tr = e.closest('tr'); //console.log(tr);
                    const tr_children_list = tr.childNodes; //console.log(tr_children_list);
                    let tr_td_input = [], j = 0;

                    for (let i = 5; i < tr_children_list.length; i += 2) {
                        tr_td_input[j] = tr_children_list[i].childNodes[1];

                        if (i === 29 || j === 11)
                            break;
                        j++;
                    }
                    //console.log(tr_td_input.length);
                    for (let elt of tr_td_input) {
                        //console.log(elt);
                        if (elt.getAttribute('readonly'))
                            elt.removeAttribute('readonly');
                        elt.value = '';
                    }

                    for (let i = 0; i < tr_td_input.length; i++) {
                        for (let j = 0; j < arr_coti.length; j++) {
                            // recuperation de l'id_mois et convertion en entier
                            let mois = arr_coti[j].id_mois.slice(1);
                            mois = parseInt(mois);

                            if (i === mois - 1) {
                                // On vide tous les champs de saisie sauf celui du nom du membre, et on les rends modifiables

                                tr_td_input[i].value = arr_coti[j].montant_cotisation;
                                tr_td_input[i].setAttribute('readonly', true);
                            }
                        }
                    }
                }
            }
        })
    }
};

const saveCotisations = () => {
    let annee = document.getElementById('param_annee');

    if (annee.value !== '') {
        const arr = document.getElementById('tab_cotisations').tBodies[0];
        let rows = arr.rows;
        let rows_nbr = rows.length;

        let nom_mbr = $('[id^=coti_mbr]');
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

        let info_mbr = [nom_mbr, jan, fev, mars, avr, mai, juin, juil, aout, sep, oct, nov, dec];
        let data = [];

        let m = 0;
        for (let i = 0; i < rows_nbr; i++) {// line by line
            // console.log(info_mbr[0][i - 1].attr('readonly'));
            if (info_mbr[0][i].value) {
                let row_cells = rows[i].cells;
                let row_cells_nbr = row_cells.length;
                let n = 0;
                data.push([]);

                // console.log(i);
                for (let j = 1; j < row_cells_nbr; j++) {// cell by cell
                    let info_mbr_nbr = info_mbr.length;
                    if (j <= info_mbr_nbr) {
                        let info = info_mbr[j - 1][i].value;
                        if (info) {
                            // console.log(`m=${m} n=${n} info=${info}`);
                            let input = info_mbr[j - 1][i];
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

        if (data.length) {
            // console.log(data);
            // Ajax
            $.ajax({
                type: 'POST',
                url: 'operations/ajax_save_cotisations.php',
                data: {
                    data: data,
                    year: annee.value
                },
                success: function (data) {
                    // console.log(JSON.parse(data));
                    callModal('successModal');
                    let response = document.getElementById('feedback');
                    while (response.firstChild) {
                        response.removeChild(response.firstChild);
                    }
                    console.log(data);
                    annee.selectedIndex = 0;
                    document.getElementById('enregistrer').disabled = true;
                }
            });
        }
    }
    else
        callModal('errorYear');
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

const saveMember = () => {
    let arr = document.getElementsByTagName('input');
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
            url: 'membres/ajax_save_membre.php',
            success: function (data) {
                if (data === 'Error')
                    callModal('errorModal');
                else {
                    console.log(`${data} has been successfully saved.`);
                    clearFields('input');
                    callModal('successModal');
                }
            }
        })
    } else {
        // Call modal
        callModal('errorModal');
    }
};

const clearRadios = (name) => {
    let grpRadios = document.getElementsByName(`${name}`);
    for (const rdo of grpRadios) {
        rdo.checked = false;
    }
    document.getElementById('enregistrer').disabled = true;
};

const callModal = (id) => {
    $('#' + id).modal('show');
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

const filterMembre = (usage) => {
    let info, mbr = document.getElementById('membre').value;

    info = mbr ? mbr : '';

    $.ajax({
        type: 'POST',
        data: {
            usage: usage,
            info: info
        },
        url: 'membres/noms_membres.php',
        success: function (data) {
            let arr = JSON.parse(data),
                n = arr.length, row;
            const tab = document.getElementById('liste_membres');

            // row = tab.rows[]
            // console.log(arr[0].length);

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
                let cell = tab.rows[i].cells[0];
                cell.classList.add('text-center');
                cell.classList.add('text-primary');
                cell.classList.add('font-weight-light');
            }
        }
    })
};

/* Load the necessary elements here */
$(document).ready(function () {
    if (document.getElementById('param_annee')) {
        cboYearLoader(2);
    }
    
    if (document.getElementById('type_consultation')) {
        document.getElementById('type_consultation').value = '';
    }
});