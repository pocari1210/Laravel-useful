<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
  /**
   * Build DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   * @return \Yajra\DataTables\EloquentDataTable
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      // ->addColumn('action', 'users.action')

      ->addColumn('action', function ($query) {
        return '<a href="' . route('user.edit', $query->id) . '" class="btn btn-primary">Edit</a><a href="" class="btn btn-danger">Delete</a>';
      })
      ->addColumn('demo', function ($query) {
        return 'demo';
      })

      ->setRowId('id');
  }

  /**
   * Get query source of dataTable.
   *
   * @param \App\Models\User $model
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function query(User $model): QueryBuilder
  {
    return $model->newQuery();
  }

  /**
   * Optional method if you want to use html builder.
   *
   * @return \Yajra\DataTables\Html\Builder
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()

      // テーブルID
      ->setTableId('users-table')

      // 列名を渡す必要がある
      ->columns($this->getColumns())
      ->minifiedAjax()
      //->dom('Bfrtip')
      ->orderBy(1)
      ->selectStyleSingle()
      ->buttons([
        Button::make('excel'),
        Button::make('csv'),
        Button::make('pdf'),
        Button::make('print'),
        // Button::make('reset'),
        Button::make('reload')
      ]);
  }

  /**
   * Get the dataTable columns definition.
   *
   * @return array
   */
  public function getColumns(): array
  {
    return [

      // 列名を指定(Userテーブルのカラムと合わせる)
      // カラム名が一致していないとエラーが出る
      Column::make('id'),
      Column::make('name'),
      Column::make('email'),
      Column::make('created_at'),
      Column::make('updated_at'),
      Column::make('action'),

    ];
  }

  /**
   * Get filename for export.
   *
   * @return string
   */
  protected function filename(): string
  {
    return 'Users_' . date('YmdHis');
  }
}
