<?php include('admin-sidebar.php'); ?>
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf">
                    <strong class="am-text-primary am-text-lg">表单</strong> /
                    <small>form</small>
                </div>
            </div>

            <hr>
            <form class="am-form" action="goodsaddAct.php" method="POST">
                <div class="am-tabs am-margin" data-am-tabs>
                    <ul class="am-tabs-nav am-nav am-nav-tabs">
                        <li class="am-active"><a href="#tab1">基本信息</a></li>
                        <li><a href="#tab2">详细描述</a></li>
                        <li><a href="#tab3">其他选项</a></li>
                    </ul>

                    <div class="am-tabs-bd" style="overflow: inherit;">
                        <div class="am-tab-panel am-active" id="tab1">
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    商品名称
                                </div>
                                <div class="am-u-sm-8 am-u-md-4">
                                    <input type="text" class="am-input-sm" name="goods_name">
                                </div>
                                <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
                            </div>
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    商品货号
                                </div>
                                <div class="am-u-sm-8 am-u-md-4">
                                    <input type="text" class="am-input-sm" name="goods_sn">
                                </div>
                                <div class="am-hide-sm-only am-u-md-6">*如不填，则系统自动生成</div>
                            </div>

                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">商品分类</div>
                                <div class="am-u-sm-8 am-u-md-10">
                                    <select data-am-selected="{btnSize: 'sm'}" name="cat_id">
                                        <option value="1">男装</option>
                                        <option value="2">女装</option>
                                    </select>
                                </div>
                            </div>
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    本店售价
                                </div>
                                <div class="am-u-sm-8 am-u-md-4">
                                    <input type="text" class="am-input-sm" name="shop_price">
                                </div>
                                <div class="am-hide-sm-only am-u-md-6"></div>
                            </div>
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    市场售价
                                </div>
                                <div class="am-u-sm-8 am-u-md-4">
                                    <input type="text" class="am-input-sm" name="market_price">
                                </div>
                                <div class="am-hide-sm-only am-u-md-6"></div>
                            </div>
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    上传商品图片
                                </div>
                                <div class="am-u-sm-8 am-u-md-4">
                                    <input type="text" class="am-input-sm">
                                </div>
                                <div class="am-hide-sm-only am-u-md-6"></div>
                            </div>
                        </div>

                        <div class="am-tab-panel" id="tab2">
                            <div class="am-g am-margin-top-sm">
                                <div class="am-u-sm-12 am-u-md-2 am-text-right admin-form-text">
                                    内容描述
                                </div>
                                <div class="am-u-sm-12 am-u-md-10">
                                    <textarea rows="10" placeholder="请使用富文本编辑插件" name="goods_desc"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="am-tab-panel" id="tab3">
                                <div class="am-g am-margin-top-sm">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                        商品重量
                                    </div>
                                    <div class="am-u-sm-8 am-u-md-4 am-u-end">
                                        <input type="text" class="am-input-sm" name="goods_weight">
                                    </div>
                                    <div class="am-hide-sm-only am-u-md-6">
                                        <select data-am-selected="{btnSize: 'sm'}" name="weight_unit">
                                            <option value="1">千克</option>
                                            <option value="0.001">克</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="am-g am-margin-top-sm">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                        商品库存数量
                                    </div>
                                    <div class="am-u-sm-8 am-u-md-4 am-u-end">
                                        <input type="text" class="am-input-sm" name="goods_number">
                                    </div>
                                </div>
                                <div class="am-g am-margin-top">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">加入推荐</div>
                                    <div class="am-u-sm-8 am-u-md-10">
                                        <div class="am-btn-group" data-am-button>
                                            <label class="am-btn am-btn-default am-btn-xs">
                                                <input type="checkbox" id="option1" name="is_best" value="1"> 精品
                                            </label>
                                            <label class="am-btn am-btn-default am-btn-xs">
                                                <input type="checkbox" id="option2" name="is_new" value="1"> 新品
                                            </label>
                                            <label class="am-btn am-btn-default am-btn-xs">
                                                <input type="checkbox" id="option3" name="is_hot" value="1"> 热销
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-g am-margin-top">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">上架</div>
                                    <div class="am-u-sm-8 am-u-md-10">
                                        <div class="am-btn-group" data-am-button>
                                            <label class="am-btn am-btn-default am-btn-xs">
                                                <input type="checkbox" name="is_on_sale" value="1"> 上架
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-g am-margin-top-sm">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                        商品关键词
                                    </div>
                                    <div class="am-u-sm-8 am-u-md-4 am-u-end">
                                        <input type="text" class="am-input-sm" name="keywords">
                                    </div>
                                    <div class="am-hide-sm-only am-u-md-6">*用空格分开</div>
                                </div>
                                <div class="am-g am-margin-top-sm">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                        商品简单描述
                                    </div>
                                    <div class="am-u-sm-8 am-u-md-4 am-u-end">
                                        <textarea rows="4" name="goods_brief"></textarea>
                                    </div>
                                </div>
                        </div>

                    </div>
                </div>

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
<?php include('admin-footer.php') ?>