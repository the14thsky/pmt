<?php

namespace App\DataTables\Sales;

use App\Models\Administration\UserProject;
use App\Models\Sales\Project;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ProjectDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'sales.projects.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Project $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Project $model)
    {
        $roles = auth('sanctum')->user()->tokens->first()->abilities;
        if(in_array('superadmin', $roles)){
            return $model::with(['customer', 'opportunity'])->select('projects.*');
        }
        else{
            $user_projects = UserProject::where('user_id', auth('sanctum')->user()->id)->pluck('project_id');
            return $model::with(['customer', 'opportunity'])->whereIn('projects.id',$user_projects)->select('projects.*');
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
                    // ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
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
            'customer_id' => ['data'=>'customer.company_name', 'title' => 'Company'],
            'opportunity_id' => ['data'=>'opportunity.title', 'title'=>'Opportunity'],
            'project_code',
            'status'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'projects_datatable_' . time();
    }
}
