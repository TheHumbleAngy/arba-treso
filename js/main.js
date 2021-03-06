"use strict";

// Global variables
var selectedLabel, unselectedLabel, state;

function setPageTitle(title) {
    let children = document.getElementsByTagName('head')[0].children;
    for (let child of children) {
        if (child.nodeName === 'TITLE') {
            child.text += ` - ${title.charAt(0).toUpperCase() + title.slice(1)}`;

            return child.text;
        }
    }
}

/* Load the necessary elements here */
$(document).ready(function () {
    /* Centering the element on the page */
    const nav = document.getElementById('myNav');
    let content = document.getElementById('content');
    let navHeight = window.getComputedStyle(nav).getPropertyValue('height');
    if (content)
        content.style.height = `calc(90vh - ${navHeight})`;
    /* End centering */

    let pageTitle = document.getElementById('head_title').value;
    if (pageTitle)
        setPageTitle(pageTitle);

    let paramAnnee = document.getElementById('param_annee');
    if (paramAnnee) {
        cboYearListLoader(paramAnnee, 2);
    }

    let annee = document.getElementById('annee');
    if (annee) {
        cboYearListLoader(annee, 4);
    }

    let cagnotteAnnee = document.getElementById('cagnotte_annee');
    if (cagnotteAnnee) {
        cboYearListLoader(cagnotteAnnee, 2);
    }

    let mois = document.getElementById('mois');
    if (mois) {
        let elt, cbo;

        cbo = mois;

        elt = cbo.options[cbo.length - 1].cloneNode(true);
        elt.value = 'M02';
        elt.text = 'Février';
        cbo.appendChild(elt);

        elt = cbo.options[cbo.length - 1].cloneNode(true);
        elt.value = 'M03';
        elt.text = 'Mars';
        cbo.appendChild(elt);

        elt = cbo.options[cbo.length - 1].cloneNode(true);
        elt.value = 'M04';
        elt.text = 'Avril';
        cbo.appendChild(elt);

        elt = cbo.options[cbo.length - 1].cloneNode(true);
        elt.value = 'M05';
        elt.text = 'Mai';
        cbo.appendChild(elt);

        elt = cbo.options[cbo.length - 1].cloneNode(true);
        elt.value = 'M06';
        elt.text = 'Juin';
        cbo.appendChild(elt);

        elt = cbo.options[cbo.length - 1].cloneNode(true);
        elt.value = 'M07';
        elt.text = 'Juillet';
        cbo.appendChild(elt);

        elt = cbo.options[cbo.length - 1].cloneNode(true);
        elt.value = 'M08';
        elt.text = 'Août';
        cbo.appendChild(elt);

        elt = cbo.options[cbo.length - 1].cloneNode(true);
        elt.value = 'M09';
        elt.text = 'Septembre';
        cbo.appendChild(elt);

        elt = cbo.options[cbo.length - 1].cloneNode(true);
        elt.value = 'M10';
        elt.text = 'Octobre';
        cbo.appendChild(elt);

        elt = cbo.options[cbo.length - 1].cloneNode(true);
        elt.value = 'M11';
        elt.text = 'Novembre';
        cbo.appendChild(elt);

        elt = cbo.options[cbo.length - 1].cloneNode(true);
        elt.value = 'M12';
        elt.text = 'Décembre';
        cbo.appendChild(elt);
    }

    let typeConsultation = document.getElementById('type_consultation');
    if (typeConsultation) {
        typeConsultation.value = '';
    }

    let procederParam = document.getElementById('proceder_param');
    if (procederParam) {
        procederParam.addEventListener('click', () => {
            if (document.getElementById('type_param').value === '')
                event.preventDefault();
        })
    }

    let commune = document.getElementById('commune');
    if (commune) {
        namesLoader('autocompletion', 'commune', 'communes');
    }

    let ville = document.getElementById('ville');
    if (ville) {
        namesLoader('autocompletion', 'ville', 'villes');
    }

    let nomDest = document.getElementById('nom_dest');
    if (nomDest) {
        namesLoader('autocompletion', 'nom_dest', 'membres', 1, 0);
    }

    let prenDest = document.getElementById('pren_dest');
    if (prenDest) {
        namesLoader('autocompletion', 'pren_dest', 'membres', 1, 1);
    }

    let nomDon = document.getElementById('nom_don');
    if (nomDon) {
        namesLoader('autocompletion', 'nom_don', 'membres', 1, 0);
    }

    let prenDon = document.getElementById('pren_don');
    if (prenDon) {
        namesLoader('autocompletion', 'pren_don', 'membres', 1, 1);
    }

    let mbrInter = document.getElementById('mbr_inter');
    if (mbrInter) {
        namesLoader('autocompletion', 'mbr_inter', 'membres');
    }

    $(document).ajaxStart(function () {
        $('.spinner-grow').css('display', 'block');
    });

    $(document).ajaxComplete(function () {
        $('.spinner-grow').css('display', 'none');
    });

    /*let widget = document.getElementById('widget_solde');
    if (widget) {
        widget.addEventListener('click', function () {
            if (widget.classList.contains('animated'))
                widget.classList.remove('animated');
            else
                widget.classList.add('animated');
        })
    }*/

    $('[data-toggle="tooltip"]').tooltip();
});

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
    if ($(document).scrollTop > 20 || document.documentElement.scrollTop > 20)
        $('#goTop').css("display", "block");
    else
        $('#goTop').css("display", "none");

    if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10)
        document.getElementById('myNav').classList.add('shadow');
    else
        document.getElementById('myNav').classList.remove('shadow');
};

