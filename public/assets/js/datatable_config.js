
    $('#data-table').DataTable({
        dom: '<"html5buttons" B>lTfgitp',
        language: {
            lengthMenu: "MENU",
            search: "INPUT",
            searchPlaceholder: "Rechercher..",
            infoFiltered: " - filtré à partir de MAX enregistrements",
            infoEmpty: "Affichage 0 sur 0 de 0 enregistrement",
            emptyTable: "Aucune donnée disponible dans la table",
            zeroRecords: "Aucun enregistrement correspondant trouvé",
            info: "Page <strong>PAGE</strong> sur <strong>PAGES</strong>",
            paginate: {
                previous: 'Précédent',
                next: 'Suivant',
            },
            buttons: {
                copyTitle: 'Ajouté au presse-papiers',
                copyKeys: 'Appuyez sur <i>ctrl</i> ou <i>\u2318</i> + <i>C</i> pour copier les données du tableau à votre presse-papiers. <br><br>Pour annuler, cliquez sur ce message ou appuyez sur Echap.',
                copySuccess: {
                    _: '%d lignes copiées',
                    1: '1 ligne copiée'
                }
            }
        },
        order: []
    });