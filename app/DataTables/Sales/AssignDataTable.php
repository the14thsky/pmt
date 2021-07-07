<?php

namespace App\DataTables\Sales;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class AssignDataTable extends DataTable
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
        $users = $this->users;
        // return  {!! Form::checkbox('users[]', $id) !!}
        return $dataTable->editColumn('id', static function ($row) use($users) {
            in_array($row->id,$users) ? $checked = 'checked' :  $checked= '';
            return '<input type="checkbox" name="users[]"
            value="'.$row->id.'"'.$checked.' />';
        })->rawColumns(['id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model::with(['department','orgRole']);
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

           // ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'frtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                // 'buttons'   => [
                //     ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                //     ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                //     ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                //     ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                //     ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                // ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    // ->addCheckbox(['name'=>'users', in_array($id, $this->users) ? 'checked' :''])
    protected function getColumns()
    {
        return [
            'first_name',
            'last_name',
            'email',
            'department_id'=>['data'=>'department.department_name', 'title'=>'Department', 'name'=>'department_id'],
            'org_role_id'=>['data'=>'org_role.role_name', 'title'=>'Organisation Role', 'name'=>'org_role_id'],
            'id'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'users_datatable_' . time();
    }
}