function getToTop() {
    $('html').animate({scrollTop: 0}, 'slow');
}

/* Setters and loaders */

function setDateCotisations() {
    const cbo = document.getElementById('param_annee');
    const dateOpe = document.getElementById('date_ope');
    let response = document.getElementById('feedback');

    if (dateOpe.value !== '') {
        document.getElementById('enregistrer').disabled = false;
        document.getElementById('message').innerText = "Saisie des cotisations au " + moment(dateOpe.value).format('dddd Do MMMM YYYY') + ", pour l'exercice " + cbo.value;
        if (response.innerHTML === '') {
            $.ajax({
                type: 'POST',
                url: 'operations/encaissement/cotisations/ajax/ajax_cotisations.php',
                success: function (data) {
                    document.getElementById('enregistrer').classList.add('animated-hover');
                    response.innerHTML = data;
                    namesLoader('autocompletion', 'coti_mbr', 'membres');
                }
            })
        }
    }
    else {
        document.getElementById('enregistrer').disabled = true;
        // response.innerHTML = '';
    }
}

function setDateAdhesion() {
    const dateAdhe = document.getElementById('date_adhe');
    let response = document.getElementById('feedback');

    if (dateAdhe.value !== '') {
        document.getElementById('enregistrer').disabled = false;
        document.getElementById('message').innerText = "Saisie des adhésions au " + moment(dateAdhe.value).format('dddd Do MMMM YYYY') + ".";
        if (response.innerHTML === '') {
            $.ajax({
                type: 'POST',
                url: 'operations/encaissement/adhesions/ajax/ajax_adhesions.php',
                success: function (data) {
                    response.innerHTML = data;

                    const selectCom = document.getElementById('com');
                    const selectVil = document.getElementById('vil');
                    if (selectCom && selectVil) {
                        $.ajax({
                            type: 'GET',
                            url: 'operations/encaissement/adhesions/ajax/liste_communes_villes.php',
                            success: function (data) {
                                let arr = JSON.parse(data);
                                let arrCom = arr[0];
                                let arrVil = arr[1];

                                /* Fill list of communes */
                                for (const elt of arrCom) {
                                    let option = document.createElement('option');
                                    option.value = elt[0];
                                    option.innerText = elt[1];

                                    selectCom.appendChild(option);
                                }

                                /* Fill list of villes */
                                for (const elt of arrVil) {
                                    let option = document.createElement('option');
                                    option.value = elt[0];
                                    option.innerText = elt[1];

                                    selectVil.appendChild(option);
                                }
                            }
                        })
                    }
                }
            })
        }
    }
    else {
        document.getElementById('enregistrer').disabled = true;
        // response.innerHTML = '';
    }
}

function setParameter(e, option) {
    const cbo = document.getElementById('type_param');
    const button = document.getElementById('proceder_param');
    const links = [
        [ // [0] operations
            'index.php?page=operations/decaissement/form_mouvement&cat=', // [0][0]
            'index.php?page=operations/encaissement/cotisations/form_cotisations' // [0][1]
        ],
        [ // [1] listes
            'index.php?page=operations/encaissement/adhesions/liste_adhesions', // [1][0]
            'index.php?page=operations/encaissement/cotisations/liste_cotisations',  // [1][1]
            'index.php?page=membres/liste_membres', // [1, 2]
            'index.php?page=operations/liste_mouvements' // [1, 3]
        ],
        [ // [2] recherches
            'index.php?page=recherches/recherche_membres', // [2][0]
            'index.php?page=recherches/recherche_cotisations',  // [2][1]
            'index.php?page=recherches/recherche_mouvements'  // [2][2]
        ],
        [ // [3] stats
            'index.php?page=stats/stats_membres', // [3][0]
            'index.php?page=stats/stats_operations', // [3][1]
        ]
    ];

    console.log(cbo.value, e.value);

    if (cbo.value !== '') {
        let attr;

        if (option === 0) {
            if (cbo.value === "1" && e.value === "CAT02") // update this value based on the id of "cotisation"
                attr = links[option][cbo.value];
            else {
                attr = links[option][0];
                attr += e.value;
            }
        }
        else
            attr = links[option][e.value];

        // console.log(attr);
        button.setAttribute('href', attr);
    }
}

function setGender(e) {
    const tr = e.closest('tr');
        // gender = e.value;
    let n = tr.cells.length,
        mtt = tr.cells[n - 2].getElementsByTagName('input')[0];

    // mtt.value = gender === 'H' ? numberFormat(2000) : numberFormat(1000);
    mtt.value = numberFormat(1000);
}

