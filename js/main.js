$(document).ready(function () {
    load_list_membre();
});

let choix = '';

// let monnaie, id_banque, id_pays;

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


/*function selectionBanque(selector) {
    let banque,
        pays,
        id_monnaie,
        str = $(selector).attr('id');
    let arr = str.split("_");

    banque = arr[1];
    pays = arr[2];
    monnaie = arr[3];

    id_banque = arr[5];
    id_pays = arr[6];
    id_monnaie = arr[7];

    let text = banque + ' ' + pays + ' - ' + monnaie;
    $('.titre').html(text);

    $.ajax({
        type: 'POST',
        url: 'banques/ajax_banque_info.php',
        data: {
            banque: id_banque,
            pays: id_pays,
            monnaie: id_monnaie
        },
        success: function (result) {
            json_data = JSON.parse(result);
            let entite = json_data[0].entite,
                solde_xof = json_data[0].solde_xof,
                solde_devise = json_data[0].solde_devise,
                sign = "";

            switch (monnaie) {
                case "USD":
                    sign = '<i class="fas fa-dollar-sign text-uppercase"></i>';
                    break;
                case "EURO":
                    sign = '<i class="fas fa-euro-sign text-uppercase"></i>';
                    break;
                default:
                    sign = '<strong><span class="text-uppercase">' + monnaie + '</span></strong>';
            }

            $('#monnaie_devise').html(sign);
            $('#entite').html('#' + entite);
            $('#nature').prop('disabled', false);
            $('#nombre').prop('disabled', false);
            $('#saisir').prop('disabled', false);

            $('#solde_xof').attr('value', separateurMilliers(solde_xof.toFixed(2)));
            $('#solde_devise').attr('value', separateurMilliers(solde_devise.toFixed(2)));
            $('#idbanque').html(id_banque);
            $('#feedback').empty();

            valider.prop('disabled', true);
        }
    });
}

function afficherSaisieOperations() {

    let n = nombre.value,
        nature = nature_.value;
    // console.log(n + ' ' + nature);
    let feedback = $('#feedback');

    if (n !== '' && nature !== 'Sélectionner...') {
        $.ajax({
            type: 'POST',
            url: 'operations/ajax_saisie_ope.php',
            data: {
                nbr: n,
                nature: nature
            },
            success: function (resultat) {
                // feedback.empty();
                feedback.html(resultat);
                valider.prop('disabled', false);
            }
        })
    }
}

function ajoutBanque() {
    let libelle_banque = $('#libelle').val().trim(),
        pays_banque = $('#pays').val().trim(),
        entite_banque = $('#entite').val().trim(),
        monnaie_banque = $('#monnaie').val().trim(),
        info, action;

    if (libelle_banque === '' || pays_banque === '' || monnaie_banque === '' || entite_banque === '') {
        $('#modal-check').modal('show');
    }
    else {
        info = "libelle_banque=" + libelle_banque +
            "&pays_banque=" + pays_banque +
            "&entite_banque=" + entite_banque +
            "&monnaie_banque=" + monnaie_banque;
        action = "ajout_banque";

        $.ajax({
            type: 'POST',
            url: 'banques/update_data_banques.php?action=' + action,
            data: info,
            success: function (data) {
                $('#content-response').html(data);
                $('#form_banque').trigger('reset');
                $('#modal-response').modal('show');
            }
        });
    }
}

function ajoutOperation() {
    let compte_op = [],
        libelle_op = [],
        datesaisie_op = new Date(),
        date_op = [],
        designation_op = [],
        cours_op = [],
        devise_op = [],
        xof_op = [],
        statut = [],
        observation_op = [],
        nature = $("#nature").val(),
        nbr = $("#nbr_").text();

    // Initialisation de la date de saisie
    datesaisie_op = datesaisie_op.getFullYear() + "-" + (datesaisie_op.getMonth() + 1) + "-" + datesaisie_op.getDate();

    // Recuperation des infos pour chaque operation (ligne) saisie
    let i, k = 0,
        compte_,
        libelle_,
        date_,
        designation_,
        cours_,
        devise_,
        xof_,
        statut_,
        observation_;

    for (i = 0; i < nbr; i++) {
        compte_ = $('[id*="compte"]')[i].value.trim();
        libelle_ = $('[id*="libelle"]')[i].value.trim();
        date_ = $('[id*="date"]')[i].value.trim();
        designation_ = $('[id*="operation"]')[i].value.trim();
        cours_ = Number(fusionMilliers($('[id*="cours-"]')[i].value.trim()));
        devise_ = Number(fusionMilliers($('[id*="mtt_devise-"]')[i].value.trim()));
        xof_ = Number(fusionMilliers($('[id*="mtt_xof-"]')[i].value.trim()));
        statut_ = $('[id*="statut"]')[i].value;
        observation_ = $('[id*="observation"]')[i].value.trim();

        if (compte_ !== '' && libelle_ !== '' && designation_ !== '' && devise_ !== '' && cours_ !== '' && date_ !== '') {
            compte_op[k] = compte_;
            libelle_op[k] = libelle_;
            date_op[k] = date_;
            designation_op[k] = designation_;
            cours_op[k] = cours_;
            devise_op[k] = devise_;
            xof_op[k] = xof_;
            statut[k] = statut_;
            observation_op[k] = observation_;
            k++;
        }
    }

    if (k > 0) {
        let json_compte_op = JSON.stringify(compte_op),
            json_libelle_op = JSON.stringify(libelle_op),
            json_date_op = JSON.stringify(date_op),
            json_designation_op = JSON.stringify(designation_op),
            json_cours_op = JSON.stringify(cours_op),
            json_devise_op = JSON.stringify(devise_op),
            json_xof_op = JSON.stringify(xof_op),
            json_statut_op = JSON.stringify(statut),
            json_observation_op = JSON.stringify(observation_op),
            info = "nbr=" + k +
                "&id_banque=" + id_banque +
                "&id_type_operation=" + nature +
                "&compte_operation=" + json_compte_op +
                "&tag_operation=" + json_libelle_op +
                "&date_saisie_operation=" + datesaisie_op +
                "&date_operation=" + json_date_op +
                "&designation_operation=" + json_designation_op +
                "&cours_operation=" + json_cours_op +
                "&montant_operation=" + json_devise_op +
                "&montant_xof_operation=" + json_xof_op +
                "&statut_operation=" + json_statut_op +
                "&observation_operation=" + json_observation_op+
                "&monnaie=" + monnaie +
                "&pays=" + id_pays,
            action = "ajout_operation";
        $.ajax({
            type: 'POST',
            url: 'operations/update_data_operations.php?action=' + action,
            data: info,
            success: function (data) {
                console.log(data);
                $('#content-response').html(data);
                $('#feedback').empty();
                $('#modal-response').modal('show');
                valider.prop('disabled', true);
                //selectionBanque();
            }
        });
    }
}

function consultationOperation() {
    let debut = $('#debut').val(),
        fin = $('#fin').val(),
        entite = $('#entite').val();

    choix = $("[name='rdo_nature']:checked").val();

    if (debut === '' && fin === '') {
        debut = '2018-01-01';
        fin = '2018-12-31';
    }
    else if (debut === '' && fin !== '')
        debut = '2018-01-01';
    else if (debut !== '' && fin === '')
        fin = '2018-12-31';

    if (choix === undefined)
        choix = 'simple';

    console.log(debut + ' ' + fin + ' ' + choix);
    $.ajax({
        type: 'POST',
        url: 'operations/ajax_consult_ope.php',
        data: {
            debut: debut,
            fin: fin,
            entite: entite,
            choix: choix
        },
        success: function (data) {
            $('#feedback_consultation').html(data);
            let solde_avant = $('#solde_avt').val(),
                solde_apres = $('#solde_apr').val();

            solde_avant = (solde_avant === "") ? 0 : solde_avant;
            solde_apres = (solde_apres === "") ? 0 : solde_apres;

            $('#solde_avant').val(solde_avant);
            $('#solde_apres').val(solde_apres);
        }
    })
}

$('#proceder').click(function () {
    let param = $('#param_entite').val();

    if (param !== 'Sélectionner...') {
        $.ajax({
            type: 'POST',
            url: 'operations/form_consult_ope.php',
            data: {
                param: param
            },
            success: function (data) {
                $('#content').html(data);
            }
        })
    }
});

function majStatut(element) {
    let id_ = Object.values(element)[0].parentElement.id;
    let statut = element.value;
    let arr = id_.split('_');
    let id = arr[1];
    let action = 'maj_statut';
    let info = 'id=' + id + '&statut=' + statut;

    $.ajax({
        type: 'POST',
        url: 'operations/update_data_operations.php?action=' + action,
        data: info,
        success: function (data) {
            console.log(data);
        }
    });
}

function calculXof(element) {
    let arr = element.id.split('-');
    let i = arr[1];

    let sel_mtt_devise = '#mtt_devise-' + i,
        sel_cours = '#cours-' + i,
        sel_mtt_xof = '#mtt_xof-' + i;

    let devise = $(sel_mtt_devise).val(),
        cours = $(sel_cours).val();
    if (devise === '' || cours === '') {
        console.log('One of devise or cours value is empty');
    } else {
        $(sel_mtt_xof).val(devise * cours);
    }
}

function assignListeBanque() {
    let liste = $('#lst_banq').val();
    $('#select_liste_banques').val(liste);
}

function libelleCheck(element) {
    let libelle = element.value,
        info = 'libelle=' + libelle;
    // console.log(element);

    // Checks whether the libelle already exists
    $.ajax({
        type: 'POST',
        url: 'banques/update_data_banques.php',
        data: info,
        success: function (data) {
            // console.log(data);
            if (data !== '0') {
                $('#modal-check-libelle').modal('show');
                element.value = '';
                // element.focus();
            }
        }
    });
}
*/

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
    const rdo = document.getElementsByName('rdoChoix'),
        url = ['operations/ope_annee.php', 'operations/ope_semestre.php'];
    let choix = 0,
        response = document.getElementById('feedback');

    for (let i = 0; i < rdo.length; i++) {
        if (rdo[i].checked) {
            choix = parseInt(rdo[i].value);
            break;
        }
    }

    $.ajax({
        type: 'POST',
        url: url[choix],
        success: function (data) {
            response.innerHTML = data;
            load_list_membre();
        }
    })
};

