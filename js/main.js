$(document).ready(function () {
    load_list_membre();
});

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

    if (choix === 0) {
        const arr = document.getElementById('tab_cotisations');
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
        let data =[];

        let m = 0;
        for (let i = 1; i < rows_nbr; i++) {
            // line by line

            // console.log(info_mbr[0][i - 1].attr('readonly'));
            if (info_mbr[0][i - 1].value) {
                let row_cells = rows[i].cells;
                let row_cells_nbr = row_cells.length;
                let n = 0;
                data.push([]);

                // console.log(i);
                for (let j = 1; j < row_cells_nbr; j++) {
                    // cell by cell

                    let info_mbr_nbr = info_mbr.length;
                    if (j <= info_mbr_nbr) {
                        let info = info_mbr[j-1][i-1].value;
                        if (info) {
                            // console.log(`m=${m} n=${n} info=${info}`);
                            let input = info_mbr[j-1][i-1];
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
        console.dir(data);
    }

    //console.log(choix);
    if (choix === 2) {
        // Cotisations annuelles
        const arr = document.getElementById('tab_cotisations');
        let rows = arr.rows;
        let rows_nbr = rows.length;
        let row_cell_info = [];
        // let tab = [];

        /*console.log(arr);
        console.log(rows);
        console.log(rows_nbr);*/

        let k = 0;
        // console.table(tab);
        for (let i = 1; i < rows_nbr; i++) {
            console.log(i);
            row_cell_info.push([]);

                let row_cells = rows[i].cells;
                let row_cells_nbr = row_cells.length;

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

                if (nom_mbr[i-1] && nom_mbr[i-1].value) {

                    let l = 0;
                    let coti_mois = [];
                    for (let j = 2; j < row_cells_nbr; j++) {
                        // coti_mois[l] =
                    }

                    /*console.log("k = " + k + " l = " + l);
                    row_cell_info[k][l++] = nom_mbr[i-1].value;
                    if (jan[i-1].value) {
                        console.log("jan");
                        row_cell_info[k][l] = jan[i-1].value;

                    }
                    if (fev[i-1].value) {
                        console.log("fev");
                        row_cell_info[k][l] = jan[i-1].value;

                    }
                    if (mars[i-1].value) {
                        console.log("mars");
                        row_cell_info[k][l] = jan[i-1].value;

                    }
                    if (avr[i-1].value) {
                        console.log("avr");
                        row_cell_info[k][l] = jan[i-1].value;

                    }
                    if (mai[i-1].value) {
                        console.log("mai");
                        row_cell_info[k][l] = jan[i-1].value;

                    }
                    if (juin[i-1].value) {
                        console.log("juin");
                        row_cell_info[k][l] = jan[i-1].value;

                    }
                    if (juil[i-1].value) {
                        console.log("juil");
                        row_cell_info[k][l] = jan[i-1].value;

                    }
                    if (aout[i-1].value) {
                        console.log("aout");
                        row_cell_info[k][l] = jan[i-1].value;

                    }

                    console.log("l = " + l++);*/

                    for (let j = 1; j < row_cells_nbr; j++) {
                        //console.log(row_cells[j]);
                        console.log(`[${i-1}, ${l}]`);
                        console.log(`j = ${j}`);

                        let test = false;

                        if (j === 1) {
                            console.log(`j = ${j}`);
                            console.log(`nom_mbr[${i-1}].value = ${nom_mbr[i-1].value}`);
                            row_cell_info[i-1].push(nom_mbr[i-1].value);
                            //console.log(`row_cell_info[${i-1}][${l}] = nom_mbr[${i-1}].value`);
                            test = true;

                            continue;
                        }

                        console.log(`l = ${l}`);

                        if (jan[i-1].value && !test && l === 1) {
                            console.log(`j = ${j}`);
                            console.log(`jan = ${jan[i-1].value}`);
                            row_cell_info[i-1].push(`01-${jan[i-1].value}`);
                            test = true;

                            continue;
                        }
                        if (fev[i-1].value && !test && l === 2) {
                            console.log(`j = ${j}`);
                            console.log(`fev = ${fev[i-1].value}`);
                            row_cell_info[i-1].push(`02-${fev[i-1].value}`);
                            test = true;

                            continue;
                        }
                        if (mars[i-1].value && !test && l === 3) {
                            console.log(`j = ${j}`);
                            console.log(`mars = ${mars[i-1].value}`);
                            row_cell_info[i-1].push(`03-${mars[i-1].value}`);
                            test = true;

                            continue;
                        }
                        if (avr[i-1].value && !test && l === 4) {
                            console.log(`j = ${j}`);
                            console.log(`avr = ${avr[i-1].value}`);
                            row_cell_info[i-1].push(`04-${avr[i-1].value}`);
                            test = true;

                            continue;
                        }
                        if (mai[i-1].value && !test && l === 5) {
                            console.log(`j = ${j}`);
                            console.log(`mai = ${mai[i-1].value}`);
                            row_cell_info[i-1].push(`05-${mai[i-1].value}`);
                            test = true;

                            continue;
                        }
                        if (juin[i-1].value && !test && l === 6) {
                            console.log(`juin = ${juin[i-1].value}`);
                            row_cell_info[i-1].push(`06-${juin[i-1].value}`);
                            test = true;

                            continue;
                        }
                        if (juil[i-1].value && !test && l === 7) {
                            console.log(`juil = ${juil[i-1].value}`);
                            row_cell_info[i-1].push(`07-${juil[i-1].value}`);
                            test = true;

                            continue;
                        }
                        if (aout[i-1].value && !test && l === 8) {
                            console.log(`aout = ${aout[i-1].value}`);
                            row_cell_info[i-1].push(`08-${aout[i-1].value}`);
                            test = true;

                            continue;
                        }
                        if (sep[i-1].value && !test && l === 9) {
                            console.log(`sep = ${sep[i-1].value}`);
                            row_cell_info[i-1].push(`09-${sep[i-1]}`);
                            test = true;

                            continue;
                        }
                        if (oct[i-1].value && !test && l === 10) {
                            console.log(`oct = ${oct[i-1].value}`);
                            row_cell_info[i-1].push(`10-${oct[i-1].value}`);
                            test = true;

                            continue;
                        }
                        if (nov[i-1].value && !test && l === 11) {
                            console.log(`nov = ${nov[i-1].value}`);
                            row_cell_info[i-1].push(`11-${nov[i-1].value}`);
                            test = true;

                            continue;
                        }
                        if (dec[i-1].value && !test && l === 12) {
                            console.log(`dec = ${dec[i-1].value}`);
                            row_cell_info[i-1].push(`12-${dec[i-1].value}`);
                            test = true;

                            //continue;
                        }

                        if (test) l++;

                        /*if (jan[i-1].value) {
                            console.log("jan");
                            row_cell_info[k][l] = jan[i-1].value;
                        }
                        if (fev[i-1].value) {
                            console.log("fev");
                            row_cell_info[k][l] = jan[i-1].value;

                        }
                        if (mars[i-1].value) {
                            console.log("mars");
                            row_cell_info[k][l] = jan[i-1].value;

                        }
                        if (avr[i-1].value) {
                            console.log("avr");
                            row_cell_info[k][l] = jan[i-1].value;

                        }
                        if (mai[i-1].value) {
                            console.log("mai");
                            row_cell_info[k][l] = jan[i-1].value;

                        }
                        if (juin[i-1].value) {
                            console.log("juin");
                            row_cell_info[k][l] = jan[i-1].value;

                        }
                        if (juil[i-1].value) {
                            console.log("juil");
                            row_cell_info[k][l] = jan[i-1].value;

                        }
                        if (aout[i-1].value) {
                            console.log("aout");
                            row_cell_info[k][l] = jan[i-1].value;

                        }*/

                        // console.log(`k = ${k}, l = ${l}, [${k}, ${l++}]`);
                        // console.log(`[${k}, ${l++}]`);
                    }
                    // console.log(row_cell_info);
                    /*for (let j = 0; j < row_cells.length; j++) {
                        console.log(row_cells[j]);
                        // console.log(row_cell[j]);
                    }*/
                //}
                    console.log("k = " + k++);
            }
            //i++;
        }
        console.log(row_cell_info);
    }
    else if (choix === 1) {
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

const enregistrer = () => {
    alert("Function `enregistrer` called");
};