function cboYearListLoader(cbo, nbr) {
    let n, elt;

    for (let i = 0; i < nbr; i++) {
        n = cbo.length - 1;
        elt = cbo.options[n].cloneNode(true);
        elt.value--;
        elt.text = elt.value;
        cbo.appendChild(elt);
    }
}

function namesLoader(usage, id, entity, state, key) {
    $.ajax({
        type: 'POST',
        url: 'membres/ajax/ajax_noms_entites.php',
        data: {
            usage: usage,
            entity: entity,
            state: state
        },
        success: function (data) {
            let arr = JSON.parse(data);
            // console.log(arr, key);
            if (usage === 'autocompletion') {
                let input;
                let listMbr;
                let temp = [];

                input = $('[id^=' + id + ']');

                for (let i = 0; i < input.length; i++) {
                    listMbr = new Awesomplete(input[i]);

                    if (key === 1 || key === 0) {
                        for (let j = 0; j < arr.length; j++) {
                            temp[j] = arr[j][key];
                        }
                        // Using the "Set" datatype, we create a new array without duplicate and assign it to the list to be added
                        listMbr.list = [...new Set(temp)];
                    }
                    else
                        listMbr.list = arr;
                }
            }
        }
    })
}

function memberCotisationLoader(e) {
    // check the emptiness of the field
    if (e.value) {
        let mbr = e.value.split(' ');
        let nomMbr,
            prenMbr = '',
            sql;
        let annee = document.getElementById('param_annee').value;

        // const mois = [];

        for (let i = 0; i < mbr.length; i++) {
            if (i === 0)
                nomMbr = `${mbr[i]}`;
            else if (prenMbr[i])
                prenMbr += ` ${mbr[i]}`;
            else
                prenMbr += `${mbr[i]}`;
        }

        sql = `SELECT id_mois, montant_operation FROM operations o INNER JOIN membres m ON o.id_membre = m.id_membre WHERE m.nom_membre = "${nomMbr}" AND m.pren_membre = "${prenMbr}" AND o.annee_operation = '${annee}' AND o.id_categorie = 'CAT02' ORDER BY id_mois`;
        console.log(sql);

        $.ajax({
            type: 'POST',
            data: {
                info: sql.trim()
            },
            url: 'operations/encaissement/cotisations/ajax/ajax_mbr_coti_mois.php',
            success: function (data) {
                const tr = e.closest('tr');
                const trChildrenList = tr.childNodes;
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

                                trTdInput[i].value = numberFormat(arrCoti[j].montant_operation);
                                trTdInput[i].setAttribute('readonly', true);
                            }
                        }
                    }
                }
            }
        })
    }
}

function setGraphLabelColor(rdoName) {
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
}

function categoriesFiller(list, cbo, status) {
    if (status === 'update') {
        // Delete the existing list
        if (cbo.options.length > 1) {
            while (cbo.lastChild && cbo.lastChild.value !== '')
                cbo.removeChild(cbo.lastChild);
        }
    }
    for (let category of list) {
        let n = cbo.length - 1;
        let elt = cbo.options[n].cloneNode(true);
        elt.value = category.id_categorie;
        elt.text = category.libelle_categorie.toUpperCase();
        cbo.appendChild(elt);
    }
}

function setCategories(e) {
    let cbo = document.getElementById('categorie');

    if (e.value) {
        let sql = `SELECT * FROM categories WHERE id_typ_op = ${e.value} AND libelle_categorie <> 'adhesion' ORDER BY libelle_categorie`;

        $.ajax({
            type: 'POST',
            data: {
                info: sql.trim()
            },
            url: 'operations/ajax/ajax_categorie.php',
            success: function (data) {
                let categories = JSON.parse(data);
                // console.log(categories);
                if (categories !== 'Empty') {
                    categoriesFiller(categories, cbo, 'update');
                    let btn = document.getElementById('proceder_param');
                    if (btn)
                        btn.setAttribute('href', '');
                }

            }
        })
    }
}

const setMoisCagnotte = (e) => {
    let listeMois = document.getElementById('cagnotte_mois');

    if (e.value) {
        let cbo = document.getElementById('cagnotte_mois');

        // if (cbo.length === 1) {
        //     let sql = `SELECT m.id_mois, libelle_mois FROM mois m INNER JOIN operations o ON m.id_mois = o.id_mois WHERE annee_operation = ${e.value} GROUP BY m.id_mois, libelle_mois`;
            let sql = `SELECT * FROM mois`;
            console.log(sql);

            $.ajax({
                type: 'POST',
                data: {
                    info: sql.trim()
                },
                url: 'operations/encaissement/cotisations/ajax/ajax_mbr_coti_mois.php',
                success: function (data) {
                    if (data) {
                        let months = JSON.parse(data);
                        // console.log(months);
                        // months = [...new Set(months)];
                        // console.log(months);
                        // if (months.length >= 1) {
                            for (const month of months) {
                                let n = cbo.length - 1;
                                let elt = cbo.options[n].cloneNode(true);
                                elt.value = month.numero_mois;
                                elt.text = month.libelle_mois.toUpperCase();
                                cbo.appendChild(elt);
                            }

                            listeMois.disabled = false;
                        // }
                    }

                }
            })
        // }
    }
    else {
        listeMois.options[0].selected = true;
        listeMois.disabled = true;
        document.getElementById('cagnotte').value = 0;
        document.getElementById('recette').value = 0;
    }
};