const procederConsultation = () => {
    let param,
        response = document.getElementById('feedback');

    choixProceder();

    if (!document.querySelector('#particulier_mbr').disabled)
        param = document.getElementById('particulier_mbr').value;

    $.ajax({
        type: 'POST',
        url: 'operations/resultat_consultation.php',
        data: {
            choix: choix,
            param: param
        },
        success: function (data) {
            response.innerHTML = data;
        }
    })
};

const load_list_membre = () => {
    $.ajax({
        type: 'POST',
        url: 'operations/liste_membres.php',
        success: function (data) {
            // console.log(JSON.parse(data));

            let input = $('[id^=coti_mbr]');

            for (let i = 0; i < input.length; i++) {
                let list_mbr = new Awesomplete(input[i]);
                list_mbr.list = JSON.parse(data);
            }
        }
    })
};

const addRow = (nbr) => {
    const tab = document.getElementById('tab_cotisations');
    let new_row, len, m, cel;

    const n = tab.rows.length - 1;

    for (let j = 0; j < nbr; j++) {
        new_row = tab.rows[n].cloneNode(true);

        len = tab.rows.length;
        // console.log('len = ' + len);

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
    for (let j = 1; j < len; j++) {
        let node = tab.rows[j].cells[m - 1];
        if (node)
            node.parentNode.removeChild(node);
    }

    load_list_membre();
};

/*function deleteRow(row) {
    let i = row.parentNode.parentNode.rowIndex;
    document.getElementById('tab_cotisations').deleteRow(i);
}

function checkTableRows() {
    const tab = document.getElementById('tab_cotisations');

    len = tab.rows.length;
    console.log(len - 1);
}*/

const myFunction = (e) => {
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

                    for (let i = 5; i < tr_children_list.length; i+=2) {
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
                                /*console.log(`i = ${i}, j = ${j}`);
                                console.log(tr_td_input[i]);*/
                            }
                        }
                    }
                }
            }
        })
    }
};

