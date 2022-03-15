<?php

namespace App\DataTables;

use App\Models\Pharmacy;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PharmacyDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.pharmacy.parts.action')
            ->addColumn('shifts', 'dashboard.pharmacy.parts.shifts')
            ->addColumn('id', function ($data) {
                return "<input type='checkbox' name='data[]' class='data-item' value='{$data['id']}'/> ";
            })
            ->rawColumns(['action','id','shifts']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pharmacy $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pharmacy $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('pharmacy-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0,'desc')
            ->lengthMenu(
                [
                    [10, 25, 50, -1],
                    ['10 صـفوف', '25 صـف', '50 صـف', 'كل الصـفوف']
                ])
            ->parameters([
                'language' => ['url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json']
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
            Column::make('id')
                ->title("<input type='checkbox' id='DataSelect' class='select-checkbox'>")
                ->orderable(false)
                ->width(30),
            Column::make('name')->title('الاسم'),
            Column::make('phone')->title('رقم الهاتف'),
            Column::make('shifts')->title('الدوام'),
            Column::make('action')->title('الاجرائات'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Pharmacy_' . date('YmdHis');
    }
}