const getCagnotteMoisAnnee = (e) => {
    const annee = document.getElementById('cagnotte_annee').value;
    const mois = e.value;

    if (annee && mois) {
        let sql = `SELECT SUM(montant_operation) as total
FROM operations o INNER JOIN mois m ON o.id_mois = m.id_mois
  INNER JOIN categories c on o.id_categorie = c.id_categorie
WHERE numero_mois = ${mois} AND annee_operation = ${annee} AND o.id_categorie = 'CAT02'`;
        console.log(sql);

        $.ajax({
            type: 'POST',
            url: 'operations/encaissement/cotisations/ajax/ajax_mbr_coti_mois.php',
            data: {
                info: sql
            },
            success: function (data) {
                const info = JSON.parse(data);
                // console.log(info[0]);

                let cagnotte = document.getElementById('cagnotte');
                cagnotte.value = numberFormat(info[0].total) || 0;
            }
        })
    }
};

const getRecetteMoisAnnee = (e) => {
    const annee = document.getElementById('cagnotte_annee').value;
    const mois = e.value;

    if (annee && mois) {
        let sql = `SELECT SUM(montant_operation) as total
FROM operations o INNER JOIN mois m ON o.id_mois = m.id_mois
  INNER JOIN categories c on o.id_categorie = c.id_categorie
  INNER JOIN types_operation t on c.id_typ_op = t.id_typ_op
WHERE numero_mois = ${mois} AND YEAR(date_operation) = ${annee} AND c.id_typ_op = 1`;
        console.log(sql);

        $.ajax({
            type: 'POST',
            url: 'operations/encaissement/cotisations/ajax/ajax_mbr_coti_mois.php',
            data: {
                info: sql
            },
            success: function (data) {
                const info = JSON.parse(data);
                let recette = document.getElementById('recette');
                let total = info[0].total;
                recette.value = total ? numberFormat(total) || 0 : 0;
            }
        })
    }
};


/* Custom functions */

const displayConsultations = () => {
    let param = '',
        annee = document.getElementById('param_annee').value,
        response = document.getElementById('feedback');

    if (!document.getElementById('param').disabled)
        param = document.getElementById('param').value;

    if (annee) {
        $.ajax({
            type: 'POST',
            url: 'consultations/ajax_resultat_consultation_cotisations.php',
            data: {
                param: param,
                year: annee
            },
            success: function (data) {
                response.innerHTML = data;
                let liste = document.getElementById('liste_cotisations');
                if (!liste.childElementCount)
                    showModal('feedbackModal', '😔 Aucun résultat ne correspond à ce critère de recherche.');
                else {
                    document.getElementById('montant_total').value = document.getElementById('total').value;
                    document.getElementById('montant_total').setAttribute('readonly', true);
                }
            }
        })
    }

};

const rowAdder = (tableId, rowNbr, option) => {
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
        namesLoader('autocompletion', 'coti_mbr', 'membres');
};

/*const isFieldEmpty = field => {
    return document.getElementById(field).value === '';
};

function clearFields() {
    let elts = document.getElementsByTagName(tag);

    for (const elt of elts) {
        elt.value = '';
    }
}*/

function showModal (id, msg) {
    if (msg)
        document.getElementById(id).getElementsByTagName('p')[0].textContent = msg;
    $('#' + id).modal('show');
}

