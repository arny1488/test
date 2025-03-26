class Example {

    constructor() {

        this.exampleTable = null;
        this.exampleFilter = '';
        this.exampleFilterTimerId = null;

        this.build();
        this.events();
    }

    build() {
        this.setDataTable();
    }

    events() {
        this.onExampleFilter();
        this.onExampleFilterClear();
    }

    setDataTable() {

        const menuTpl = $('#menuTpl').html();

        this.exampleTable = $('#exampleControlTable').DataTable({
            processing: true,
            language: dataTable_i18n,
            dom: '<"table-responsive mb-3"t>rp',
            autoWidth: false,
            pageLength: 25,
            serverSide: true,
            searchDelay: 500,
            ajax: {
                url: `${ABS_PATH}example/get`,
                type: "POST",
                data: (d) => {
                    d.search.value = this.exampleFilter;
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

        this.exampleTable.on('page.dt', () => {
            $(':focus').blur();
            $('html, body').animate({
                scrollTop: 0
            }, 250);
        });
    }

    onExampleFilter() {
        $('#tableFilter').on('input', () => {
            clearTimeout(this.exampleFilterTimerId);
            this.exampleFilterTimerId = setTimeout(
                () => {
                    this.exampleFilter = $('#tableFilter').val();
                    this.exampleTable.ajax.reload();
                },
                500
            );
        });
    }

    onExampleFilterClear() {
        $('#tableFilterClear').on('click', () => {
            clearTimeout(this.exampleFilterTimerId);
            $('#tableFilter').val('')
            this.exampleFilter = '';
            this.exampleTable.ajax.reload();
        });
    }

}

$(document).ready(function () {
    new Example();
});