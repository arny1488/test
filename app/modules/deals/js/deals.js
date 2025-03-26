class Deals {

    constructor() {

        this.dealsTable = null;
        this.dealsFilter = '';
        this.dealsFilterTimerId = null;

        this.build();
        this.events();
    }

    build() {
        this.setDataTable();
    }

    events() {
        this.onDealsFilter();
        this.onDealsFilterClear();
    }

    setDataTable() {

        const menuTpl = $('#menuTpl').html();

        this.dealsTable = $('#dealsControlTable').DataTable({
            processing: true,
            language: dataTable_i18n,
            dom: '<"table-responsive mb-3"t>rp',
            autoWidth: false,
            pageLength: 25,
            serverSide: true,
            searchDelay: 500,
            ajax: {
                url: `${ABS_PATH}deals/get`,
                type: "POST",
                data: (d) => {
                    d.search.value = this.dealsFilter;
                }
            },
            columns: [
                {
                    data: 'name'
                },
                {
                    data: 'id',
                    render: (data, type, row) => {
                        return menuTpl.replace(/:id/g, data);
                    },
                    createdCell: (td, cellData, rowData, row, col) => {
                        $(td).addClass('py-1');
                    }
                }
            ]
        });

        this.dealsTable.on('page.dt', () => {
            $(':focus').blur();
            $('html, body').animate({
                scrollTop: 0
            }, 250);
        });
    }

    onDealsFilter() {
        $('#tableFilter').on('input', () => {
            clearTimeout(this.dealsFilterTimerId);
            this.dealsFilterTimerId = setTimeout(
                () => {
                    this.dealsFilter = $('#tableFilter').val();
                    this.dealsTable.ajax.reload();
                },
                500
            );
        });
    }

    onDealsFilterClear() {
        $('#tableFilterClear').on('click', () => {
            clearTimeout(this.dealsFilterTimerId);
            $('#tableFilter').val('')
            this.dealsFilter = '';
            this.dealsTable.ajax.reload();
        });
    }

}

$(document).ready(function () {
    new Deals();
});