// https://blog.abelotech.com/posts/number-currency-formatting-javascript/
function numberFormat(nbr) {
    if (nbr)
        return nbr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function dateReformat (d) {
    let arr = d.split('-');
    return `${arr[2]}-${arr[1]}-${arr[0]}`;
}

function showSolde(status, date) {
    let dDay, member, anSolde;
    dDay = date ? date : moment().format('YYYY-MM-DD');
    document.getElementById('mbr_solde').value = "";
    namesLoader('autocompletion', 'mbr_solde', 'membres');
    anSolde = document.getElementById('an_solde').value;
    member = document.getElementById('mbr_solde').value;

    $.post(
        'operations/ajax/ajax_solde.php',
        {
            day: dDay,
            mbr: member,
            year: anSolde,
            status: status
        },
        function (data) {
            if (data !== "Void") {
                let info, arr, anSolde;
                arr = JSON.parse(data);
                switch (status) {
                    case 1:
                        info = 'des cotisations';
                        break;
                    case 2:
                        info = 'des adhésions';
                        break;
                    case 3:
                        info = 'des mouvements';
                        break;

                    default:
                        info = 'général';
                        break;
                }
                anSolde = document.getElementById('an_solde');
                anSolde.value = new Date().getFullYear();
                let p = document.getElementById('soldeModal').getElementsByTagName('p')[0];
                p.textContent = `Le solde ${info} au ${moment(dDay).format('dddd Do MMMM YYYY')} est de ${arr[1]}F CFA.`;
                //showModal('soldeModal', `Le solde ${info} au ${moment(dDay).format('dddd Do MMMM YYYY')} est de ${arr[1]}F CFA.`);
            }
        },
    );
}

/* Savers */

const saveCotisations = () => {
    const annee = document.getElementById('param_annee');
    const dateOpe = document.getElementById('date_ope');

    if (annee.value !== '' && dateOpe !== '') {
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
                url: 'operations/encaissement/cotisations/ajax/ajax_save_cotisations.php',
                data: {
                    data: data,
                    date_ope: dateOpe,
                    year: annee.value
                },
                success: function (data) {
                    if (data === 'Data saved!') {
                        showModal('successModal');

                        let response = document.getElementById('feedback');
                        response.innerHTML = '';

                        console.log(data);
                        annee.selectedIndex = 0;
                        dateOpe = '';
                        document.getElementById('enregistrer').disabled = true;
                    } else
                        showModal('errorModal', data);

                }
            });
        }
    }
    else
        showModal('errorModal', "Veuillez préciser l'année ET la date SVP.");
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
        let contact = $('[id^=contact]');
        let com = $('[id^=com]');
        let vil = $('[id^=vil]');
        let mtt = $('[id^=mtt]');

        let infoMbr = [nom, pren, contact, com, vil, gender, mtt];
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
                    if (j <= infoMbrNbr) {
                        data[m][n++] = infoMbr[j - 1][i].value;
                    }
                }
                m++;
            }
        }

        // console.log(data.length, data[0].length);

        if (data.length && data[0].length > 1) {
            $.ajax({
                type: 'POST',
                url: 'operations/encaissement/adhesions/ajax/ajax_save_adhesions.php',
                data: {
                    arr: data,
                    dateAdhe: date.value
                },
                success: function (data) {
                    console.log('Done...');
                    console.log(data);

                    if (data === 'Data saved') {
                        showModal('successModal', 'La liste des adhérents a bien été enregistrée 👍');
                        date.value = '';
                        document.getElementById('feedback').innerHTML = '';
                        document.getElementById('enregistrer').disabled = true;
                    }
                    else
                        showModal('errorModal', data);
                }
            })
        }
    } else
        showModal('errorModal');
};

const saveCategorie = () => {
    let libelle = document.getElementById('sav_categorie');
    let typeOperation = document.getElementById('sav_type_ope');
    let typeParam = document.getElementById('type_param');

    if (libelle.value && typeOperation.value) {
        $.post(
            'operations/ajax/ajax_categorie.php',
            {
                libelle: libelle.value,
                type: typeOperation.value
            },
            function (data) {
                let feedback = document.getElementById('alert_msg');
                let alertType;
                let arr = JSON.parse(data);
                let cbo = document.getElementById('cate');

                // console.log(typeParam.value, arr[0].id_typ_op);
                if (typeParam.value === arr[0].id_typ_op)
                    categoriesFiller(arr, cbo, 'new');

                if (data !== "Error while saving data" && data !== "Already in database") {
                    alertType = 'success';
                    libelle.value = "";
                    typeOperation.selectedIndex = 0;
                    data = `'${arr[0].libelle_categorie}' a été ajoutée.`;
                }
                else if (data === "Error while saving data")
                    alertType = 'danger';
                else
                    alertType = 'info';

                showAlert(alertType, data, feedback);
            }
        );
    }
};

function saveDecaissement() {
    let dateOpe = document.getElementById('date_ope');
    let mtt = document.getElementById('mtt');
    let nomItl = document.getElementById('nom_itl');
    let prenItl = document.getElementById('pren_itl');
    let titreItl = document.getElementById('titre_itl');
    let telItl = document.getElementById('tel_itl');
    let comItl = document.getElementById('commune');
    let mbrInter = document.getElementById('mbr_inter');
    let obsOperation = document.getElementById('commentaires');
    let categorie = document.getElementById('cate');

    console.log(dateOpe.value, mtt.value, nomItl.value, prenItl.value, titreItl.value, telItl.value, comItl.value, mbrInter.value, obsOperation.value, categorie.value);
    if (dateOpe.value && nomItl.value && mtt.value && mbrInter.value && obsOperation.value) {
        $.post(
            'operations/decaissement/ajax/ajax_save_mouvement.php',
            {
                dateOpe: dateOpe.value.trim(),
                mtt: mtt.value.trim(),
                nomItl: nomItl.value.trim().toUpperCase(),
                prenItl: prenItl.value.trim().toUpperCase(),
                titreItl: titreItl.value.trim().toUpperCase(),
                telItl: telItl.value.trim(),
                comItl: comItl.value.trim().toUpperCase(),
                mbrInter: mbrInter.value.trim().toUpperCase(),
                com: obsOperation.value.trim().toUpperCase(),
                cate: categorie.value.trim()
            },
            function (response) {
                console.log(response);
                if (response === 'Saved') {
                    showModal('successModal');
                    dateOpe.value = "";
                    mtt.value = "";
                    nomItl.value = "";
                    prenItl.value = "";
                    titreItl.value = "";
                    telItl.value = "";
                    comItl.value = "";
                    mbrInter.value = "";
                    obsOperation.value = "";
                }
                else
                    showModal('errorModal', response);
            }
        )
    }
    else
        showModal('errorModal', 'Veuillez renseigner TOUS les champs suivis de (*) SVP.')
}

