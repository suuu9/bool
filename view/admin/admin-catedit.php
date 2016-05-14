<?php include('admin-sidebar.php'); ?>
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf">
                    <strong class="am-text-primary am-text-lg">添加</strong> /
                    <small>分类</small>
                </div>
            </div>

            <hr>
            <form class="am-form" action="cateditAct.php" method="POST">
                <div class="am-tabs am-margin" data-am-tabs>
                    <ul class="am-tabs-nav am-nav am-nav-tabs">
                        <li class="am-active"><a href="#tab1">基本信息</a></li>
                    </ul>

                    <div class="am-tabs-bd">
                        <div class="am-active" id="tab1">
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    文章标题
                                </div>
                                <div class="am-u-sm-8 am-u-md-4">
                                    <input type="text" name="cat_name" value="<?php echo $catinfo['cat_name']; ?>" class="am-input-sm">
                                </div>
                                <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
                            </div>
                            <div class="am-g am-margin-top am-margin-bottom">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">所属类别</div>
                                <div class="am-u-sm-8 am-u-md-10">
                                    <select data-am-selected="{btnSize: 'sm'}" name="parent_id">
                                        <option value="0">顶级分类</option>
                                        <?php foreach($catlist as $v) { ?>
                                            <option value="<?Php echo $v['cat_id'];?>"
                                                <?php if($catinfo['parent_id'] == $v['cat_id']) {?>
                                                    selected
                                                <?php } ?>
                                                >
                                                <?php echo str_repeat('&nbsp;', $v['lev']);?>
                                                <?Php echo $v['cat_name'];?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="am-g am-margin-bottom-sm">
                                <div class="am-u-sm-12 am-u-md-2 am-text-right admin-form-text">
                                    内容描述
                                </div>
                                <div class="am-u-sm-12 am-u-md-10">
                                    <textarea rows="10" name="intro" placeholder="请填写分类描述"><?php echo $catinfo['intro']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="cat_id" value="<?php echo $catinfo['cat_id'] ?>">
                <div class="am-margin">
                    <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
                </div>
            </form>
        </div>

        <footer class="admin-content-footer">
            <hr>
            <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
        </footer>
    </div>
    <!-- content end -->

<?php include('admin-footer.php'); ?>