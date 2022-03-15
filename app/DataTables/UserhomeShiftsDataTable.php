<?php

namespace App\DataTables;

use App\Models\Shift;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserhomeShiftsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('pharmacy_id', function (Shift $shift) {
                return $shift->Pharmacy->name ?? '';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Shift $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Shift $model)
    {
        $key = $this->key;
        return $model->newQuery()->where('user_id', $key)->with('Pharmacy');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('userhomeshifts-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
            ->lengthMenu(
                [
                    [10, 25, 50, -1],
                    ['10 صـفوف', '25 صـف', '50 صـف', 'كل الصـفوف']
                ])
            ->parameters([
                'language' => ['url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json'],

            ])
            ->parameters([
                'initComplete' => "function () {

                    this.api().columns([0]).every(function () {
                        var column = this;
                        var input = document.createElement(\"input\");
                        $(input).attr( 'class', 'form-control');
                        $(input).attr( 'placeholder', 'اسم الصيدليه');
                        $(input).appendTo($(column.footer()).empty())
                        .on('keyup', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                    });


                    this.api().columns([1]).every(function () {
                        var column = this;
                        var input = document.createElement(\"input\");
                        $(input).attr( 'class', 'form-control');
                        $(input).attr( 'placeholder', 'اليوم');
                        $(input).appendTo($(column.footer()).empty())
                        .on('keyup', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                    });


                    this.api().columns([2]).every( function () {
                        var column = this;
                        var select = $('<select class=\"form-control\" ><option  selected value=\"\">بدايه الدوام</option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val )
                                    .draw();


                            } );
                            column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value=\"'+d+'\">'+d+'</option>' )
                        } );
                    } );

                    this.api().columns([3]).every( function () {
                        var column = this;
                        var select = $('<select class=\"form-control\" ><option  selected value=\"\">نهايه الدوام</option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val )
                                    .draw();


                            } );
                            column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value=\"'+d+'\">'+d+'</option>' )
                        } );
                    } );

                }",
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('pharmacy_id')->name('Pharmacy.name')->title('اسم الصيدليه'),
            Column::make('day')->title('اليوم'),
            Column::make('starts_at')->title('بدايه الدوام'),
            Column::make('ends_at')->title('نهايه الدوام'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'UserhomeShifts_' . date('YmdHis');
    }
}
