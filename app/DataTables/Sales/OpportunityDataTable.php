<?php

namespace App\DataTables\Sales;

use App\Models\Sales\Opportunity;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class OpportunityDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'sales.opportunities.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Opportunity $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Opportunity $model)
    {
        $roles = auth('sanctum')->user()->tokens->first()->abilities;
        if(in_array('superadmin', $roles)){
            return $model::with(['customer'])->select('opportunities.*');
        }
        else{
            return $model::with(['customer'])->where('created_by', auth('sanctum')->user()->id)->select('opportunities.*');
        }

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
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
            'customer_id'=>['data'=>'customer.company_name', 'title'=>'Company Name'],
            'title',
            'opportunity_description',
            'estimated_budget',
            'chances',
            'status',
            'remarks'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'opportunities_datatable_' . time();
    }
}
