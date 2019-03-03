{extend name='template/layout'}

	{block name='content'}
		  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="{:url('save')}" data-toggle="tooltip" title="新增" class="btn btn-primary"> <i class="fa fa-plus"></i>
        </a>
        <button type="button" data-toggle="tooltip" title="删除" class="btn btn-danger" onclick="confirm('确认？') ? $('#form-product').submit() : false;">
          <i class="fa fa-trash-o"></i>
        </button>
      </div>
      <h1>%title%管理</h1>
      <ul class="breadcrumb">
        <li>
          <a href="">首页</a>
        </li>
        <li>
          <a href="">%title%管理</a>
        </li>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">
          <i class="fa fa-list"></i>
          %title%列表
        </h3>
      </div>
      <div class="panel-body">

        <form action="{:url('multidel')}" method="post" enctype="multipart/form-data" id="form-product">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center">
                    <input type="checkbox" id='check-all' />
                  </td>
%list_head%
                  <td class="text-left">
                    <a href="">操作</a>
                  </td>
                </tr>
              </thead>
              <tbody>
              {volist name='result' id='row'}
                <tr>
                  <td class="text-center">
                    <input type="checkbox" name="selected[]" value="{$row['id']}" />
                  </td>
%list_body%
                  <td class="text-right">
                    <a href="{:url('save',['id'=>$row['id']])}" data-toggle="tooltip" title="编辑" class="btn btn-primary">
                      <i class="fa fa-pencil"></i>
                    </a>
                  </td>
                </tr>
            {/volist}
              </tbody>
            
            </table>
          </div>
        </form>
        <div class="row">
			{$result->render()}
        </div>
      </div>
    </div>
  </div>
{/block}

{block name='appendJs'}
	<script>
		$(function(){
			$('#check-all').click(function(){
				$(":checkbox(name=selected[])").prop('checked',$(this).prop('checked'));
			// console.log($(this).prop('checked'));
			})
		})

	</script>
{/block}