const save_cotisations = () => {
    let choix = 0;
    const rdo = document.getElementsByName('rdoChoix');
    for (let i = 0; i < rdo.length; i++) {
        if (rdo[i].checked) {
            choix = parseInt(rdo[i].value);
            break;
        }
    }

    //console.log(choix);
    if (choix === 0) {
        // Cotisations annuelles
        const tab = document.getElementById('tab_cotisations');
        let n = tab.rows.length;
        let row = tab.rows;
        let row_td_info = [];

        for (let i = 1; i < n; i++) {
            const row_td = row[i].childNodes;
            let k = 0;

            //console.log(row_td);
            for (let j = 3; j < row_td.length; j+=2) {
                for (let l = 0; l < n; l++) {
                    row_td_info[l][k] = row_td[j].childNodes[1].value;
                }
                //row_td_info[k] = row_td[i].childNodes[1]
                if (j === 27)
                    break;
                k++;
            }
        }
        console.dir(row_td_info);

    } else {
        // Cotisations dernier semestre
        let info = [];
        let list_mbr = $('[id^=coti_mbr]'),
            list_coti = $('[id^=cotisation]');

        for (let i = 0; i < list_mbr.length; i++) {
            if (list_mbr[i].value && list_coti[i].value)
                info[i] = list_mbr[i].value + "_" + list_coti[i].value;
        }

        // console.dir(info);
        $.ajax({
            type: 'POST',
            data: {
                info: info
            },
            url: 'operations/enregistrement_cotisations.php',
            success: function (data) {
                // console.log(JSON.parse(data));
                console.log(data);
            }
        })
    }

};