function showAlert (type, msg, parentNode) {
    const alertType = 'alert-' + type;

    let div = document.createElement('div');
    div.setAttribute('role', 'alert');
    div.classList.add('alert', alertType, 'alert-dismissible', 'fade', 'show', 'my-0');

    let textContent = document.createTextNode(msg);
    div.appendChild(textContent);

    let button = document.createElement('button');
    button.setAttribute('type', 'button');
    button.setAttribute('data-dismiss', 'alert');
    button.setAttribute('aria-label', 'Close');
    button.classList.add('close');

    let span = document.createElement('span');
    span.setAttribute('aria-hidden', 'true');
    span.appendChild(document.createTextNode('×'));

    button.appendChild(span);
    div.appendChild(button);

    parentNode.appendChild(div);
}

/* Search methods */

function displayMembres() {
    let info, mbr, response;

    mbr = document.getElementById('membre').value;
    response = document.getElementById('feedback');
    info = (mbr !== '') ? mbr : 'empty';

    $.ajax({
        type: 'POST',
        data: {
            info: info,
            entity: 'membres'
        },
        url: 'membres/ajax/ajax_resultat_consultation_membres.php',
        success: function (data) {
            response.innerHTML = data;
            let liste = document.getElementById('liste_membres');
            if (!liste.childElementCount)
                showModal('feedbackModal', '😔 Aucun résultat ne correspond à ce critère de recherche.');
        }
    })
}

function displayAdhesions() {
    let info, mbr, response;

    mbr = document.getElementById('membre').value;
    response = document.getElementById('feedback');
    info = mbr ? mbr : '';

    $.ajax({
        type: 'POST',
        data: {
            info: info
        },
        url: 'operations/encaissement/adhesions/ajax/ajax_resultat_consultation_adhesions.php',
        success: function (data) {
            response.innerHTML = data;
            let liste = document.getElementById('liste_membres');
            if (!liste.childElementCount)
                showModal('feedbackModal', '😔 Aucun résultat ne correspond à ce critère de recherche.');
        }
    })
}

function displayMouvements() {
    let dateOpe, dDay, year, response;

    dateOpe = document.getElementById('date_ope').value;
    dDay = (dateOpe !== '') ? dateOpe : ''; // TODO: check all variable updated from ternary operators

    $.post(
        'operations/ajax/ajax_resultat_mouvements.php', // url
        {
            info: dDay
        },
        function (data) {
            response = document.getElementById('feedback');
            response.innerHTML = data;
            let liste = document.getElementById('liste_mouvements');
            if (!liste.childElementCount)
                showModal('feedbackModal', '😔 Aucun résultat ne correspond à ce critère de recherche.');
            else {
                document.getElementById('montant_total').value = document.getElementById('total').value;
                document.getElementById('montant_total').setAttribute('readonly', 'true');
            }
        }
    );
}

function findMembres(type) {

    if (type === 'recherche') {
        let nom, prenoms, genre, commune, ville, sql;
        let response = document.getElementById('feedback');

        nom = document.getElementById('nom').value;
        prenoms = document.getElementById('prenoms').value;
        genre = document.getElementById('genre').value;
        commune = document.getElementById('commune').value;
        ville = document.getElementById('ville').value;

        if (nom !== '' || prenoms !== '' || genre !== '' || commune !== '' || ville !== '') {
            sql = "SELECT * FROM membres m INNER JOIN villes v on m.id_ville = v.id_ville INNER JOIN communes c on m.id_commune = c.id_commune WHERE ";

            if (nom) {
                if (sql.endsWith("'"))
                    sql += ` AND m.nom_membre LIKE '%${nom}%'`;
                else
                    sql += `m.nom_membre LIKE '%${nom}%'`;
            }

            if (prenoms) {
                if (sql.endsWith("'"))
                    sql += ` AND m.pren_membre LIKE '%${prenoms}%'`;
                else
                    sql += `m.pren_membre LIKE '%${prenoms}%'`;
            }

            if (genre) {
                if (sql.endsWith("'"))
                    sql += ` AND m.genre_membre = '${genre}'`;
                else
                    sql += `m.genre_membre = '${genre}'`;
            }

            if (commune) {
                if (sql.endsWith("'"))
                    sql += ` AND c.libelle_commune LIKE '%${commune}%'`;
                else
                    sql += `c.libelle_commune LIKE '%${commune}%'`;
            }

            if (ville) {
                if (sql.endsWith("'"))
                    sql += ` AND v.libelle_ville LIKE '%${ville}%'`;
                else
                    sql += `v.libelle_ville LIKE '%${ville}%'`;
            }

            // console.log(sql);
            if (sql !== "SELECT * FROM membres WHERE ") {
                $.ajax({
                    type: 'POST',
                    data: {
                        info: sql.trim()
                    },
                    url: 'recherches/ajax/ajax_recherche_membres.php',
                    success: function (data) {
                        if (data !== 'Not found')
                            response.innerHTML = data;
                        else {
                            showModal('feedbackModal', `😔 Aucun résultat.
Veuillez modifier les critères de recherche.`);
                            response.innerHTML = '';
                        }
                    }
                })
            }
        } else {
            showModal('feedbackModal', `🤔 Veuillez spécifier un critère de recherche.`);
            response.innerHTML = '';
        }
    }
}

