<?php include('admin-sidebar.php'); ?>
<!-- content start -->
<div class="admin-content">
    <div class="admin-content-body">
        <div class="am-cf am-padding am-padding-bottom-0">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品</strong> / <small>分类</small></div>
        </div>

        <hr>

        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <button type="button" class="am-btn am-btn-default"><span class="am-icon-plus"></span> <a href="cateadd.php">新增</a></button>
                    </div>
                </div>
            </div>
            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-form-group">
                    <select data-am-selected="{btnSize: 'sm'}">
                        <option value="option1">所有类别</option>
                        <option value="option2">IT业界</option>
                        <option value="option3">数码产品</option>
                        <option value="option3">笔记本电脑</option>
                        <option value="option3">平板电脑</option>
                        <option value="option3">只能手机</option>
                        <option value="option3">超极本</option>
                    </select>
                </div>
            </div>
            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-input-group am-input-group-sm">
                    <input type="text" class="am-form-field">
          <span class="am-input-group-btn">
            <button class="am-btn am-btn-default" type="button">搜索</button>
          </span>
                </div>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <form class="am-form">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
<!--                            <th class="table-check"><input type="checkbox" /></th>-->
<!--                            <th class="table-id">ID</th>-->
                            <th class="table-title">分类名称</th>
                            <th class="table-type">简介</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($catlist as $v) { ?>
                        <tr>
<!--                            <td><input type="checkbox" /></td>-->
<!--                            <td>--><?php //echo $v['cat_id']; ?><!--</td>-->
                            <td  style="padding-left: <?php echo $v['lev']*2+0.7 ?>em;"><?php echo $v['cat_name']; ?></td>
                            <td><?php echo $v['intro']; ?></td>
                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <button class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                            <span class="am-icon-pencil-square-o"></span> <a href="catedit.php?cat_id=<?php echo $v['cat_id']; ?>">编辑</a></button>
                                        <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" href="catedel.php?cat_id=<?php echo $v['cat_id']; ?>" onclick="if(!confirm('确实要删除吗？')) { return false;}" title="删除">
                                            <span class="am-icon-trash-o"></span> 删除</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="am-cf">
                        共 15 条记录
                        <div class="am-fr">
                            <ul class="am-pagination">
                                <li class="am-disabled"><a href="#">«</a></li>
                                <li class="am-active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">»</a></li>
                            </ul>
                        </div>
                    </div>
                    <hr />
                    <p>注：.....</p>
                </form>
            </div>

        </div>
    </div>

    <footer class="admin-content-footer">
        <hr>
        <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </footer>

</div>
<!-- content end -->

<?php include('admin-footer.php'); ?>