function findCotisations() {
    let annee,
        mois,
        nom,
        prenoms,
        genre,
        ville,
        commune,
        dateOp,
        dateSaisie;
    let sql;
    let response = document.getElementById('feedback');

    annee = document.getElementById('annee').value;
    mois = document.getElementById('mois').value;

    nom = document.getElementById('nom').value;
    prenoms = document.getElementById('prenoms').value;
    genre = document.getElementById('genre').value;
    ville = document.getElementById('ville').value;
    commune = document.getElementById('commune').value;

    dateOp = document.getElementById('date_ope').value;
    dateSaisie = document.getElementById('date_saisie').value;

    if (annee !== '' || mois !== '' || nom !== '' || prenoms !== '' || genre !== '' || commune !== '' || ville !== '' || dateOp !== '' || dateSaisie !== '') {
        sql = `SELECT * FROM operations o INNER JOIN membres m on o.id_membre = m.id_membre INNER JOIN communes c on m.id_commune = c.id_commune INNER JOIN villes v on m.id_ville = v.id_ville INNER JOIN categories cat on o.id_categorie = cat.id_categorie INNER JOIN types_operation typ on cat.id_typ_op = typ.id_typ_op INNER JOIN mois mo on o.id_mois = mo.id_mois WHERE o.id_categorie = 'CAT02' `;

        if (annee) {
            sql += ` AND o.annee_operation = ${annee}`;
        }

        if (mois) {
            sql += ` AND mo.id_mois = '${mois}'`;
        }

        if (nom) {
            sql += ` AND m.nom_membre LIKE '%${nom}%'`;
        }

        if (prenoms) {
            sql += ` AND m.pren_membre LIKE '%${prenoms}%'`;
        }

        if (genre) {
            sql += ` AND m.genre_membre = '${genre}'`;
        }

        if (commune) {
            sql += ` AND c.libelle_commune LIKE '%${commune}%'`;
        }

        if (ville) {
            sql += ` AND v.libelle_ville LIKE '%${ville}%'`;
        }

        if (dateOp) {
            sql += ` AND o.date_operation = '${dateOp}'`;
        }

        if (dateSaisie) {
            sql += ` AND o.date_saisie_operation = '${dateSaisie}'`;
        }

        // console.log(sql);
        if (sql !== "SELECT * FROM operations o INNER JOIN membres m on o.id_membre = m.id_membre INNER JOIN communes c on m.id_commune = c.id_commune INNER JOIN villes v on m.id_ville = v.id_ville INNER JOIN categories cat on o.id_categorie = cat.id_categorie INNER JOIN types_operation typ on cat.id_typ_op = typ.id_typ_op INNER JOIN mois mo on o.id_mois = mo.id_mois WHERE o.id_categorie = 'CAT02' ") {
            $.ajax({
                type: 'POST',
                data: {
                    info: sql.trim()
                },
                url: 'recherches/ajax/ajax_recherche_cotisations.php',
                success: function (data) {
                    response.style.maxHeight = '50vh';
                    response.style.overflow = 'auto';
                    response.innerHTML = data;
                    let liste = document.getElementById('liste_cotisations');
                    if (!liste.childElementCount)
                        showModal('feedbackModal', '😔 Aucun résultat ne correspond à ce critère de recherche.');
                    else {
                        document.getElementById('montant_total').value = document.getElementById('total').value;
                        document.getElementById('montant_total').setAttribute('readonly', true);
                    }
                }
            })
        }
    } else {
        showModal('feedbackModal', `🤔 Veuillez spécifier un critère de recherche.`);
        response.innerHTML = '';
    }
}

function findMouvements() {
    let typOp,
        categorie,
        annee,
        mois,
        nom,
        prenoms,
        titre,
        membre,
        commune,
        contact,
        dateOp;
    let sql;
    let response = document.getElementById('feedback');

    typOp = document.getElementById('typ_op').value;
    categorie = document.getElementById('categorie').value;

    annee = document.getElementById('annee').value;
    mois = document.getElementById('mois').value;

    nom = document.getElementById('nom').value;
    prenoms = document.getElementById('prenoms').value;
    titre = document.getElementById('titre').value;
    commune = document.getElementById('commune').value;
    contact = document.getElementById('contact').value;

    membre = document.getElementById('membre').value;

    dateOp = document.getElementById('date_ope').value;

    if (typOp !== '' || categorie !== '' || annee !== '' || mois !== '' || nom !== '' || prenoms !== '' || titre !== '' || membre !== '' || commune !== '' || dateOp !== '') {
        sql = `SELECT DISTINCT id_operation, c.id_typ_op, date_operation, libelle_typ_op, montant_operation, libelle_categorie, nom_interlocuteur, pren_interlocuteur, titre_interlocuteur, contact_interlocuteur, nom_membre, pren_membre, obs_operation FROM interlocuteurs i INNER JOIN operations o on i.id_interlocuteur = o.id_interlocuteur INNER JOIN categories c on o.id_categorie = c.id_categorie INNER JOIN types_operation to2 on c.id_typ_op = to2.id_typ_op INNER JOIN membres m on o.id_membre = m.id_membre WHERE `;

        if (typOp) {
            if (sql.endsWith("'"))
                sql += ` AND to2.id_typ_op = ${typOp}`;
            else
                sql += `to2.id_typ_op = '${typOp}'`;
        }

        if (categorie) {
            if (sql.endsWith("'"))
                sql += ` AND c.id_categorie = '${categorie}'`;
            else
                sql += `c.id_categorie = '${categorie}'`;
        }

        if (annee) {
            if (sql.endsWith("'"))
                sql += ` AND o.annee_operation = ${annee}`;
            else
                sql += `o.annee_operation = '${annee}'`;
        }

        if (mois) {
            if (sql.endsWith("'"))
                sql += ` AND id_mois = '${mois}'`;
            else
                sql += `id_mois = '${mois}'`;
        }

        if (nom) {
            if (sql.endsWith("'"))
                sql += ` AND i.nom_interlocuteur LIKE '%${nom}%'`;
            else
                sql += `i.nom_interlocuteur LIKE '%${nom}%'`;
        }

        if (prenoms) {
            if (sql.endsWith("'"))
                sql += ` AND i.pren_interlocuteur LIKE '%${prenoms}%'`;
            else
                sql += `i.pren_interlocuteur LIKE '%${prenoms}%'`;
        }

        if (titre) {
            if (sql.endsWith("'"))
                sql += ` AND i.titre_interlocuteur LIKE '%${titre}%'`;
            else
                sql += `i.titre_interlocuteur LIKE '%${titre}%'`;
        }

        if (membre) {
            if (sql.endsWith("'"))
                sql += ` AND m.nom_membre LIKE '%${membre}%' OR m.pren_membre LIKE '%${membre}%'`;
            else
                sql += `m.nom_membre LIKE '%${membre}%' OR m.pren_membre LIKE '%${membre}%'`;
        }

        if (commune) {
            if (sql.endsWith("'"))
                sql += ` AND i.localite_interlocuteur LIKE '%${commune}%'`;
            else
                sql += `i.localite_interlocuteur LIKE '%${commune}%'`;
        }

        if (contact) {
            if (sql.endsWith("'"))
                sql += ` AND i.contact_interlocuteur LIKE '%${contact}%'`;
            else
                sql += `i.contact_interlocuteur LIKE '%${contact}%'`;
        }

        if (dateOp) {
            if (sql.endsWith("'"))
                sql += ` AND date_operation = '${dateOp}'`;
            else
                sql += `date_operation = '${dateOp}'`;
        }

        sql += " ORDER BY date_operation";
        // console.log(sql);
        if (sql !== "SELECT DISTINCT id_operation, c.id_typ_op, date_operation, libelle_typ_op, montant_operation, libelle_categorie, nom_interlocuteur, pren_interlocuteur, titre_interlocuteur, contact_interlocuteur, nom_membre, pren_membre, obs_operation FROM interlocuteurs i INNER JOIN operations o on i.id_interlocuteur = o.id_interlocuteur INNER JOIN categories c on o.id_categorie = c.id_categorie INNER JOIN types_operation to2 on c.id_typ_op = to2.id_typ_op INNER JOIN membres m on o.id_membre = m.id_membre WHERE ORDER BY date_operation") {
            $.ajax({
                type: 'POST',
                data: {
                    info: sql.trim()
                },
                url: 'recherches/ajax/ajax_recherche_mouvements.php',
                success: function (data) {
                    response.style.maxHeight = '50vh';
                    response.style.overflow = 'auto';
                    response.innerHTML = data;
                    let liste = document.getElementById('liste_mouvements');
                    if (!liste.childElementCount)
                        showModal('feedbackModal', '😔 Aucun résultat ne correspond à ce critère de recherche.');
                    else {
                        document.getElementById('montant_total').value = document.getElementById('total').value;
                        document.getElementById('montant_total').setAttribute('readonly', true);
                    }
                }
            })
        }
    } else {
        showModal('feedbackModal', `🤔 Veuillez spécifier un critère de recherche.`);
        response.innerHTML = '';
    }
}

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